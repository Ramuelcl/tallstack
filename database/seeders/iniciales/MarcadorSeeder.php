<?php

namespace Database\Seeders;

use App\Models\backend\Marcador;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class MarcadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = Marcador::factory()->make();
    }
}
