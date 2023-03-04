<?php

namespace Database\Factories\banca;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\banca\Traspaso;

class TraspasoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Traspaso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dateImportation' => $this->faker->date(),
            'libelle' => $this->faker->text,
            'montant' => $this->faker->randomFloat(2, 0, 999999.99),
            'archivo' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'dupTxt' => $this->faker->text,
            'archivado' => $this->faker->randomNumber(),
        ];
    }
}
