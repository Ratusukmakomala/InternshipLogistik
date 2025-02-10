<?php

namespace App\Models\Transaction;

use App\Models\Partner;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TPartner extends Model
{
    /** @use HasFactory<\Database\Factories\Transaction\TPartnerFactory> */
    use HasFactory;

    protected $table = 'transaction_partners';

    protected $fillable = [
        'transaction_id',
        'partner_id',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
