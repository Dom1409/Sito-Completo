<html>
    <head>
        <script>
            const BASE_URL="{{ url('/') }}/";
            const csrf_token= '{{csrf_token()}}';
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Lista Desideri</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <header>
        <nav id="nav_description">
            <div id="bar_description">
                <button id="btn_home">Home</button>
            </div>
        </nav>
    </header>

    <body>
        <section id="contenuto"></section>
    </body>
</html>