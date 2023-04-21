<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\backend\Ciudad;

class CiudadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ciudad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'nombre' => $ciudad,
            'pais_id' => 194,
        ];
    }
}
