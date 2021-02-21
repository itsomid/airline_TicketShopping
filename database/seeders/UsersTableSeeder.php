<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'email'=>'o.shabani@hotmail.com',
            'role'=>'admin',
        ]);
        User::factory()->count(9)->create([
            'role'=>'admin'
        ]);
        User::factory()->create([
            'email'=>'omid@hotmail.com',
            'role'=>'customer',
            'credit'=>54000,

        ]);
        User::factory()->count(4)->create([
            'role'=>'customer'
        ]);
    }
}
