<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FirstUserSeeder extends Seeder {

    public function run(): void {
        if (!User::where('email', 'admin@iaxbank.com')->exists()) {
            User::create([
                'uuid'               => Str::uuid(),
                'sponsor_id'         => null,
                'name'               => 'Administrador',
                'cpfcnpj'            => '00000000000',
                'email'              => 'admin@iaxbank.com',
                'password'           => Hash::make('123456'),
                'type'               => 1,
                'wallet'             => 0,
                'wallet_investment'  => 0,
                'wallet_accumulated' => 0,
            ]);
        }
    }
}
