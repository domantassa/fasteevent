@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card myshadowcontainer">
                <div class="card-body">
                    <h1 class="display-6 text-center mb-3">Visi renginiai</h1>
                    
                    
                    <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pavadinimas</th>
                        <th scope="col">Vieta</th>
                        <th scope="col">Pradžia</th>
                        <th scope="col">Pabaiga</th>
                        @if(auth()->user()->role=="admin")
                        <th scope="col">Veiksmai</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($renginiai as $renginys)
                            <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><a class="mylink" href="renginys/{{ $renginys->id }}/show">{{ $renginys->pavadinimas }}</a></td>
                            <td>{{ $renginys->vieta }}</td>
                            <td>{{ $renginys->pradzia }}</td>
                            <td>{{ $renginys->pabaiga }}</td>
                            @if(auth()->user()->role=="admin")
                            <td><a href="{{ route('deleteRenginys', $renginys->id) }}">Ištrinti</a></td>
                            @endif
                            </tr>
                        @endforeach
                    </tbody>
                    </table>

                    <div class="col-md-4" style="float: right">
                        <h4 class="text-center mb-3">Kategorija</h1>
                        <form method="GET" action="{{ action('RenginiaiTController@index') }}">
                        <select class="form-control" name="zyma">
                                <option value='Visi'>Visi</option>
                                <option {{ $filter === 'Muzikinis festivalis' ? 'selected' : null}} value='Muzikinis festivalis'>Muzikinis festivalis</option>
                                <option {{ $filter === 'Pokalbių šou' ? 'selected' : null}} value='Pokalbių šou'>Pokalbių šou</option>
                                <option {{ $filter === 'Muzikinis pasirodymas' ? 'selected' : null}} value='Muzikinis pasirodymas'>Muzikinis pasirodymas</option>
                        </select> 
                        <input type="submit" value="Atnaujinti" class="btn btn-primary text-uppercase" style="margin-top: 10px; margin-bottom: 10px; float: right;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection