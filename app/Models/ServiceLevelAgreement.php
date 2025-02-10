<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLevelAgreement extends Model
{
    protected $fillable = [
        'name',
        'description',
        'target'
    ];
}
