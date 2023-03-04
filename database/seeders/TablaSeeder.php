<?php

namespace Database\Seeders;

use App\Models\backend\Tabla;
use Illuminate\Database\Seeder;

class TablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // crea configuracion: menus
        // $Menu = ['id', 'Nombre', 'subMenu' => []];
        $tab = 1000;
        $tabla['Menu'] = array(
            'Menus',
            'Uno',
            'Dos',
            'Tres' => ['Categorias', 'Marcadores'],
            'Cuatro',
            'Cinco' => ['A', 'B', 'C', 'D', 'E'],
            'Seis',
            'Siete'
        );

        $m = 0;
        foreach ($tabla['Menu'] as $i => $menu1) {
            // dump(['i' => $i, 'menu' => $menu1]);

            Tabla::factory(1)->create(
                [
                    'tabla' => $tab,
                    'tabla_id' => $m,
                    'nombre' => \is_array($menu1) ? $i : $menu1,
                    'descripcion' => null,
                    'activo' => $i ? true : false,
                    'valor1' => $m ?? $m,
                ]
            );
            if (\is_array($menu1)) {
                foreach ($menu1 as $j => $menu2) {
                    $n = $m + $j + 1;
                    Tabla::factory(1)->create(
                        [
                            'tabla' => $tab,
                            'tabla_id' => $n,
                            'nombre' => $menu2,
                            'descripcion' => null,
                            'activo' => $i ? true : false,
                            'valor1' => $m,
                        ]
                    );
                }
            }
            $m = $m + 100;
        }

        // crea profesiones
        $tab = 15000;
        $tabla['Profesiones'] = array('Profesiones', 'Doctor', 'Empresario', 'Dibujante', 'Arquitecto', 'Analista', 'Programador', 'Enfermera', 'Contador', 'Profesor', 'Sin Profesion');
        $sizeOf = sizeOf($tabla);
        foreach ($tabla['Profesiones'] as $key => $value) {

            Tabla::factory(1)->create(
                [
                    'tabla' => $tab,
                    'tabla_id' => $key == $sizeOf - 1 ? 99 : $key,
                    'nombre' => $value,
                    'descripcion' => null,
                    'activo' => $key ? true : false,
                ]
            );
        }
    }
}
