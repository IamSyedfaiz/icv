<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'gst_number',
        'address',
        'invoice_number',
        'item_number',
        'amount',
        'tax',
        'quantity',
    ];

}
