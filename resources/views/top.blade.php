@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '.__('messages.top'))
@section('content')

@auth
    <strong>{{ __('messages.my_books') }}</strong>
    <a href="{{ route('quiz.question', ['type' => 1]) }}">
        {{ __('messages.from_all') }}{{ __('messages.question') }}
    </a>
    <br>
    @foreach($my_books as $book)
        <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a> 
        <br>
    @endforeach
    <div>
        <input type="button" value="+" name="create_book_button" onclick="return popup()" />
    </div>
    <div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
        <br>
        <form method="POST" action="{{ route('book.create') }}">
            @csrf
            <input type="text" placeholder="{{ __('messages.book_name') }}" name="name" value="{{ old('name') }}" />
            <input type="submit" id="ok" onclick="okfunc()" value="{{ __('messages.register') }}" />
        </form>
        <button id="no" onclick="nofunc()">キャンセル</button>
    </div>
@endauth
<div>
    <br><strong>{{ __('messages.all_books') }}</strong>
    <a href="{{ route('quiz.question', ['type' => 0]) }}">
        {{ __('messages.from_all') }}{{ __('messages.question') }}
    </a>
    <br>
    @foreach($all_books as $book)
        <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
        {{ __('messages.created_by') }}: 
        {{ $book->user->name }}
        <br>
    @endforeach
</div>

@endsection