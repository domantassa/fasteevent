@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            
            <div class="card myshadowcontainer ">
            <div class="row mt-2" >
                <div class="col-sm text-center biggerfont" style="display:block">
                <div>Pradžia</div>
                <div>{{$renginys->pradzia}}</div>
                </div>
                <div class="col-sm text-center biggerfont" style="display:block">
                <div>Pabaiga</div>
                <div>{{$renginys->pabaiga}}</div>
                </div>
            </div>
                <div class="card-body">
                    <h1 class="display-6 text-center mb-3">{{$renginys->pavadinimas}}</h1>
                    <p class="paragrafas">{{$renginys->turinys}}</p>
                    @if($arJauVyko == 'false')
                        @if (count($reservacijos) == 0)
                            <form action="{{ action('RenginiaiTController@register', $renginys->id) }}">
                                <input class="btn btn-primary float-right" type="submit" value="Užsiregistruoti" />
                            </form>
                        @else
                            <form action="{{ action('RenginiaiTController@signout', $renginys->id) }}">
                                <input class="btn btn-danger float-right" type="submit" value="Išsiregistruoti" />
                            </form>
                        @endif
                    @endif

                    
                </div>
                
            </div>
            
        </div>
    </div>
</div>

@endsection