<?php

namespace App\Models\Transaction;

use App\Models\Transaction\History;
use App\Models\ServiceLevelAgreement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\Transaction\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'transaction_date',
        'first_delivery_date',
        'receive_date',
        'shipping_form',
        'sla_id',
        'sla_actual',
        'sla_status',
        'kind_delivery',
        'type',
        'delivery_type',
        'weight',
        'volume',
        'item_value',
        'base_price',
        'tax_price',
        'status',
        'note',
    ];

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function sla()
    {
        return $this->belongsTo(ServiceLevelAgreement::class, 'sla_id');
    }
}
