<html>
<head>   
     <link rel="stylesheet" href="<?php echo e(url('css\login.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css')); ?>">
    <script src='<?php echo e(url("js/login.js")); ?>' defer="true"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">


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

  

    <meta charset="utf-8">
    <title>Login</title>


    
    
    <div id="contenuto">

    
    <div id="form_reg">
        <h1 id="login">Login</h1>
 
        <?php if($error == 'empty_fields'): ?>
    <section class='error'> Compilare tutti i campi.</section>
    <?php elseif($error =='wrong'): ?>
    <section class='error'> Credenziali non valide</section>
    <?php endif; ?>


    <form name='nome_form' id="nome_form"  method='post'> 

        <?php echo csrf_field(); ?>
        <div class='tabella'>&nbsp; <input class="reg" placeholder="Username" type='text' name='username' value='<?php echo e(old("username")); ?>'></div>
        <div class='pass'> &nbsp; <input class="reg" type='password' name='password'placeholder="Password"  id="id_password">
        <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer"></i></div>
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
</html><?php /**PATH C:\Xampp\htdocs\hw2\resources\views/login.blade.php ENDPATH**/ ?>