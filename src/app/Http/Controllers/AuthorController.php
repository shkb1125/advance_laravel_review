<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::simplePaginate(4);
        // dd($authors);
        return view('index', ['authors' => $authors]);
    }
    // データ追加用ページの表示
    public function add()
    {
        return view('add');
    }

    // 送信データの取得と保存
    public function create(AuthorRequest $request)
    {
        $form = $request->all();
        // dd($form);
        // createメソッドでdbにデータ追加
        Author::create($form);
        return redirect('/');
    }

    // データ編集ページの表示
    public function edit(Request $request)
    {
        $author = Author::find($request->id);
        return view('edit', ['form' => $author]);
    }

    // データ更新
    public function update(AuthorRequest $request)
    {
        $form = $request->all();
        // dd($form);
        unset($form['_token']);
        Author::find($request->id)->update($form);
        return redirect('/');
    }

    // データ削除用の表示
    public function delete(Request $request)
    {
        $author = Author::find($request->id);
        return view('delete', ['author' => $author]);
    }

    // データ削除
    public function remove(Request $request)
    {
        // dd($request->all());
        Author::find($request->id)->delete();
        return redirect('/');
    }

    // 検索
    public function find()
    {
        return view('find', ['input' => '']);
    }
    public function search(Request $request)
    {
        $item = Author::where('name', 'LIKE', "%{$request->input}%")->first();
        $param = [
            'input' => $request->input,
            'item' => $item,
        ];
        return view('find', $param);
    }

    public function bind(Author $author)
    {
        $data = [
            'item' => $author,
        ];
        return view('author.bind', $data);
    }

    // リダイレクト先の表示
    public function verror()
    {
        return view('verror');
    }

    public function relate(Request $request) //追記
    {
        $hasItems = Author::has('book')->get();
        $noItems = Author::doesntHave('book')->get();
        $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
        return view('author.index', $param);
    }
}
