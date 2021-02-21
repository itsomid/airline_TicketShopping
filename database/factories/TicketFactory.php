<?php

namespace Database\Factories;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => 1000,
            'type'=>$this->faker->randomElement(['flight', 'train']),
            'departure_date'=>Carbon::now()->addDays(rand(1,10)),
            'origin'=>$this->faker->city,
            'destination'=>$this->faker->city,
            'status'=>'available'

        ];
    }
}
