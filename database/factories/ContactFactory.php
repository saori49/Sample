<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Contact::class;

    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'gender' => $this->faker->numberBetween(1, 2),
            'email' => $this->faker->unique()->safeEmail(),
            'postcode' => $this->faker->text(8),
            'address' => $this->faker->address(),
            'building_name' => $this->faker->word,
            'opinion' => $this->faker->realText(50),
            'created_at' => $this->faker->datetimeBetween('-1 year')
        ];
    }
}
