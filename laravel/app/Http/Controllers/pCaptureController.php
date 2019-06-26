<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pCaptureController extends Controller
{
    //
    public function index()
    {
        $capturedPokemon = \App\pokedex_user::where('user_id', \Auth::user()->id)->orderBy('pokemon_id', 'asc')->get();

        $pokemon = [];
        foreach($capturedPokemon as $captured)
        {
            $pokemon[] = \App\Pokedex::all()->where('id', $captured->pokemon_id)->first();
        }

        return view('pcapture', ['Pokedex' => $pokemon]);
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

        $capturedPokemon = \App\pokedex_user::where('user_id', \Auth::user()->id)->orderBy('pokemon_id', 'asc')->get();
        $pokemon = [];
        foreach($capturedPokemon as $captured)
        {
            $pokemon[] = \App\Pokedex::all()->where('id', $captured->pokemon_id)->first();
        }

        return view('pcapture', ['Pokedex' => $pokemon]);
    }

}
