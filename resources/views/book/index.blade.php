@extends('layouts.app')

@section('title',config('app.name','VocaBoost').__('messages.book'))
@section('content')
    {{ $book->name }}
    {{ __('messages.created_by') }}: {{ $book->user_id }}
    {{ __('messages.book_id') }}: {{ $book->id }} 
    <br>
    <a href="{{ route('quiz.question', ['id' => $book->id]) }}">{{ __('messages.question') }}</a>
    <button onclick="return popup()" >{{ __('messages.edit') }}</button> 
    <a href="{{ route('book.delete', ['id' => $book->id]) }}">{{ __('messages.delete') }}</a>
    <br>
    @foreach($cards as $card)
        {{ $card->front }} が {{ $card->back }}
        <a href="{{ route('card.delete', ['card_id' => $card->id, 'book_id' => $book->id]) }}">{{ __('messages.delete') }}</a>
            <form method="POST" action="{{ route('card.edit', ['id' => $card->id]) }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="text" placeholder="{{ __('messages.front') }}" name="front" value="{{ old('front') }}" />
                <input type="text" placeholder="{{ __('messages.back') }}" name="back" value="{{ old('back') }}" />
                <input type="submit" value="{{ __('messages.update') }}" />
            </form>
    @endforeach
    @if($book->user_id === $user_id)
        <div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            <br>
            <form method="POST" action="{{ route('book.edit', ['id' => $book->id]) }}">
                @csrf
                <input type="text" placeholder="{{ $book->name }}" name="name" value="{{ old('name') }}" />
                <input type="submit" id="ok" onclick="okfunc()" value="{{ __('messages.update') }}" />
            </form>
            <button id="no" onclick="nofunc()">{{ __('messages.cancel') }}</button>
        </div>
        <div>
            <input type="button" value="+" name="create_card_button" onclick="return popup2()" />
        </div>
        <div id="popup2" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            <br>
            <form method="POST" action="{{ route('card.create') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="text" placeholder="{{ __('messages.front') }}" name="front" value="{{ old('front') }}" />
                <input type="text" placeholder="{{ __('messages.back') }}" name="back" value="{{ old('back') }}" />
                <input type="submit" id="ok" onclick="okfunc2()" value="{{ __('messages.register') }}" />
            </form>
            <button id="no" onclick="nofunc2()">{{ __('messages.cancel') }}</button>
        </div>
    @endif
@endsection