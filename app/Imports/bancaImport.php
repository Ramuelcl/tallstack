<?php

namespace App\Imports;

use App\Models\Banca\Traspaso;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class bancaImport implements ToModel, WithHeadingRow
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
        // dump($rows);
        try {
            $tr = Traspaso::all();
            // si está sin registros pongo a uno el contador AUTO_INCREMENT
            if (count($tr) == 0) {
                $query = "ALTER TABLE traspasos AUTO_INCREMENT = 1";
                DB::table($query);
            }
            // sleep(2);
            if (is_array($rows) && sizeof($rows) > 2) {
                $row =  array_values($rows);
            } else {
                if (is_array($rows) && sizeof($rows) == 1) {
                    $rows = array_values($rows);
                }
                $elBueno = "";
                foreach ($this->caracter as $key => $c) {
                    $row = explode($c, $rows[0]);
                    // dump($row, $c);
                    if (sizeof($row) >= 3 && strlen($row[0]) === 10) {
                        $elBueno = $row;
                        // dump($rows[0], $elBueno);
                    }
                }
                $row = $elBueno;
                // dd($row, '====>');
            }
            if (!isset($row[1])) {
                dd($elBueno);
            }
            // quitamos las doble comillas si las tiene al de tipo texto
            $row[1] = str_replace('"', '', $row[1]);
            // busca si ya existe el registro
            $existe = $tr->where('dupTxt', '=', $row[0] . $row[1] . $row[2])->first();
            if (!$existe) {
                // $dateImportation = $row[0];
                $dateImportation = fncChangeDateFormate($row[0]);
                $libelle = $row[1];
                $montant = fncChangeNumberFormate($row[2]);

                //
                // dump([[$row[0] => $dateImportation], [$row[1] => $libelle], [$row[2] => $montant]],);
                //
                return new Traspaso([
                    'dateImportation' => $dateImportation, //date("yyyymmdd", $dateImportation),
                    'libelle' => $libelle,
                    'montant' => $montant,
                    'dupTxt' => "$row[0]$row[1]$row[2]",
                    'created_at' => now(),

                ]);
            }
        } catch (Throwable $e) {
            dump($e);
            throw $e;
        }
        // $rows['date'] = date("Y-m-d", strtotime($rows['date']))
        // $rows['libelle'] = fncElimCaracterDuplicado($rows['libell'], ["  ", " "]);
        // 'montant' => number_format((float)$rows['montanteuros'], 2, '.', ''),

    }

    public function headingRow(): int
    {
        return $this->saltaLineas;
    }
}
