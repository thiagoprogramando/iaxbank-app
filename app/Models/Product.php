<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model {

    use HasFactory, Notifiable, SoftDeletes;
    
    protected $table = 'products';

    protected $fillable = [
        'uuid',
        'user_id',
        'photo',
        'name',
        'acronym',
        'description',
        'value',
        'performance',
        'time',
        'status',
    ];

    public function packages() {
        return $this->hasMany(ProductPackage::class, 'product_id');
    }

    public function investiments() {
        return $this->hasMany(Investiment::class, 'product_id');
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
