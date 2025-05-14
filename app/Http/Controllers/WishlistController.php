<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Wish;


use Illuminate\Routing\Controller as BaseController;

class WishlistController extends BaseController
{

// funzione che prende i valori di tit e img mandati da javascript tramite fetch
//e le inserisce nel database e se è già presente nel database da un errore
// se la sessione non è attiva restituisce un array vuoto
   public function wishlist_add()
{
    try {
        if (!Session::get('user_id')) {
            return response()->json([], 403);
        }

        $tit = request('nome');
        $img = request('image');
        $userId = Session::get('user_id');

        $exist = Wish::where('title', $tit)
                     ->where('id_user', $userId)
                     ->first();

        if ($exist) {
            return response()->json(['error' => 'exist_wish']);
        }

        Wish::create([
            'id_user' => $userId,
            'title'   => $tit,
            'image'   => $img
        ]);

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        \Log::error('Errore wishlist_add: ' . $e->getMessage());
        return response()->json(['error' => 'Errore server: ' . $e->getMessage()], 500);
    }
}



    //funzione che legge i valori nel database e li restituisce tramite json
    // se la sessione non è attiva restituisce un array vuoto
   public function wishlist_list()
{
    if (!Session::get('user_id')) {
        return response()->json([], 403);
    }

    $userId = Session::get('user_id');

    $wishes = Wish::where('id_user', $userId)->get(['title', 'image']);

    return response()->json($wishes);
}



    //funzione che ritorna la view della wishlist e in caso che non esista la sessione ritorna un array vuoto
    // se la sessione non è attiva restituisce un array vuoto
    public function wishlist_view(){

        if (!Session::get('user_id')) {
            return [];
        }

        return view('view_wishlist');

    }


    //funzione che dopo che avviene il click su un button tramite fetch riceve due valori
    //controlla se esistono nel database in caso di esistenza lo elimina
    // se la sessione non è attiva restituisce un array vuoto
   public function wishlist_remove()
{
    if (!Session::get('user_id')) {
        return response()->json([], 403);
    }

    $userId = Session::get('user_id');
    $titolo = request('nome_elemento');

    $wish = Wish::where('title', $titolo)
                ->where('id_user', $userId)
                ->first();

    if ($wish) {
        $wish->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['error' => 'not_found']);
}




    //funzione che restituisce la view della wishlist cliccata dal menu della home
    // se la sessione non è attiva restituisce un array vuoto
    public function wishlist_view_home(){
        if (!Session::get('user_id')) {
            return [];
        }

        return view('view_wishlist_home');

    }


    }


