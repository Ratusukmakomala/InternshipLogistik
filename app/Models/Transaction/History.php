<?php

namespace App\Models\Transaction;

use App\Models\Office;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    /** @use HasFactory<\Database\Factories\Transaction\HistoryFactory> */
    use HasFactory;

    protected $table = 'transaction_histories';
    protected $fillable = [
        'transaction_id',
        'sender_office_id',
        'receiver_office_id',
        'change_status_date',
        'status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function senderOffice()
    {
        return $this->belongsTo(Office::class, 'sender_office_id');
    }

    public function receiverOffice()
    {
        return $this->belongsTo(Office::class, 'receiver_office_id');
    }
}
