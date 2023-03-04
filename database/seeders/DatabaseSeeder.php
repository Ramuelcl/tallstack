<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * usando Storage
         * en tiempo  de ejecución
         *

        use Illuminate\Support\Facades\Storage;

        $disk = Storage::build([
            'driver' => 'local',
            'root' => '/path/to/root',
        ]);

        $disk->put('image.jpg', $content);
         **/

        /**
         * usando Storage
         **/
        // $folders=['images','icons', 'avatars', 'cursos','posts'];
        // foreach ($folders as $folder) {
        //     if (Storage::exists('\\public\\'.$folder)) {
        //         Storage::deleteDirectory('\\public\\'.$folder);
        //     }
        //     Storage::makeDirectory('\\public\\'.$folder);
        // }
        // Storage::disk('local')->put('example.txt', 'Contents 3221Contenido');// storage/app/
        // echo asset('local').'/file.txt ';

        // Storage::copy($folder, public_path().'banca.yaml');
        // dd(public_path(), storage_path(), public_path("storage"), storage_path('storage'), env('APP_URL').'/public/storage', $folders, $folder);

        $this->call([

            TablaSeeder::class,
            //
            RoleSeeder::class,
            UserSeeder::class,
            //
            PaisSeeder::class,
            // TelefonoSeeder::class,
            DireccionSeeder::class,
            CategoriaSeeder::class,
            MarcadorSeeder::class,
            //
            // BancaSeeder::class,
            // CompteSeeder::class,
            // MouvementSeeder::class,
            // CursoSeeder::class,
            // ClientSeeder::class,
            // ProjectSeeder::class,
            // InvoiceSeeder::class,
        ]);
    }
}
