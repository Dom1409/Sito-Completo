
<html>
<head>
<script>
    const BASE_URL="<?php echo e(url('/')); ?>/";
    const csrf_token= '<?php echo e(csrf_token()); ?>';
    </script>
    
<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta charset="utf-8">
    <title>Descrizione Gioco</title>
    <link rel="stylesheet" href="<?php echo e(url('css/description_games.css')); ?>"/>
    <script src='<?php echo e(url("js/description_games.js")); ?>' defer="true"></script>
</head>


<header>
<nav id="nav_description">
        
        <button id="btn_home">Home</button>
          <button id="btn_desideri">Aggiungi lista desideri</button>
          <button id="btn_visualizza_desideri">Visualizza lista desideri</button>

        </nav>
</header>
   <body>
    
    <section id="contenuto">

</section>
</body>

</html><?php /**PATH C:\Users\dodis\Desktop\hw2-main\resources\views/description.blade.php ENDPATH**/ ?>