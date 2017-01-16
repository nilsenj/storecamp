<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Juggl\UniqueHashids\GeneratesUnique;
use App\Core\Components\Messenger\Models\Thread;
use Toastr;

/**
 * Class FeedBack
 * @package SXC\Models
 */
class ProductReview extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use GeneratesUnique;
    
    /**
     * @var array
     */
    protected $searchable = [
        'rating',
        'product'
    ];
    /**
     * @var string
     */
    protected $table = "product_reviews";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product', 'rating', 'message', 'unique_id', 'visible', 'resolved', 'date'];

    /**
     * @var array
     */
    protected $dates = ['date'];


    /**
     * @param $date
     */
    public function setDateAttribute($date)
    {

        $this->attributes['date'] = Carbon::today();

    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thread(){

        return $this->hasMany(Thread::class, 'product_reviews_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getThread(){

        return $this->thread()->first();
    }
    /**
     * @param $query
     */
    public function scopeUsers($query) {

        $query->where("user_id", \Auth::user()->id);
    }
    /**
     * @param $query
     */
    public function scopeToday($query)
    {

        $query->where('date', '=', Carbon::today());

    }

    /**
     * @param $query
     * @param $id
     */
    public function scopeUsersByID($query, $id)
    {
        try {
            $query->where('user_id', '=', $id);

        } catch (ModelNotFoundException $e) {

            return Toastr::error("Error appeared", "Model not Found");
        }
    }

    /**
     * @param $query
     */
    public function scopeVisible($query){

        $query->where("visible", true);
    }

    /**
     * @param $query
     */
    public function scopeResolved($query){

        $query->where("resolved", true);
    }

    /**
     * @param $query
     * @param $reason
     */
    public function scopeByRating($query, $reason) {

        $query->where("rating", $reason);

    }



}
