<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory()->count(1)->create([
            'price'=>500,
            'origin'=>'Tabriz',
            'destination'=>'Kish',
            'departure_date'=>Carbon::now()->addDays(1),
            'type'=>'flight',
            'capacity'=>200,

        ]);
        Ticket::factory()->count(1)->create([
            'price'=>5000,
            'origin'=>'Rasht',
            'destination'=>'Zanjan',
            'departure_date'=>Carbon::now()->addDays(2),
            'type'=>'flight',
            'capacity'=>2,

        ]);
        Ticket::factory()->count(1)->create([
            'price'=>2000,
            'origin'=>'Tehran',
            'destination'=>'Kish',
            'departure_date'=>Carbon::now()->addDays(2),
            'capacity'=>20,
            'type'=>'flight'
        ]);

        Ticket::factory()->count(1)->create([
            'price'=>3000,
            'origin'=>'Mashhad',
            'destination'=>'Qom',
            'departure_date'=>Carbon::now()->addDays(3),
            'capacity'=>30,
            'type'=>'flight'
        ]);
        Ticket::factory()->count(1)->create([
            'price'=>3000,
            'origin'=>'Mashhad',
            'destination'=>'Qom',
            'departure_date'=>Carbon::now()->addDays(5),
            'capacity'=>80,
            'type'=>'flight'
        ]);
        Ticket::factory()->count(52)->create([
            'price'=>4000,
            'origin'=>'Ardebil',
            'destination'=>'Tehran',
            'departure_date'=>Carbon::now()->addDays(4),
            'capacity'=>5,
            'type'=>'flight',
            'status'=>'canceled'
        ]);
    }
}
