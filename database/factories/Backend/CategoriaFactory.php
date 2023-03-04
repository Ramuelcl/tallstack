<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Categoria;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre = ucwords($this->faker->words($this->faker->numberBetween(1, 3), $string = true));
        return [
            'nombre' => $nombre,
            'babosa' => Str::slug($nombre),
        ];
    }
}
