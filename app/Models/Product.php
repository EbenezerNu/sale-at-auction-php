<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'last_modified_at';

    const table = 'products';

    protected $casts = [
        'id' => 'string',
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'price', 'description', 'category_id', 'created_by'
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
        return $this->hasOne('App\Model\Category', 'id', 'category_id');
    }

}
