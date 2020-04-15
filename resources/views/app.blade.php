<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Laravel Vue SPA - SantriKoding.com</title>
</head>
<body style="background-color: #edf2f7;">

<main id="app">
    <navigation></navigation>
    <router-view></router-view>
</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>