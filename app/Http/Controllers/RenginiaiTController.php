<?php

namespace App\Http\Controllers;

use App\renginiaiT;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RenginiaiTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Priminimas

        $users = \App\User::all()->where('role', 'vartotojas');
        $renginiai = \App\renginiaiT::all();
        foreach ($users as $user)
        {
            $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', $user->id);
            foreach ($reservacijos as $reservacija)
            {
                if($reservacija->reminder_sent == true)
                    continue;
                $renginiai = \App\renginiaiT::all()->where('id', $reservacija->renginio_id);
                foreach ($renginiai as $renginys)
                {
                    if(strtotime($renginys->pradzia) - 86400 * 2 < strtotime(NOW()) && strtotime($renginys->pradzia) > strtotime(NOW()))
                    {
                        $reservacija->reminder_sent = true;
                        $reservacija->save();
                        $pastas = 'pastas@gmail.com';
                        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
                            $m->from('hello@app.com', 'Your Application');
                
                            $m->to($user->email, $user->name)->subject('Your Reminder!');
                        });
                    }
                }
            }
        }
        $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', Auth::user()->id);



        //Priminimas
 
        
        $filter = $request->zyma;
        $renginiai;
        if($request->zyma == null || $request->zyma == "Visi")
        {
            $renginiai = \App\renginiaiT::all();
        }
        else
        {
            $renginiai = \App\renginiaiT::all()->where('zyma', $request->zyma);
        }

        
        
        foreach ($renginiai as $renginys)
        {

            $trukme = 0;
            $renginioTrukme = strtotime($renginys->pabaiga) - strtotime($renginys->pradzia);
            if($renginys->kartosis == 'diena')
            {
                $trukme = 86400;

            }
            else if($renginys->kartosis == 'savaite')
            {
                $trukme = 86400 * 7;
            }
            else if($renginys->kartosis == 'menesi')
            {
                $trukme = 86400 * 31;
            }

            if($renginys->pradzia < NOW() && $renginys->kartosis != 'nesikartos'){
                
                    
                    $pradzia = strtotime(NOW()) + $trukme;
                    $pabaiga = strtotime(NOW()) + $trukme + $renginioTrukme;
                    $renginys->pradzia = date("Y-m-d", $pradzia);
                    $renginys->pabaiga = date("Y-m-d", $pabaiga);
            }
        }
        
        return view('renginiai')->with([
            'renginiai' => $renginiai,
            'filter' => $filter,
        ]);
    }

    public function mano(Request $request)
    {
        $filter = $request->zyma;
        $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', Auth::user()->id);
        $renginiai = \App\renginiaiT::all()->where('savininko_id', -2);
        //dd($reservacijos);
        if(Auth::user()->role == "renginio_organizatorius")
        {
            $renginiai2 = \App\renginiaiT::all();
            foreach ($renginiai2 as $renginys)
            {
                if($renginys->savininko_id == Auth::user()->id)
                {
                    $renginiai->push($renginys);
                }
            }
        }
        else {
            $userId = Auth::user()->id;
            $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', $userId);
            foreach($reservacijos as $reservacija)
            {
                $renginys = \App\renginiaiT::all()->where('id', $reservacija->renginio_id)->first();
                $renginiai->push($renginys);
            }
        }
        
        if(!($request->zyma == null || $request->zyma == "Visi"))
        {
            $renginiai = $renginiai->where('zyma', $request->zyma);
            
        }

        foreach ($renginiai as $renginys)
        {

            $trukme = 0;
            $renginioTrukme = strtotime($renginys->pabaiga) - strtotime($renginys->pradzia);
            if($renginys->kartosis == 'diena')
            {
                $trukme = 86400;

            }
            else if($renginys->kartosis == 'savaite')
            {
                $trukme = 86400 * 7;
            }
            else if($renginys->kartosis == 'menesis')
            {
                $trukme = 86400 * 31;
            }

            if($renginys->pabaiga < NOW() && $renginys->kartosis != 'nesikartos'){
                
                    
                    $pradzia = strtotime(NOW()) + $trukme;
                    $pabaiga = strtotime(NOW()) + $trukme + $renginioTrukme;
                    $renginys->pradzia = date("Y-m-d", $pradzia);
                    $renginys->pabaiga = date("Y-m-d", $pabaiga);
            }
        }

        return view('manorenginiai')->with([
            'renginiai' => $renginiai,
            'filter' => $filter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usersSarasas = \App\User::all()->where('id', -1);
        return view('create-renginiai')->with([
            'form_type' => 'create',
            'usersSarasas' => $usersSarasas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pavadinimas' => 'required',
            'turinys' => 'required',
            'pradzia' => 'required',
            'pabaiga' => 'required',
            'vieta' => 'required',
        ]);
        
        $renginys = new \App\renginiaiT;
        $renginys->pavadinimas = $request->pavadinimas;
        $renginys->turinys = $request->turinys;
        $renginys->nuotrauka = "location";
        $renginys->pradzia = $request->pradzia;
        $renginys->pabaiga = $request->pabaiga;
        $renginys->vieta = $request->vieta;
        $renginys->zyma = $request->zyma;
        $renginys->savininko_id = Auth::user()->id;
        $renginys->kartosis = $request->kartosis;
        $renginys->save();
        return redirect('renginiai')->with('success','Renginys sėkmingai sukurtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\renginiaiT  $renginiaiT
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $renginys=\App\renginiaiT::find($id);

        if(Auth::user()->role == "renginio_organizatorius" && $renginys->savininko_id == Auth::user()->id)
        {
            $users = \App\User::all();
            $usersSarasas = \App\User::all()->where('id', -1);
            $reservacijos = \App\reservacijaT::all()->where('renginio_id', $id);
            foreach($reservacijos as $reservacija)
            {
                foreach ($users as $user)
                {
                    if($reservacija->vartotojo_id == $user->id)
                        $usersSarasas->push($user);
                }
                
            }
            $renginys=\App\renginiaiT::find($id);
            return view('create-renginiai')->with([
                'renginys' => $renginys,
                'form_type' => 'edit',
                'usersSarasas' => $usersSarasas,
            ]);
        }
        else if(Auth::user()->role == "renginio_organizatorius")
        {
            $filter = 'Visi';
            $renginiai=\App\renginiaiT::all();
            return redirect('renginiai')->with([
                'renginiai' => $renginiai,
                'filter' => $filter,
            ])->with('error','Galite redaguoti tik savo renginį.');
        }
        else
        {
            $usersSarasas = \App\User::all()->where('id', -1);
            $arJauVyko = 'false';
            $renginys = \App\renginiaiT::find($id);
            if(NOW() > $renginys->pradzia)
                $arJauVyko = 'true';
            $userId = Auth::user()->id;
            $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', $userId)->where('renginio_id', $id);
            return view('renginys')->with([
                'renginys' => $renginys,
                'reservacijos' => $reservacijos,
                'arJauVyko' => $arJauVyko,
            ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\renginiaiT  $renginiaiT
     * @return \Illuminate\Http\Response
     */


    public function register($id)
    {
        $userId = Auth::user()->id;
        $renginys=\App\renginiaiT::find($id);
        $reservacija = new \App\reservacijaT;
        $reservacija->vartotojo_id = $userId;
        $reservacija->renginio_id = $id;
        $reservacija->reminder_sent = false;
        $reservacija->save();
        $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', $userId)->where('renginio_id', $id);
        
        return redirect()->to('renginys/'.$id.'/show')->with([
            'renginys' => $renginys,
            'reservacijos' => $reservacijos,
        ])->with('success','Sėkmingai užsiregistravote į renginį.');
    }

    public function signout($id)
    {
        $userId = Auth::user()->id;
        $renginys=\App\renginiaiT::find($id);
        
        $reservacijos = \App\reservacijaT::all()->where('vartotojo_id', $userId)->where('renginio_id', $id);
        if($reservacijos){
            $reservacijos->each->delete();
        }
        return redirect('renginys/1/show')->with([
            'renginys' => $renginys,
            'reservacijos' => $reservacijos,
        ])->with('success','Sėkmingai išsiregistravote iš renginio.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\renginiaiT  $renginiaiT
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $renginys=\App\renginiaiT::find($id);
        $renginys->pavadinimas = $request->pavadinimas;
        $renginys->turinys = $request->turinys;
        $renginys->nuotrauka = "location";
        $renginys->pavadinimas = $request->pavadinimas;
        $renginys->pradzia = $request->pradzia;
        $renginys->pabaiga = $request->pabaiga;
        $renginys->zyma = $request->zyma;
        $renginys->vieta = $request->vieta;
        $renginys->kartosis = $request->kartosis;
        $renginys->save();
        return redirect('mano-renginiai')->with('success','Renginys sėkmingai pamodifikuotas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\renginiaiT  $renginiaiT
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $renginys = \App\renginiaiT::find($id);
        $renginys->delete();
        return redirect('renginiai');
    }
}
