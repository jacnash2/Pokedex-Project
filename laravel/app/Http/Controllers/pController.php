<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class pController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function capture(Request $request)
    {
        request()->validate(['captureId' => 'required|integer']);

        $alreadyCaptured = false;

        $capturedPokemon = \App\pokedex_user::where('user_id', \Auth::user()->id)->get();

        foreach($capturedPokemon as $captured)
        {
            if($request->get('captureId') == $captured->pokemon_id) $alreadyCaptured=true;
        }

        if(!$alreadyCaptured){
            \App\pokedex_user::create([
                'user_id' => \Auth::user()->id,
                'pokemon_id' => $request->get('captureId')
            ]);
        }

        $pokemon = \App\Pokedex::paginate(10);

        return view('p', ['Pokedex' => $pokemon]);
    }

    public function select(Request $request)
    {
        request()->validate(['selectId' => 'required|integer']);

        $pokemon = \App\Pokedex::where('id', $request->get('selectId'))->paginate(10);

        return view('p', ['Pokedex' => $pokemon]);
    }
}
