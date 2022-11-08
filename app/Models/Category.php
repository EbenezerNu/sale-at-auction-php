<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'last_modified_at';

    const table = 'categories';

    protected $casts = [
        'id' => 'string'
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'description','created_by'
    ];

    protected $dates = [
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

}
