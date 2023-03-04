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
    public function run()    {
        // crea configuracion: menus
        // $Menu = ['id', 'Nombre', 'subMenu' => []];
        $tabla['Menu'] = array(
            'Menus',
            'Uno',
            'Dos',
            'Tres' => ['Categorias', 'Marcadores'],
            'Cuatro',
            'Cinco' => ['A', 'B', 'C', 'D', 'E' ],
            'Seis',
            'Siete');

        $m = 0;
        foreach($tabla['Menu'] as $i => $menu1){
// dump(['i'=>$i, 'menu'=>$menu1]);
            if($i == 0){
                Tabla::factory(1)->create([
                    'tabla'=>1000,
                    'tabla_id' => $i,
                    'nombre' => $menu1,
                    'descripcion' => null,
                    'activo' => false,
                    ]
                );
            }else{
                $m = $m + 100;
                Tabla::factory(1)->create([
                    'tabla'=>1000,
                    'tabla_id' => $m,
                    'nombre' => \is_array($menu1) ? $i : $menu1,
                    'valor1' => 0,
                    ]
                );
                if(\is_array($menu1)){
                    foreach($menu1 as $j => $menu2){
                        $n = $m+$j+1;
                        Tabla::factory(1)->create([
                            'tabla'=>1000,
                            'tabla_id' => $n,
                            'nombre' => $menu2,
                            'valor1' => $m,
                            ]
                        );
                    }
                }
            }
        }

        // crea profesiones
        $tabla['Profesiones'] = array('Profesiones', 'Doctor', 'Empresario', 'Dibujante', 'Arquitecto', 'Analista', 'Programador', 'Enfermera', 'Contador', 'Profesor', 'Sin Profesion');
        foreach($tabla['Profesiones'] as $key => $value){
            if($key == 0){
                Tabla::factory(1)->create([
                    'tabla'=>15000,
                    'tabla_id' => $key,
                    'nombre' => $value,
                    'descripcion' => null,
                    'activo' => false,
                    ]
                );
            }else{
                Tabla::factory(1)->create([
                    'tabla'=>15000,
                    'tabla_id' => $key,
                    'nombre' => $value,
                    ]
                );
            }

        }
    }

}
