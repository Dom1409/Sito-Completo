<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Wish;

use Illuminate\Routing\Controller as BaseController;

class MenuController extends BaseController
{

        //funzione che restituisce la view di gioca ma se non ce nessuna sessione reindirizza al login
    public function Gioca(){

        if (!Session::get('user_id')) {
            return redirect('index');
        }
        return view('gioca');
    }

    //funzione che restituisce la view di Top_5_giochi ma se non ce nessuna sessione reindirizza al login
    public function Top_5(){
        if (!Session::get('user_id')) {
            return redirect('index');
        }
        
        return view('top_5_g');
    }
}


