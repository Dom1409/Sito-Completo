<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;

use Illuminate\Routing\Controller as BaseController;


//funzione che restituisce la view del login con gli eventuali errori fatti dall'utente nell'inserimento dei dati
class LoginController extends BaseController
{

    public function login_form(){
        $error=Session::get('error');
        Session::forget('error');
        return view('login')->with('error', $error);   
    }


    //funzione che, se ci sono errori, ti reindirizza alla stessa pagina e poi su html ti stampa l'errore seguente,
    //altrimenti significa che non ci sono errori e allora ti indirizza alla home
    public function do_login(){

        //validazione dati
        if(strlen(request('username'))==0 || strlen(request('password'))==0){

            //sessione per errore:

                Session::put('error','empty_fields');

            return redirect('index')->withInput();
        }

        $user = User::where('username',request('username'))->first();
        if(!$user || !password_verify(request('password'),$user->password)){

            Session::put('error','wrong');
            return redirect('index')->withInput();
        }


        //login

        Session::put('user_id',$user->id);

        //redirect alla home
        return redirect('home');

    }


//funzione che restituisce la view della registrazione con gli eventuali errori
// fatti dall'utente nell'inserimento dei dati
    public function register_form(){

        $error=Session::get('error');
        Session::forget('error');
        return view('register')->with('error', $error);
        
    }

//funzione che, se ci sono errori, ti reindirizza alla stessa pagina e poi su html ti stampa l'errore seguente,
 //altrimenti significa che non ci sono errori e allora registra l'utente nel database

    public function do_register(){


        //validazione dati
        if(strlen(request('username'))==0 || strlen(request('password'))==0 || strlen(request('nome'))==0 || strlen(request('cognome'))==0){

            //sessione per errore:

                Session::put('error','empty_fields');
                //

            return redirect('register')->withInput();
        }
        else if(strlen(request('password')) < 8 || !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", request('password'))) {
            Session::put('error', 'pass_err');
            return redirect('register')->withInput();
        }
        

        else if(request('password') != request('confirm_password')){

            Session::put('error','non_coinc');
            //

        return redirect('register')->withInput();
        }
        //dobbiamo vedere se l'utente è già in uso
        else if(User::where('username',request('username'))->first()){

            Session::put('error','existing');
            //

             return redirect('register')->withInput();

        }

        else if( !preg_match("/^[a-zA-Z0-9_\-\.]+$/", request('username'))) {
            Session::put('error', 'username_err');
            return redirect('register')->withInput();
        }
        
        // creazione utente

        $user = new User;
        $user->nome=request('nome');
        $user->cognome=request('cognome');
        $user->username=request('username');
        $user->password=password_hash(request('password'), PASSWORD_BCRYPT);

        $user->save();

        //login

        Session::put('user_id',$user->id);

        //redirect alla home
        return redirect('home');

    }

   
    //elimina la sessione e ti reindirizza al login quindi permette il logout

    public function logout(){

        //Elimina sessione
            Session::flush();
            return redirect('index');

    }


}
