<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    //
    public function index(){
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    public function store(TodoRequest $request){
        $todo = $request->all();
        Todo::create($todo);
        return redirect('/')->with('message', "Todoが作成されました");
    }

    public function update(TodoRequest $request){
        $todo = $request->all();
        unset($request['_token']);
        Todo::find($request->id)->update($todo);
        return redirect('/');
    }
}
