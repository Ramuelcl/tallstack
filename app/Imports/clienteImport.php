<?php

namespace App\Imports;

use App\Models\backend\Cliente;
//
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class clienteImport implements ToModel, WithHeadingRow
{
    use Importable;

    public $saltaLineas = 7;
    public $caracter = array(";", "\t", ",");

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        static $num = 50;
        // dump($rows);
        try {
            if (is_array($rows) && sizeof($rows) > 2) {
                $row =  array_values($rows);
            }
            // dump($row);
            $existeGuion = strpos($row[0], '-');
            dump($existeGuion);
            if ($existeGuion && $existeGuion <= 3) {
                $dato = explode("-", $row[0]);
                $id = $dato[0];
                $row[0] = $dato[1];
                // sleep(3);
            } else
                $id = $num++;
            // dump($id, $row[0]);
            $client = $row[0];

            $addr1 = $row[1];
            $addr2 = $row[2];
            $addr3 = $row[3];
            $phone = $row[4];
            $fax = $row[5];
            $web = $row[6];
            $email = $row[7];

            //
            // dump([['id' => $id], [$row[0] => $client], [$row[1] => $addr1], [$row[7] => $email]],);
            //
            try {
                DB::beginTransaction();
                $model = new Cliente;
                $model->id = $id;
                $model->tipo = 'cliente';
                $model->nombres = $client;
                $model->apellidos = $addr1 . ' ' . $addr2 . ' ' . $addr3;
                $model->activo = $existeGuion ? true : false;
                $model->eMail = $email;
                $model->save();
                DB::commit();
            } catch (Throwable $e) {
                dd($e);
                DB::rollback();
                return;
            }
        } catch (Throwable $e) {
            dd($e);
            throw $e;
        }
    }
}
