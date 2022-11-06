<?php

namespace App\Model\Setup;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = "auctions";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'last_modified_at';

    const table = 'auctions';

    protected $casts = [
        'id' => 'string',
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'description', 'start_date', 'end_date', 'created_by', 'last_modified_by'
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
