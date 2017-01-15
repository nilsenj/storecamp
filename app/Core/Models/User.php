<?php

namespace App\Core\Models;


use App\Core\Access\Traits\AccessUserTrait;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Juggl\UniqueHashids\GeneratesUnique;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements Transformable, AuthenticatableContract,
    CanResetPasswordContract
{
    use TransformableTrait;
    use Notifiable;
    use \Cviebrock\EloquentSluggable\Sluggable;
    use \Illuminate\Auth\Authenticatable, CanResetPassword;
    use AccessUserTrait;
    use GeneratesUnique;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at', 'created_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @param string $value
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }


    /**
     * @param $date
     */
    public function setDateAttribute($date)
    {

        $this->attributes['date'] = Carbon::today();

    }

    /**
     * @param $query
     */
    public function scopeToday($query)
    {

        return $query->where('date', '=', Carbon::today());

    }

    /**
     * check if the given customer is admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }
    /**
     * @var array
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * @return mixed
     */
    public function getLogoFromPath()
    {

        return \Storage::get($this->logo_path);
    }

    /**
     * @return bool
     */
    public function haveGenericLogo()
    {

        return !is_null($this->logo_path);
    }

    /**
     * @return string
     */
    public function getLogoImg()
    {
        if (!empty($this->getMedia('logo')->first())) {
            $pictures = $this->getMedia('logo');
            $picture = $pictures[0]->getUrl();

            return url($picture);
        } elseif (empty($this->getMedia('logo')->first()) && $this->haveGenericLogo()) {

            return "data:image/jpeg;base64," . base64_encode($this->getLogoFromPath());
        } else {

            return url('images/default-user.png');
        }
    }

    /**
     * CHECK if the customer is the owner of the instance
     * @param $instance
     * @return bool
     */
    public function isOwner($instance)
    {
        if ($this->id == $instance->user()->id) {
            return true;
        } else return false;
    }
    /**
     * @param $query
     * @param $name
     */
    public function scopeByMailOrName($query, $name){

        $query->where("name",$name)->orWhere('email', $name);
    }
    /**
     * @param $query
     * @return mixed
     */
    public function scopeAllExcept($query){

        return $query->where('id', '<>', \Auth::id());
    }
    /**
     * @param $query
     */
    public function scopeUsers($query)
    {

        return $query->where('user_id', '=', \Auth::id());
    }
    public function getRole(){

        return $this->roles()->first();
    }

    /**
     * find user by slug
     *
     * @param $slug
     * @return mixed
     */
    public static function findBySlug($slug) {

        return self::where('slug', $slug)->first();
    }
}
