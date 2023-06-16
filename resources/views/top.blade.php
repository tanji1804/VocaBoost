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
    <button popovertarget="create_book">+</button>
    <div id="create_book" popover>
        <form method="POST" action="{{ route('book.create') }}">
            @csrf
            <input type="text" placeholder="{{ __('messages.book_name') }}" name="name" value="{{ old('name') }}" />
            <input type="submit" id="ok" onclick="okfunc()" value="{{ __('messages.register') }}" />
        </form>
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