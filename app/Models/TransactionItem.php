<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
   protected $fillable = [
    'transaction_id',
    'product_id',
    'price',
    'quantity',
    'subtotal',
];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}