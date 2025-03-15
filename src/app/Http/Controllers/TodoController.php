<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\Category;


class TodoController extends Controller
{
    //
    public function index(){
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos','categories'));
    }

    public function store(TodoRequest $request){
        $todo = $request->only(['category_id', 'content']);
        Todo::create($todo);
        return redirect('/')->with('message', "Todoが作成されました");
    }

    public function update(TodoRequest $request){
        $todo = $request->all();
        unset($request['_token']);
        Todo::find($request->id)->update($todo);
        return redirect('/')->with('message', "Todoが更新されました");
    }

    public function destroy(Request $request){
        Todo::find($request->id)->delete();
        return redirect('/')->with('message', "Todoが削除されました");
    }

    public function search(Request $request){
        $todos = Todo::with('category')->CategorySearch($request->category_id)->where('content', 'LIKE', "%{$request->keyword}%")->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }
}
