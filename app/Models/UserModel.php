<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class UserModel extends Authenticatable
{
	protected $table = 'users';

	protected $fillable = [
		'id',
		'token'
	];
}