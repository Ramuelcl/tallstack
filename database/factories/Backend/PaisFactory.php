<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

use App\Models\backend\Pais;

class PaisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pais::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paises = fncGlob_Files('C:\\laragon\\www\\heroicons\\flags\\',"*","jpeg");
        // dd($paises);

        foreach ($paises as  $value) {
            // dump([$value, $value['name']]);
            // dump([$value['filename'], $value['name']]);

            DB::table('pais')->insert([
                'nombre' => $value['name'],
                'bandera' => $value['filename'],
                // 'idioma' => $value['name'],
            ]);
        }
        return [];
    }
}



