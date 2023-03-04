<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\MarcadorSeeder;

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
            RoleSeeder::class,
            UserSeeder::class,
            //
            // DireccionSeeder::class,
            // TelefonoSeeder::class,
            MarcadorSeeder::class,
            CategoriaSeeder::class,
            // TablaSeeder::class,
            //
            // BancaSeeder::class,
            // CompteSeeder::class,
            // MouvementSeeder::class,
            // CursoSeeder::class,
            // ClientSeeder::class,
            // ProjectSeeder::class,
            // TagSeeder::class,
            // InvoiceSeeder::class,
        ]);
    }
}
