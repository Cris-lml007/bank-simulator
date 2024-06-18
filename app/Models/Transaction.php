<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $fillable=[
        'by',
        'for',
        'quantity'
    ];

    public function getBy(){
        return $this->belongsTo(User::class,'by','id');
    }

    public function getFor(){
        return $this->belongsTo(User::class,'for','id');
    }

}
