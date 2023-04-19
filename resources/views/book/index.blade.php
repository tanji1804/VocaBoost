@extends('layouts.app')

@section('title',config('app.name','VocaBoost').__('messages.book'))
@section('content')
    {{ $book->book_name }}<br>
    {{ __('messages.created_by') }}: {{ $book->user_id }}<br>
    {{ __('messages.book_id') }}: {{ $book->id }} <br>
    @if($book->user_id === $user_id)
        <button onclick="return popup()" >{{ __('messages.edit') }}</button> 
        <a href="{{ route('book.delete', ['id' => $book->id]) }}">{{ __('messages.delete') }}</a>
        <div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            <br>
            <form method="POST" action="{{ route('book.edit', ['id' => $book->id]) }}">
                @csrf
                <input type="text" name="book_name" value="{{ old('book_name') }}" />
                <input type="submit" id="ok" onclick="okfunc()" value="{{ __('messages.register') }}" />
            </form>
            <button id="no" onclick="nofunc()">キャンセル</button>
        </div>
        <div>
            <input type="button" value="+" name="create_card_button" onclick="return popup2()" />
        </div>
        <div id="popup2" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            <br>
            <form method="POST" action="{{ route('book.create') }}">
                @csrf
                <input type="text" name="a_card" value="{{ old('a_card') }}" />
                <input type="text" name="b_card" value="{{ old('b_card') }}" />
                <input type="submit" id="ok" onclick="okfunc2()" value="{{ __('messages.register') }}" />
            </form>
            <button id="no" onclick="nofunc2()">キャンセル</button>
        </div>

    @endif
@endsection