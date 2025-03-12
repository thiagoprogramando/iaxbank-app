<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Investiment extends Model {
    
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'investiments';

    protected $fillable = [
        'uuid',
        'user_id',
        'product_id',
        'package_id',
        'amount',
        'profit_percent',
        'payment_token',
        'payment_payload',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function package() {
        return $this->belongsTo(ProductPackage::class);
    }

    public function labelStatus() {
        switch ($this->status) {
            case '1':
                return '<span class="badge rounded-pill bg-label-success me-1"> Aprovado </span>';
                break;
            case '2':
                return '<span class="badge rounded-pill bg-label-warning me-1"> Pendente </span>';
                break;
            case '3':
                return '<span class="badge rounded-pill bg-label-danger me-1"> Cancelado </span>';
                break;
            default:
                return '<span class="badge rounded-pill bg-label-warning me-1"> Pendente </span>';
                break;
        }
    }
}
