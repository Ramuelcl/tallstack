<x-layout>
    <div class="card bg-light mt-3">
        <div class="card-header">
            Laravel 9 Import Export Excel to Database Example - ItSolutionStuff.com
        </div>
        {{-- @include(asset('sessionMessage.php')) --}}
        @if (session()->has('success'))
        @php
        $get = Session::get('success');
        if (!is_array($get)) {
        $get = [$get];
        }
        @endphp
        @foreach ($get as $message)
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
        @endforeach
        @endif
        <div class="card-body">
            <form action="{{ route('banca.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="form-label" for="file">Select Files:</label>
                <input type="file" name="file[]" multiple class="form-control @error('files') is-invalid @enderror">
                @error('files')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="flex">
                    <button class="btn btn-success" type="submit" name="datos">Import Data</button>
                    <a class="btn btn-success" href="{{ route('banca.archivado') }}">archivado al sistema</a>
                    <a class="btn btn-success float-end" href="{{ route('banca.relacion_mov') }}">vincular
                        movimientos</a>
                </div>
            </form>
            <table class="table table-bordered mt-3">
                <tr>
                    <th colspan="5">
                        List - {{ count($regs) }} regs.
                        <a class="btn btn-warning float-end" href="{{ route('banca.export') }}">Export Data</a>
                    </th>

                </tr>
                <tr class="text-center">
                    <th>date</th>
                    <th>libelle</th>
                    <th>montant</th>
                    <th>Archivo</th>
                    <th>archivado</th>

                </tr>
                @foreach ($regs as $reg)
                <tr>
                    <td>{{ $reg->dateImportation->format('Y/m/d') }}</td>
                    <td>{{ $reg->libelle }}</td>
                    <td class="text-end">{{ $reg->montant }}</td>
                    <td>{{ $reg->archivo }}</td>
                    <td>{{ $reg->archivado }}</td>
                    {{-- <td class="text-end">{{ number_format($reg->montant, 2, '.', ',') }}</td> --}}
                </tr>
                @endforeach
            </table>

        </div>
    </div>
</x-layout>