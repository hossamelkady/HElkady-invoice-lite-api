<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['number',
            'customer_name',
            'amount',
            'currency',
            'status',
            'due_date'];
}
