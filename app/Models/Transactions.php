<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function wallets(){
        return $this->hasOne(Wallet::class,'id','wallet_id');
    }
}
