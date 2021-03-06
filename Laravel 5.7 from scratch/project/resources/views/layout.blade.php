<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" />
    <title>@yield('title', 'Projects')</title>

    <style>
        .is-done {
            text-decoration: line-through;
        }
    </style>

</head>

<body>
    <section class="section">
        <div class="container">
            @yield('content')
        </div>
    </section>

</body>

</html>
