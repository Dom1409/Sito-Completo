<html>
<head>
    @vite(['resources/css/login.css', 'resources/js/login.js'])
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Login</title>
</head>

<header>
    <nav id="nav_login">
        <div id="contenuto_log">
            <img id="img_logo" src="logo.gif">
        </div>
        <button id="btn_reg">Registrati</button>
    </nav>
</header>

<body>
    <div id="contenuto">
        <div id="form_reg">
            <h1 id="login">Login</h1>

            @if($error == 'empty_fields')
                <section class='error'> Compilare tutti i campi.</section>
            @elseif($error =='wrong')
                <section class='error'> Credenziali non valide</section>
            @endif

            <form name='nome_form' id="nome_form"  method='post'>
                @csrf
                <div class='tabella'>&nbsp;
                    <input class="reg" placeholder="Username" type='text' name='username' value='{{ old("username") }}'>
                </div>
                <div class='pass'> &nbsp;
                    <input class="reg" type='password' name='password'placeholder="Password"  id="id_password">
                    <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer"></i>
                </div>
                <div id="contenuto_btn"><input id="btn_log" type='submit' value='Accedi'></div>
            </form>
        </div>
    </div>



<footer id="foot"> 
        <div id="contenuto_footer">
                
                <p id="scritta">Created By:<br>Domenico Sultano<br>Numero Matricola: 1000001926</p>
        </div>
</footer>


</body>
</html>