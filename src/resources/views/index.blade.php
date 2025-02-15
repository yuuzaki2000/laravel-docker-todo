{{-- 
@extends('app')

@section('title', 'index.blade.php')

@section('message')

@section('register')

@section('list')
    
@endsection
--}}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href={{asset('css/index.css')}} />
  </head>
  <body>
    <header>
      <div class="header">
        <p class="header__title">Todo</p>
      </div>
      @if (session('message'))
      <div class="header__report">
        <p class="header__report-text">{{session('message')}}</p>
      </div>
      @endif
      @if ($errors->has('content'))
      <div class="header__report">
        <p class="header__report-text">{{$errors->first('content')}}</p>
      </div>
      @endif
    </header>
    <main>
      <div class="container">
        <div class="upper">
          <form class="upper__form" action="/todos" method="post">
          @csrf
            <div>
              <input class="input-text" type="text" name="content" />
              <input class="btn" type="submit" value="作成" />
            </div>
          </form>
        </div>
        <div class="lower">
          <div><p class="lower__title">Todo</p></div>
          @foreach ($todos as $todo)
          <form action="/todos/update" method="post">
            @method('PATCH')
            @csrf
            <div class="item">
              <input type="text" name="content" value={{$todo['content']}}>
              <input type="hidden" name="id" value={{$todo['id']}}>
              <div class="btn-container">
                  <input  type="submit" class="item__btn--update" value="更新"></input>
                  <button class="item__btn--delete">削除</button>
              </div>
            </div>
          </form>
          @endforeach
        </div>
      </div>
    </main>
  </body>
</html>
