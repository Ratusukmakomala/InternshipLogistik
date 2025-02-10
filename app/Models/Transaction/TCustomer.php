<?php

namespace App\Models\Transaction;

use App\Models\Customer;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TCustomer extends Model
{
    /** @use HasFactory<\Database\Factories\Transaction\TCustomerFactory> */
    use HasFactory;

    protected $table = 'transaction_customers';

    protected $fillable = [
        'transaction_id',
        'sender_id',
        'receiver_id',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Customer::class, 'receiver_id', 'id');
    }
}
