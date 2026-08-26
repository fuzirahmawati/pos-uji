<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number',
        'user_id',
        'customer_id',
        'total_amount',
        'paid_amount',
        'change_amount',
        'payment_method',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}