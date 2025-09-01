<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TopUp extends Model
{
    use HasFactory;

    protected $table = 'topup';

    protected $fillable = ['user_id','amount','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
