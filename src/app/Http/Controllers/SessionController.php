<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSes(Request $request)
    {
        $data = $request->session()->get('txt');
        return view('/session', ['data' => $data]);
    }
    // postで値が送信されると起動
    public function postSes(Request $request)
    {
        $txt = $request->input;
        // 値にキーという名前をつけて保存する キー：'txt' 値:$txt
        $request->session()->put('txt', $txt);
        // /sessionにリダイレクト
        return redirect('/session');
    }
}
