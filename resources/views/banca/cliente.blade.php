<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 Import Export Excel to Database Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
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
                <form action="{{ route('cliente.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label" for="file">Select Files:</label>
                    <input type="file" name="file[]" multiple class="form-control @error('files') is-invalid @enderror">
                    @error('files')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="flex">
                        <button class="btn btn-success" type="submit">importar Clientes</button>
                    </div>
                </form>

                <table class="table table-bordered mt-3">
                    <tr>
                        <th colspan="5">
                            List - {{ count($regs) }} regs.
                        </th>

                    </tr>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Tipo</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Razón Social</th>
                        <th>activo</th>
                        <th>eMail</th>

                    </tr>
                    @foreach ($regs as $reg)
                    <tr>
                        <td>{{ $reg->id }}</td>
                        <td>{{ $reg->tipo }}</td>
                        <td>{{ $reg->nombres }}</td>
                        <td>{{ $reg->apellidos }}</td>
                        <td>{{ $reg->razonSocial }}</td>
                        <td>{{ $reg->activo }}</td>
                        <td>{{ $reg->eMail }}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

</body>

</html>
