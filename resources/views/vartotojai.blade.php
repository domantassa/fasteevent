@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card myshadowcontainer">
                <div class="card-body">
                    <h1 class="display-6 text-center mb-3">Visi vartotojai</h1>
                    <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vardas pavardė</th>
                        <th scope="col">El. paštas</th>
                        <th scope="col">Rolė</th>
                        <th scope="col">Statusas</th>
                        <th scope="col">Veiksmai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $user->vardas_pavarde }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>Neprisijungęs</td>
                            <td><a href="{{ route('deleteVartotojas', $user->id) }}">Ištrinti</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection