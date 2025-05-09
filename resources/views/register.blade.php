<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src='{{ url("js/registrazione.js")}}' defer="true"></script>
<link rel="stylesheet" href="{{ url('css\registrazione.css') }}"/>

</head>

<header>
<nav id="nav_login">
        <div id="contenuto_log">
            <img id="img_logo" src="logo.gif">
           
        </div>
 <button id="btn_indietro">Torna al Login</button>
    </nav>

</header>

<body>


    <meta charset="utf-8">
    <title>Registrazione</title>
    


    <div id="contenuto">





    <div id="form_reg">

    <h1 id="registrazione">Registrazione</h1>

    @if($error=='empty_fields')
    <section class='error'> Compilare tutti i campi.</section>
    @elseif($error=='pass_err')
    <section class='error'> La password deve avere almeno 8 caratteri, una lettera maiuscola, una lettera minuscola e un numero.</section>
    @elseif($error=='non_coinc')
    <section class='error'> Le password non coincidono.</section>
    @elseif($error=='existing')
    <section class='error'> Nome utente già in uso!</section>
    @elseif($error=='username_err')
    <section class='error'> Username non valido</section>
    @endif


<form  id="nome_form"name='nome_form'  method='post'> 

    @csrf

    <div class='tabella'><input class="reg" type='text' name='nome' placeholder="Nome" value='{{ old("nome") }}'></div>
    <div class='tabella'> <input class="reg" type='text' name='cognome' placeholder="Cognome" value='{{ old("cognome") }}'></div>
    <div class='tabella'> <input class="reg" type='text' id="username" name='username' placeholder="Username" value='{{ old("username") }}'></div>
    <div class='tabella'><input class="reg" type='password' name='password' placeholder="Password" value='{{ old("password") }}'></div>
    <div class='tabella'><input class="reg" type='password' name='confirm_password'placeholder="Conferma Password" value='{{ old("confirm_password") }}'></div>
    <div  id="contenuto_btn"><input type='submit'id="btn_regi"  value="Registrati"></div>
</form>
</div>
</div>


</body>
</html>