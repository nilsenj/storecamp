<?php
/**
 * Copyright (c) 2016.  Property of Combird.
 * All rights reserved.
 */

namespace App\Core\Auditing;

use Illuminate\Database\Eloquent\Model;
use App\Core\Entities\User;

class Log extends Model
{
    /**
     * @var string
     */
    public $table = 'logs';

    /**
     * Cast values.
     *
     * @var array
     */
    protected $casts = ['old_value' => 'json', 'new_value' => 'json'];

    /**
     * Added attribute.
     *
     * @var array
     */
    protected $appends = ['custom_message', 'custom_fields', 'elapsed_time'];

    protected $fillable = ['module_name'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['user', 'owner'];

    /**
     * Get model auditing.
     *
     * @return array revision history
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Author responsible for the change.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\Config::get('auditing.model'));
    }

    /**
     * @return mixed
     */
    public function ownerInstance(){

        $owner_id = $this->owner_id;
        if (isset($owner_id)) {
            return \App\Core\Entities\User::find($owner_id);
        }
    }

    /**
     * Returns data of model.
     *
     * @return object|false
     */
    public function restore()
    {
        if (class_exists($class = $this->owner_type)) {
            $model = $this->$class->findOrFail($this->owner_id);
            $model->fill($this->old_value);

            return $model->save();
        }

        return false;
    }

    /**
     * Get old value.
     *
     * @return mixed
     */
    public function getOldAttribute()
    {
        return $this->old_value;
    }

    /**
     * Get new value.
     *
     * @return mixed
     */
    public function getNewAttribute()
    {
        return $this->new_value;
    }

    public function getModuleName(){

        return $this->module_name;
    }

    /**
     * Get elapsed time.
     * 
     * @return mixed
     */
    public function getElapsedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Custom output message.
     *
     * @return mixed
     */
    public function getCustomMessageAttribute()
    {
        if (class_exists($class = $this->owner_type)) {
            return $this->resolveCustomMessage($this->getCustomMessage($class));
        } else {
            return false;
        }
    }

    /**
     * Custom output fields.
     *
     * @return array
     */
    public function getCustomFieldsAttribute()
    {
        if (class_exists($class = $this->owner_type)) {
            $customFields = [];
            foreach ($this->getCustomFields($class) as $field => $message) {
                if (is_array($message) && isset($message[$this->type])) {
                    $customFields[$field] = $this->resolveCustomMessage($message[$this->type]);
                } elseif (is_string($message)) {
                    $customFields[$field] = $this->resolveCustomMessage($message);
                }
            }

            return array_filter($customFields);
        } else {
            return false;
        }
    }

    /**
     * Get custom message.
     *
     * @return string
     */
    public function getCustomMessage($class)
    {
        if (!isset($class::$logCustomMessage)) {
            return 'Not defined custom message!';
        }

        return $class::$logCustomMessage;
    }

    /**
     * Get custom fields.
     *
     * @return string
     */
    public function getCustomFields($class)
    {
        if (!isset($class::$logCustomFields)) {
            return [];
        }

        return $class::$logCustomFields;
    }

    /**
     * Resolve custom message.
     *
     * @param $message
     *
     * @return mixed
     */
    public function resolveCustomMessage($message)
    {
        preg_match_all('/\{[\w.| ]+\}/', $message, $segments);
        foreach (current($segments) as $segment) {
            $s = str_replace(['{', '}'], '', $segment);
            $keys = explode('|', $s);

            if (empty($keys[1]) && isset($keys[2])) {
                $keys[1] = $this->callback($keys[2]);
            }

            $valueSegmented = $this->getValueSegmented($this, $keys[0], isset($keys[1]) ? $keys[1] : false);
            if (!$valueSegmented) {
                return false;
            }
            $message = str_replace($segment, $valueSegmented, $message);
        }

        return $message;
    }

    /**
     * Message callback.
     * @param $method
     */
    public function callback($method)
    {
        if (method_exists($this->owner, $method)) {
            return $this->owner->{$method}($this);
        }

        return;
    }

    /**
     * Get Value of segment.
     *
     * @param $object
     * @param $key
     * @param $default
     *
     * @return mixed
     */
    public function getValueSegmented($object, $key, $default)
    {
        if (is_null($key) || trim($key) == '') {
            return $default;
        }

        foreach (explode('.', $key) as $segment) {
            $object = is_array($object) ? (object) $object : $object;
            if (!isset($object->{$segment})) {
                return $default;
            }

            $object = $object->{$segment};
        }

        return $object;
    }
}
