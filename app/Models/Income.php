<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Income extends Model {

    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'incomes';

    protected $fillable = [
        'uuid',
        'user_id',
        'product_id',
        'package_id',
        'amount',
        'profit_percent',
        'user_distribution',
        'binary_left_percent',
        'binary_right_percent',
        'binary_distribution',
        'status',
    ];
}
