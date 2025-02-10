<?php

namespace App\Models\Transaction;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashOnDelivery extends Model
{
    /** @use HasFactory<\Database\Factories\Transaction\CashOnDeliveryFactory> */
    use HasFactory;

    protected $table = 'transaction_cash_on_deliveries';

    protected $fillable = [
        'transaction_id',
        'payment_date',
        'payment_due_date',
        'payment_status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
