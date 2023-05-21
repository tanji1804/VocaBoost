@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. $book->name)
@section('content')
    {{ $book->name }}
    {{ __('messages.created_by') }}: {{ $book->user_id }}
    {{ __('messages.book_id') }}: {{ $book->id }} 
    <br>
    <a href="{{ route('quiz.question', ['id' => $book->id, 'type' => 2]) }}">{{ __('messages.question') }}</a>
    @if($book->user_id === $user_id)
        
        <label class="open" for="pop-up1">{{ __('messages.edit') }}</label>
        <input type="checkbox" id="pop-up1">
        <div class="overlay">
        	<div class="window">
        		<label class="close" for="pop-up1">×</label>
        		<form method="POST" action="{{ route('book.edit', ['id' => $book->id]) }}">
                @csrf
                <input type="text" placeholder="{{ $book->name }}" name="name" value="{{ old('name') }}" />
                <input type="submit" id="ok" onclick="okfunc()" value="{{ __('messages.update') }}" />
            </form>
        	</div>
        </div>
        
    @endif
    <a href="{{ route('book.delete', ['id' => $book->id]) }}">{{ __('messages.delete') }}</a>
    <br>
    @foreach($cards as $card)
        <div class="word_card">
          <div class="first-content">
            <span>{{ $card->front }}</span>
          </div>
          <div class="second-content">
            <span>{{ $card->back}}</span>
          </div>
        </div>
        
        
        @if($book->user_id === $user_id)
            <a href="{{ route('card.delete', ['card_id' => $card->id, 'book_id' => $book->id]) }}">{{ __('messages.delete') }}</a>
                <form method="POST" action="{{ route('card.edit', ['id' => $card->id, 'book_id' => $book->id]) }}">
                    @csrf
                    <input type="text" placeholder="{{ __('messages.front') }}" name="front" value="{{ old('front') }}" />
                    <input type="text" placeholder="{{ __('messages.back') }}" name="back" value="{{ old('back') }}" />
                    <input type="submit" value="{{ __('messages.update') }}" />
                </form>
        @endif
    @endforeach
    @if($book->user_id === $user_id)
        <div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            <br>
        </div>
        <div>
            <input type="button" value="+" name="create_card_button" onclick="return popup2()" />
        </div>
        <div id="popup2" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            <br>
            <form method="POST" action="{{ route('card.create', ['book_id' => $book->id]) }}">
                @csrf
                <input type="text" placeholder="{{ __('messages.front') }}" name="front" value="{{ old('front') }}" />
                <input type="text" placeholder="{{ __('messages.back') }}" name="back" value="{{ old('back') }}" />
                <input type="submit" id="ok" onclick="okfunc2()" value="{{ __('messages.register') }}" />
            </form>
            <button id="no" onclick="nofunc2()">{{ __('messages.cancel') }}</button>
        </div>
    @endif
    @foreach($histories as $history)
        {{ $history->result }}
        /
        {{ $history->max_points }}
        |
        {{ $history->created_at->format('Y/m/d') }}
        <br>
    @endforeach
@endsection