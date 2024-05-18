<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class crearUsuarioInicial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'  =>  'denis',
            'email'    =>  'denisalfreayala95@gmail.com',
            'name'      =>  'Denis Ayala',
            'password'  =>  bcrypt('19950102.V3rd3'), 
        ]);
    }
}
