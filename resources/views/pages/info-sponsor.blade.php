<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            background: #318bb4;
        }
        .infoad{
             background: #d1dbe0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            border: 2px black;
            box-sizing: border-box;
             box-shadow: 0 15px 25px rgba(2,2,2,.3);
             padding: 20px;
            font-size: 1.5em;        
            }
    </style>
</head>
<body>
    <div class="infoad">
        <p>Sponsorizzazione attivata</p>
        <p>La tua sponsorizzazione ha un costo di: <span>{{$amount}}</span>Euro</p>
        <p>Il tuo appartamento sarà sponsorizzato per: <span>-{{$time}}-</span>ore</p> 
        <p>Hai sottoscritto la sponsorizzazione giorno:{{$today}}</p>
        <p>Scadrà giorno: {{$new_expire}}</p>
        <a href="{{route('sponsor.show', $apartment->id)}}">Torna al tuo appartamento</a>
    </div>
    
 
</body>
</html>