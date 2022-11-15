<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = "auctions";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const table = 'auctions';

    protected $casts = [
        'id' => 'string',
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'name',  'price', 'description', 'category_id', 'start_date', 'end_date', 'created_by'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at'
    ];

    protected $hidden = [
        'category_id',
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

    public function category(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

}
