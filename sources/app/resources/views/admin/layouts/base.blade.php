<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Styles-->
    @vite(['resources/sass/app.scss'])
    <title>
        Fitness Club
    </title>
</head>
<body>
<div class="container">
    @yield('content')
</div>

<!--Scripts-->
@vite(['resources/js/app.js'])
</body>
</html>
