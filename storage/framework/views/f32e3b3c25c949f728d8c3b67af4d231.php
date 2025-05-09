<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    const BASE_URL="<?php echo e(url('/')); ?>/";
    </script>
    <link href="<?php echo e(url ('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <script src='<?php echo e(url("js/home.js")); ?>' defer="true"></script>
    <link rel="stylesheet" href="<?php echo e(url('css\home.css')); ?>">
    


    <title>Home</title>
    </head>

    <header>
    
    <nav id="nav_login">
   <button id="btn_logout">Logout</button>
        <div id="contenuto_log">
            <img id="img_logo" src="logo.gif">
           
        </div>

        

        <div id="toggleButton">
          <span class="icon_bar"></span>
          <span class="icon_bar"></span>
          <span class="icon_bar"></span>
          
        </div>

    </nav>
  
    <div id="contenuto">
  <ul id="tabella">
  <li class="righe"><a class="scritte" href="<?php echo e(url('wishlist/home')); ?>" >Wishlist </a></li>
  <li class="righe"><a  class="scritte"  href="<?php echo e(url('Gioca')); ?>" >Gioca</a></li>
  <li class="righe"><a  class="scritte"  href="<?php echo e(url('Top_5_Giochi')); ?>" >Top 5 Giochi</a></li>
</ul>
</div>

</header>


<body>


  
  
   <h1 id="Home">SHOP</h1>

   <div class="box">
    <div class="container-2">
    <form id="searchForm">
  
      <i class="fa fa-search" id="icon"></i>
      <input type="search" id="search" placeholder="Search..." />
  </form>
    </div>
  </div>
  <div class="loader"></div>
        <section id="shop">
     
        </section>

<div id=contenuto_btn_carica>
    <button id="btn_carica">Carica Altro</button>
  </div>

</body>

</html><?php /**PATH C:\Users\dodis\Desktop\hw2-main\resources\views/home.blade.php ENDPATH**/ ?>