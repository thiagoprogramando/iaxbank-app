<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductIncome extends Model {

    use HasFactory, Notifiable, SoftDeletes;
    
    protected $table = 'product_incomes';

    protected $fillable = [
        'product_id',
        'package_id',
        'amount',
        'profit_percent',
        'performance',
        'status',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function labelStatus() {
        switch ($this->status) {
            case '1':
                return '<span class="badge rounded-pill bg-label-success me-1"> Concluído </span>';
                break;
            case '2':
                return '<span class="badge rounded-pill bg-label-warning me-1"> Rascunho </span>';
                break;
            case '2':
                return '<span class="badge rounded-pill bg-label-danger me-1"> Cancelado </span>';
                break;
            default:
                return '<span class="badge rounded-pill bg-label-warning me-1"> Pendente </span>';
                break;
        }
    }
}
