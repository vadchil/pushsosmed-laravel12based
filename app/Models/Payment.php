<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'method', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
