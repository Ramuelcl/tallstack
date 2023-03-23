<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// use App\Exports\BancaExport;
use App\Imports\BancaImport;
use App\Models\backend\Tabla;
use App\Models\banca\Movimiento;
use App\Models\banca\Traspaso;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BancaController extends Controller
{
    public $saltaLineas;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $regs = Traspaso::orderBy('dateImportation', 'desc')->get();

        return view('banca.Banca', compact('regs'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        $msj[] = "Exportación no implementado\n";
        return back()->with(['success' => $msj]);

        // return Excel::download(new BancaExport, 'mov' . Carbon::parse(now())->format('yyyymmdd') . 'xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function archivado()
    {
        $msj = "No existen registros para archivar";
        $traspasados = 0;
        $tr = Traspaso::where('archivado', '=', 0)->get();
        // dump(count($tr));
        foreach ($tr as $value) {
            // dump(['traspaso', count($tr), $value]);
            Movimiento::insert([
                'dateMouvement' => $value->dateImportation,
                'libelle' => fncElimCaracterDuplicado($value->libelle, ["  ", " "]),
                'montant' => $value->montant,
                'created_at' => now(),
            ]);
            $mov = Movimiento::latest('id')->first();
            // dump(['movimiento', $value->id => $mov]);
            $value->update(['archivado' => $mov->id]);

            // sleep(4);
            $msj = 'registros de traspasados a movimientos: ' . $traspasados++;
        }
        // $this->emit('flash', $msj, $tipo);
        return back()->with(['success' => $msj]);
    }

    public function relacion_mov()
    {
        // $query1 = "SELECT DISTINCT tabla_id, nombre, descripcion, valor1 FROM tablas WHERE tabla=15100 AND activo=true";
        $tabla = Tabla::all()
            ->where('tabla', '15100')
            ->where('activo', true);
        // ->orderBy('tabla_id', 'ASC');
        //DB::table('tablas')->select($query1)->get();
        // dd($tabla);
        $total = 0;
        foreach ($tabla as $key => $value) {
            $cod = $value->nombre;
            $id = $value->tabla_id;
            // dump([$id, $cod]);
            $affected = Movimiento::where('cliente_id', null)
                ->where('libelle', 'LIKE', "%$cod%")
                ->update(['cliente_id' => $id]);
            $total += $affected;
        }
        $msj[$total] = "($total) han sido individualizados\n";
        return back()->with(['success' => $msj]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        if ($request->file('file')) {
            foreach ($request->file('file') as $key0 => $value0) {
                $file = $value0->getClientOriginalName();
                $ext  = $value0->getClientOriginalExtension();

                $deYaLeidos = false;
                // selecciona los nombres de archivos de ya traspasados
                $paso = DB::select('SELECT DISTINCT archivo FROM traspasos;');
                // los recorre para saber si el nuevo ya ha sido importado
                foreach ($paso as $key1 => $value1) {
                    // dd($paso, $value1->archivo);
                    if ($file === $value1->archivo)
                        $deYaLeidos = true;
                }
                // dd($file, $paso, $deYaLeidos, in_array($file, $paso));
                if (!$deYaLeidos) {
                    // si no lo ha traspasado lee sus registros
                    (new BancaImport)->import($value0);

                    /** buscamos registros duplicados y los eliminamos */
                    $sql = 'SELECT dupTxt, count(*) AS contador FROM traspasos GROUP BY dupTxt HAVING contador > 1;';
                    $paso = DB::select($sql);

                    if ($paso)
                        // recorre los registros duplicados
                        foreach ($paso as $key => $record) {
                            // Get the row you don't want to delete.
                            // busca el primero para excluirlo
                            $dontDeleteThisRow = Traspaso::where('dupTxt', $record->dupTxt)
                                ->first();
                            // Delete all rows except the one we fetched above.
                            Traspaso::where('dupTxt', $record->dupTxt)->where('id', '!=', $dontDeleteThisRow->id)->delete();
                        }
                    /** asignamos el nombre del archivo traspasado */
                    $paso = Traspaso::where('archivo', Null)
                        ->update(['archivo' => $file]);
                    $msj[$file] = "traspasado(s) $paso registros de: $file\n";
                } else {
                    $msj[$file] = "el archivo ($file) ya ha sido traspasado\n";
                }
            }
        }

        return back()->with(['success' => $msj]);
    }
}
