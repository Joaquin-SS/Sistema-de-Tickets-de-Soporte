<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->contrasena = Hash::make('1234'); // Establece una nueva contraseña
            $user->save();
        }
    }
}
