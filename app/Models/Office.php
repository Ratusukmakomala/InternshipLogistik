<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'parent_id',
        'code',
        'name',
        'region',
        'type',
        'address',
        'zip_code',
    ];

    public function parent()
    {
        return $this->belongsTo(Office::class, 'parent_id');
    }
}
