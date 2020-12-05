
@extends('layouts.app')

@section('content')



<div class='container'>
<div class="row justify-content-center">
        <div class="col-md-8">
        
            <div class="card myshadowcontainer">
    <div class='row py-5'>
        <div class='col'>
            <h1 class='text-uppercase text-center'>{{ $form_type == 'create' ? 'Užregistruoti naują renginį' : 'Renginio redagavimas' }}</h1>
        </div>
    </div>
    <div class='row py-3'>
        <div class='col'>
            <form method="POST" action="{{ $form_type === 'create' ? action('RenginiaiTController@store') : action('RenginiaiTController@update', $renginys->id) }}">
                @csrf
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Pavadinimas</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control{{ $errors->has('pavadinimas') ? ' is-invalid' : '' }}" name="pavadinimas" value="{{ $form_type === 'edit' ? $renginys->pavadinimas : '' }}" placeholder="" required oninvalid="this.setCustomValidity('Įveskite pavadinimą')"
  oninput="this.setCustomValidity('')">
                    </div>
                    @error('pavadinimas')
                        <span class="invalid-feedback" role="alert">
                            <strong>Pavadinimas reikalingas</strong>
                        </span>
                    @enderror                    
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Pradžios data</label>
                    <div class="col-md-5">
                        <input type="date" class="form-control{{ $errors->has('pradzia') ? ' is-invalid' : '' }}" name="pradzia" value="{{ $form_type === 'edit' ? $renginys->pradzia : '' }}" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Pabaigos data</label>
                    <div class="col-md-5">
                        <input type="date" class="form-control{{ $errors->has('pabaiga') ? ' is-invalid' : '' }}" name="pabaiga" value="{{ $form_type === 'edit' ? $renginys->pabaiga : '' }}" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Vieta</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control{{ $errors->has('vieta') ? ' is-invalid' : '' }}" name="vieta" value="{{ $form_type === 'edit' ? $renginys->vieta : '' }}" placeholder="" required oninvalid="this.setCustomValidity('Įveskite renginio vietą')"
  oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Turinys</label>
                    <div class="col-md-5">
                        <textarea  class="form-control{{ $errors->has('turinys') ? ' is-invalid' : '' }}" name="turinys" required oninvalid="this.setCustomValidity('Įveskite renginio turinį')"
  oninput="this.setCustomValidity('')">{{ $form_type === 'edit' ? $renginys->turinys : '' }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Ar renginys kartosis?</label>
                    <div class="col-md-5">
                    <select class="form-control" name="kartosis">
                            <option {{ $form_type === 'edit' && $renginys->kartosis === 'nesikartos' ? 'selected' : '' }} value='nesikartos'>Nesikartos</option>
                            <option {{ $form_type === 'edit' && $renginys->kartosis === 'diena' ? 'selected' : '' }} value='diena'>Kas dieną</option>
                            <option {{ $form_type === 'edit' && $renginys->kartosis === 'savaite' ? 'selected' : '' }} value='savaite'>Kas savaitę</option>
                            <option {{ $form_type === 'edit' && $renginys->kartosis === 'menesi' ? 'selected' : '' }} value='menesi'>Kas mėnesį</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Žyma</label>
                    <div class="col-md-5">
                        <select class="form-control" name="zyma">
                            <option {{ $form_type === 'edit' && $renginys->zyma === 'Pokalbių šou' ? 'selected' : '' }} value='Pokalbių šou'>Pokalbių šou</option>
                            <option {{ $form_type === 'edit' && $renginys->zyma === 'Muzikinis festivalis' ? 'selected' : '' }} value='Muzikinis festivalis'>Muzikinis festivalis</option>
                        </select> 
                    </div>
                </div>

                <div class="row mb-0 pt-3 text-center">
                    <div class="col-12">
                        <input type="submit" value="Patvirtinti" class="btn btn-primary text-uppercase">
                        @if($form_type === 'edit')
                        <a class="btn btn-danger text-uppercase"href="{{ route('deleteRenginys', $renginys->id) }}">Ištrinti</a>
                    @endif
                    </div>
                    @if($form_type === 'edit') <input type='hidden' name='_method' value='PUT' /> @endif
                   
                </div>
            </form>
            
        </div>
    
        
    </div>
    </div>

    @if($form_type == 'edit')
    <div class="card myshadowcontainer" style="margin-top: 50px; margin-bottom: 50px;">
    <div class='row py-5'>
        <div class='col'>
            <h1 class='text-uppercase text-center'>{{ $form_type == 'create' ? 'null' : 'Dalyvių sąrašas' }}</h1>
        </div>
    </div>
    <div class='row py-3'>
        <div class='col'>
        <div class="container">
            <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vardas pavardė</th>
                        <th scope="col">El. paštas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersSarasas as $user)
                            <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $user->vardas_pavarde }}</td>
                            <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>

                    </div>
            
        </div>
    
        
    </div>
    </div>
    @endif
    

        </div>
    </div>
</div>



                    
@endsection
