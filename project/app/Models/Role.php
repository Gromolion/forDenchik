<?php

namespace App\Models;

require "/code/bootstrap.php";

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @method static where(string $string, string $string1)
 */
class Role extends Eloquent
{
    protected $fillable = ['name', 'code'];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'user_roles', 'role_id', 'user_id');
    }
}