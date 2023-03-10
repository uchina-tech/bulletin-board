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

    <div class="bg-white rounded-md mt-5 p-3">
        <form action="{{route('thread.store')}}" method="POST">
            @csrf
            <input type="hidden" name="user_identifier" value="{{$user['identifier']}}">
            <div class="flex">
                <p class="font-bold">??????</p>
                <input class="border rounded px-2 ml-2" type="text" name="user_name" value="{{$user['name']}}" required>
            </div>
            <div class="flex mt-2">
                <p class="font-bold">??????</p>
                <input class="border rounded px-2 ml-2 flex-auto" type="text" name="message_title" required autofocus>
            </div>
            <div class="flex flex-col mt-2">
                <p class="font-bold">??????</p>
                <textarea class="border rounded px-2" name="message" required></textarea>
            </div>
            <div class="flex justify-end mt-2">
                <input class="my-2 px-2 py-1 rounded bg-blue-300 text-blue-900 font-bold link-hover cursor-pointer" type="submit" value="??????">
            </div>
        </form>
    </div>
    <p class="mt-5">{{ $threads->links() }}</p>
        @foreach ($threads as $thread)
        <a href="{{ url('content', ['thread'=>$thread->id]) }}">
            <div class="bg-white rounded-md mt-1 mb-5 p-3">
                <div>
                    <p class="mb-2 text-xs">{{$thread->created_at}} ???{{$thread->user_name}}</p>
                    <p class="mb-2 text-xl font-bold">{{$thread->message_title}}</p>
                    <p class="mb-2 m-w-max whitespace-pre-line">{{$thread->message}}</p>
                </div>
                <div class="flex mt-5">
                    @if ($thread->user_identifier == $user['identifier'])
                        <form action="{{route('thread.destroy', ['thread'=>$thread->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="px-2 py-1 ml-2 rounded bg-red-500 text-white font-bold link-hover cursor-pointer" type="submit" value="??????" onclick="return Check()">
                        </form>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    <p class="my-5">{{ $threads->links() }}</p>
</div>

<script type="text/javascript">
    function Check(){
        var checked = confirm("??????????????????????????????");
        if (checked == true) { return true; } else { return false; }
    }
</script>
</body>
</html>
