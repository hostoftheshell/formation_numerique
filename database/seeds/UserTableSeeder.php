<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Enregistrement d'un nouvel utilisateur dans la table users : 
        DB::table('users')->insert(
            [
                [
                    'name' => 'admin',
                    'email' => 'admin@admin.fr',
                    'password' => Hash::make('admin'), // password encrypted
                ]
            ]
        );
    }
}
