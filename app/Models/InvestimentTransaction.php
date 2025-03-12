<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class InvestimentTransaction extends Model {
    
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'investment_transactions';

    protected $fillable = [
        'uuid',
        'user_id',
        'product_id',
        'package_id',
        'amount',
        'profit_percent',
        'binary_position',
    ];
}
