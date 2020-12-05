@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registravimosi forma</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                        <div class="form-group row">
                            <label for="vardas_pavarde" class="col-md-4 col-form-label text-md-right">Vardas ir pavardė</label>

                            <div class="col-md-6">
                                <input id="vardas_pavarde" type="text" class="form-control @error('vardas_pavarde') is-invalid @enderror" name="vardas_pavarde" value="{{ old('vardas_pavarde') }}" autocomplete="name" autofocus required>

                                @error('vardas_pavarde')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Prašome pataisyti savo vardą ar pavardę</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">El. paštas</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Prašome pataisyti el. paštą</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Organizuosiu renginius</label>
                            <div class="col-md-6">
                                <select class="form-control" name="role">
                                        <option value='yes'>Taip</option>
                                        <option value='no'>Ne</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Slaptažodis</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Prašome pataisyti slaptažodį</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Patvirtinkite slaptažodį</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Užsiregistruoti
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
