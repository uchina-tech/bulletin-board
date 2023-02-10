<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $replies = new Reply;
        $form = $request->all();
        $replies->fill($form)->save();

        return redirect(RouteServiceProvider::thread);
    }
}
