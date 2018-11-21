<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WalletModel extends Model
{
	protected $table = 'wallet';

	protected $fillable = [
		'id',
		'user_id',
		'wallet_id',
		'address',
		'coin',
		'qr_code_url',
		'balance',
		'unit',
		'created_at',
		'updated_at',
		'currency_id',
		'balance',
		'locked_bal'
    ];
}