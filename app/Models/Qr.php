<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;

    public $fillable = [
        'account_id',
        'quantity'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
