<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const table = 'reviews';

    protected $casts = [
        'id' => 'string'
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'title', 'product_id', 'created_by'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at'
    ];

    protected $hidden = [
        'created_at',
        'created_by'
    ];

    protected $appends = [
        'createdAt',
        'createdBy'
    ];

    public function getCreatedAtAttribute()
    {
        return $this->asDateTime($this->attributes['created_at']);
    }

    public function getCreatedByAttribute()
    {
        return $this->attributes['created_by'];
    }

    public function product(){
        return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }

}
