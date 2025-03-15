<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        return view('category', [ 'categories' => $categories]);
    }

    public function store(Request $request){
        $form = $request->only(['name']);
        Category::create($form);
        return redirect('/categories')->with('message', 'カテゴリーを作成しました');
    }

    public function destroy(Request $request){
        Category::find($request->id)->delete();
        return redirect('/categories')->with('message', 'カテゴリーを削除しました');
    }
}
