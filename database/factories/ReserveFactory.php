<?php

namespace Database\Factories;

use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'        => User::factory(),
            'rental_item_id' => RentalItem::factory(),
            'start_date'     => $this->faker->dateTimeThisYear(),
            'end_date'       => $this->faker->dateTimeThisYear(),
            'title'          => $this->faker->sentence,
            'reserve_notes'  => $this->faker->sentence,
            'reserve_status' => $this->faker->randomElement(['ocupado', 'reservado', 'disponivel']),
        ];
    }
}
