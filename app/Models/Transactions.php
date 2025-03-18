<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Transactions extends Model {

    use HasFactory, SoftDeletes;
    
    protected $table = 'bank_transactions';

    protected $fillable = [
        'uuid',
        'from_id',
        'to_id',
        'value',
        'type',
        'status',
    ];

    public function from() {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to() {
        return $this->belongsTo(User::class, 'to_id');
    }

    public function labelType() {

        $user = Auth::user();

        if ($this->from_id == $user->id) {
            switch ($this->type) {
                case 1:
                    return 'TED enviada para ' . ($this->to ? $this->to->name : 'destinatário desconhecido');
                case 2:
                    return 'Saque';
                case 3:
                    return 'Rendimento Aplicado';
                default:
                    return '---';
            }
        }

        if ($this->to_id == $user->id) {
            switch ($this->type) {
                case 1:
                    return 'TED recebida de ' . ($this->from ? $this->from->name : 'remetente desconhecido');
                case 2:
                    return 'Saque';
                case 3:
                    return 'Rendimento Aplicado';
                default:
                    return '---';
            }
        }

        return '---';
    }

    public function labelStatus() {
        switch ($this->status) {
            case '1':
                return '<span class="badge rounded-pill bg-label-success me-1"> Concluída </span>';
                break;
            case '2':
                return '<span class="badge rounded-pill bg-label-warning me-1"> Pendente </span>';
                break;
            case '2':
                return '<span class="badge rounded-pill bg-label-danger me-1"> Cancelada </span>';
                break;
            default:
                return '<span class="badge rounded-pill bg-label-warning me-1"> Pendente </span>';
                break;
        }
    }
}
