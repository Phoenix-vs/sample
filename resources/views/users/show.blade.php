<?php
/**
 * Created by PhpStorm.
 * User: Phoenixvs
 * Date: 2018/11/2
 * Time: 19:00
 */


?>

        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <img src="{{ $user->gravatar() }}">
        @include('shared._message')
        <h3>{{ $user->name }}</h3>
    </div>
</body>
</html>
