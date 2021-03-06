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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Hind+Madurai&family=M+PLUS+1p:wght@400;500;700;800&family=Nunito:wght@400;600;700&family=Sarabun&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Messenger</title>
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>
<script src="{{asset("js/app.js")}}"></script>
</body>
</html>
