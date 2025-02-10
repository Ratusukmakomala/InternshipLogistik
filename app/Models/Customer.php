<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'phone',
        'address',
        'zip_code',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
