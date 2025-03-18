<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProductPackage extends Model {

    use HasFactory, Notifiable, SoftDeletes;
    
    protected $table = 'product_packages';

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'value',
        'performance',
        'binary_left_percent',
        'binary_right_percent',
        'time',
        'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function investiments() {
        return $this->hasMany(Investiment::class, 'package_id');
    }

    public function labelStatus() {
        switch ($this->status) {
            case '1':
                return '<span class="badge rounded-pill bg-label-success me-1"> Ativo </span>';
                break;
            case '2':
                return '<span class="badge rounded-pill bg-label-danger me-1"> Inativo </span>';
                break;
            default:
                return '<span class="badge rounded-pill bg-label-danger me-1"> Inativo </span>';
                break;
        }
    }
}
