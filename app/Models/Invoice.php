<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'amount',
        'customer_id',
        'status',
        'billed_date',
        'paid_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
