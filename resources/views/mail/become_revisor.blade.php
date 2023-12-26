<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
</head>
<body>
    <div>
        <h1>{{__('ui.userWork')}}</h1>
        <h2>{{__('ui.data')}}</h2>
        <p>{{__('ui.name')}}: {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
        <p>{{__('ui.revOK')}}</p>
        <a href="{{route('make.revisor',compact('user'))}}">{{__('ui.revOK2')}}</a>
    </div>
</body>
</html>