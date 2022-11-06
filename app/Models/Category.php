<?php

namespace App\Model\Setup;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "installations.task_product_type";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'last_modified_at';

    const table = 'installations.task_product_type';

    protected $casts = [
        'id' => 'string',
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'enabled','created_by', 'last_modified_by'
    ];

    protected $dates = [
        'created_at',
        'last_modified_at'
    ];

    protected $hidden = [
        'created_at',
        'created_by',
        'last_modified_at',
        'last_modified_by'
    ];

    protected $appends = [
        'createdAt',
        'createdBy',
        'lastModifiedAt',
        'lastModifiedBy',
    ];

    public function getCreatedAtAttribute()
    {
        return $this->asDateTime($this->attributes['created_at']);
    }

    public function getCreatedByAttribute()
    {
        return $this->attributes['created_by'];
    }

    public function getLastModifiedAtAttribute()
    {
        return $this->asDateTime($this->attributes['last_modified_at']);
    }

    public function getLastModifiedByAttribute()
    {
        return $this->attributes['last_modified_by'];
    }

}
