
<html>
<head>
<script>
    const BASE_URL="{{ url('/') }}/";
    const csrf_token= '{{csrf_token()}}';
    </script>
<link rel="stylesheet" href="{{ url('css/visualizza_wishlist.css') }}"/>
    <script src='{{ url("js/wishlist_home.js")}}' defer="true"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta charset="utf-8">
    <title>Lista Desideri</title>
    
</head>
<header>
<nav id="nav_description">
        <div id="bar_description">
        <button id="btn_home">Home</button>
</div>
        </nav>
</header>

<body>

   

    <section id="contenuto">
   

</section>
</body>
</html>