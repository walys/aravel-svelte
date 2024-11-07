<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserSeeder extends Seeder
{
    public function run()
    {
        //php artisan db:seed --class=SituationSeeder
        User::factory()->count(1)->state(new Sequence(
            [
                'id' => 1,
                'name' => 'User Test Pratice',
                'email' => 'user@email.com',
                'password' => '123456'
            ],
        ))->create();
    }
}
