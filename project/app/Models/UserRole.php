<?php

namespace App\Models;

require "/code/bootstrap.php";

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @method static create(array $array)
 */
class UserRole extends Eloquent
{
    protected $fillable = ['user_id', 'role_id'];
}