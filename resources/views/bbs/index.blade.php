<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    <h1><a href="{{route('thread.index')}}">{{config('app.name')}}</a></h1>
    <div>
        <form action="" method="POST">
            <input type="hidden" name="user_identifier">
            <div class="flex">
                <p class="font-bold">名前</p>
                <input class="border rounded px-2 ml-2" type="text" name="user_name">
            </div>
            <div class="flex mt-2">
                <p class="font-bold">件名</p>
                <input class="border rounded px-2 ml-2 flex-auto" type="text" name="message_title">
            </div>
            <div class="flex flex-col mt-2">
                <p class="font-bold">本文</p>
                <textarea class="border rounded px-2" name="message" required></textarea>
            </div>
            <div>
                <input type="submit" value="投稿">
            </div>
        </form>
    </div>
</div>
</body>
</html>
