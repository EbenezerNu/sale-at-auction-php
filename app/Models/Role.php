<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const table = 'roles';

    protected $casts = [
        'id' => 'string'
    ];

    public $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'description'
    ];

    protected $dates = [
        'created_at'
    ];

    protected $hidden = [
        'created_at',
    ];

    protected $appends = [
        'createdAt',
    ];

    public function getCreatedAtAttribute()
    {
        return $this->asDateTime($this->attributes['created_at']);
    }

}
