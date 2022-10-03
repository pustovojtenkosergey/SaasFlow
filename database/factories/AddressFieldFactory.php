<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class AddressFieldFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $streetAddress = explode(' ', $this->faker->address);
        return [
            'name' => $this->faker->name,
            'company_name' => $this->faker->company,
            'address_line_1' => $streetAddress[0] . ' ' . ($streetAddress[1] ?? '') . ' ' . ($streetAddress[2] ?? ''),
            'address_line_2' => ($streetAddress[3] ?? '') . ' ' . ($streetAddress[4] ?? ''),
            'address_line_3' => ($streetAddress[5] ?? '') . ' ' . ($streetAddress[6] ?? ''),
            'city' => $this->faker->city,
            'state' => $this->faker->state(),
            'zip' => $this->faker->postcode,
            'country' => $this->faker->countryCode,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'vat' => $this->faker->randomNumber(),
            'eori_number' => $this->faker->randomNumber(),
            'ioss_number' => $this->faker->randomNumber(),
            'id_number' => $this->faker->randomNumber(),
            'extra_fields' => json_encode([
                'extra_field_1' => $this->faker->randomNumber(),
                'extra_field_2' => '',
                'extra_field_3' => '',
                'extra_field_4' => '',
                'extra_field_5' => '',
            ]),
        ];
    }
}
