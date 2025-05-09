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
    public function wishlist_add(){

        if (!Session::get('user_id')) {
            return [];
        }

        $tit=request('nome');
        $img=request('image');

        $exist= Wish::where('content->title', $tit)->where('id_user', Session::get('user_id'))->first();

        if ($exist) {

            Session::put('error','exist_wish');
            return ['error' => 'exist_wish'];
        }


        $this->wish= new Wish;
        $this->wish->id_user = Session::get('user_id');
        $this->wish->content = json_encode(['title' => $tit, 'image' => $img]);
        $this->wish->save();
  
        return ['success' => true];

    }


    //funzione che legge i valori nel database e li restituisce tramite json
    // se la sessione non è attiva restituisce un array vuoto
    public function wishlist_list(){

        if (!Session::get('user_id')) {
            return [];
        }

        $userId = Session::get('user_id');

        // Recupero i record dal database corrispondenti all'ID utente della sessione corrente
        $wishes = Wish::where('id_user', $userId)->get();
    
        // salvo i risultati su un array e li restituisco come json,
        // perché il return converte in automatico l'array in json
        $result = [];
        foreach ($wishes as $wish) {
            $content = json_decode($wish->content);
            $result[] = $content;
        }

        return $result;
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
    public function wishlist_remove(){

        if (!Session::get('user_id')) {
            return [];
        }
        $userId = Session::get('user_id');
        $nome_elemento=request('nome_elemento');

        $wish = Wish::where('content->title', $nome_elemento)->where('id_user', $userId)->first();
        $wish->delete();
        
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


