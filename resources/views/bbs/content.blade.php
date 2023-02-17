<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        .link-hover:hover {opacity: 70%;}
    </style>
</head>
<body class="bg-blue-100">
    <div class="w-11/12 max-w-screen-md m-auto">
        <div class="flex justify-between mt-2">
            <h1 class="text-xl font-bold mt-5 "><a href="{{route('thread.index')}}">{{config('app.name')}}</a></h1>
            <div class="flex mt-5">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <p class="mr-5 px-2 py-1 rounded bg-yellow-600 text-white font-bold link-hover cursor-pointer">
                        {{ Auth::user()->name }}
                    </p>
                    <a class="px-2 py-1 rounded bg-yellow-600 text-white font-bold link-hover cursor-pointer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>


            <div class="bg-white rounded-md mt-1 mb-5 p-3">

                <div>
                    <p class="mb-2 text-xs">{{$threads->created_at}} ＠{{$threads->user_name}}</p>
                    <p class="mb-2 text-xl font-bold">{{$threads->message_title}}</p>
                    <p class="mb-2 m-w-max whitespace-pre-line">{{$threads->message}}</p>
                </div>
                <div class="flex mt-5">
                    <form class="flex flex-auto" action="{{route('store',['thread'=>$threads->id])}}" method="get">
                        @csrf
                        <input type="hidden" name="thread_id" value={{$threads->id}}>
                        <input class="border rounded px-2 w-2/5 md:w-4/12 text-sm md:text-base" type="text" name="user_name" placeholder="UserName" value="{{$user['name']}}" required>
                        <input class="border rounded px-2 ml-2 w-3/5 md:w-10/12 text-sm md:text-base" type="text" name="message" placeholder="ReplyMessage" required>
                        <input class="px-2 py-1 ml-2 rounded bg-green-600 text-white font-bold link-hover cursor-pointer" type="submit" value="返信">
                    </form>

                </div>



                <hr class="mt-2 m-auto">
                <div class="flex justify-end">
                    <div class="w-11/12">
                        @foreach ($threads->replies as $reply)
                            <div>
                                <p class="mt-2 text-xs">{{$reply->created_at}} ＠{{$reply->user_name}}</p>
                                <p class="my-2 text-sm">{{$reply->message}}</p>
                            </div>

                            <div class="flex mt-5">
                                {{-- 削除 --}}
                                @if ($threads->user_identifier == $user['identifier'])
                                    <form action="{{route('destroy', ['reply'=>$reply->id])}}" method="get">
                                        @csrf
                                        <input class="px-2 py-1 ml-2 rounded bg-red-500 text-white font-bold link-hover cursor-pointer" type="submit" value="削除" onclick="return Check()">
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

    </div>
</body>
</html>
