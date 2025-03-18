<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'sponsor_id',
        'binary_left_id',
        'binary_right_id',
        'position',
        'photo',
        'name',
        'cpfcnpj',
        'wallet',
        'wallet_investiment',
        'wallet_accumulated',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sponsor() {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    // Relacionamento com os indicados (quem esse usuário indicou)
    public function referrals() {
        return $this->hasMany(User::class, 'sponsor_id');
    }

    // Estrutura binária - posição esquerda
    public function binaryLeft() {
        return $this->belongsTo(User::class, 'binary_left_id');
    }

    // Estrutura binária - posição direita
    public function binaryRight() {
        return $this->belongsTo(User::class, 'binary_right_id');
    }

    public function investiments() {
        return $this->hasMany(Investiment::class, 'user_id');
    }

    public function labelName(): string {
        $nameParts = explode(' ', trim($this->name));
        return isset($nameParts[1]) ? "{$nameParts[0]} {$nameParts[1]}" : $nameParts[0];
    }

    public function labelCpfCnpj(): string {

        $cpfcnpj = preg_replace('/\D/', '', $this->cpfcnpj);
        if (strlen($cpfcnpj) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpfcnpj);
        } elseif (strlen($cpfcnpj) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cpfcnpj);
        }

        return $this->cpfcnpj;
    }
}
