<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Messenger</title>
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="{{asset("js/app.js")}}"></script>
</body>
</html>
