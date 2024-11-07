<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Situation;
use Illuminate\Database\Eloquent\Factories\Sequence;

class SituationSeeder extends Seeder
{
    public function run()
    {
        //php artisan db:seed --class=SituationSeeder
        Situation::factory()->count(3)->state(new Sequence(
            [
                'id' => 1,
                'description' => 'Pendente',
                'color' => '#c82333',
            ],
            [
                'id' => 2,
                'description' => 'Em andamento',
                'color' => '#ffc107',
            ],
            [
                'id' => 3,
                'description' => 'Concluído',
                'color' => '#218838',
            ],
        ))->create();
    }
}
