<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <link
        href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!-- CSS Bootstrap -->
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/script.js"></script>

    </head>
    <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="collapse navbar-collapse" id="navbar">
            <a href="/" class="navbar-brand">
              <img src="/img/hdcevents_logo.svg" alt="logo">
            </a>
          </div>
        </nav>
      </header>
      @yield('content')
      <footer>
        <p>HDC Events &copy; 2024</p>
      </footer>
    </body>
</html>

