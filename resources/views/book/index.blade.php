@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. $book->name)
@section('content')
    {{ $book->name }}
    {{ __('messages.created_by') }}: {{ $book->user_id }}
    {{ __('messages.book_id') }}: {{ $book->id }} 
    <br>
    <a href="{{ route('quiz.question', ['id' => $book->id, 'type' => 2]) }}">{{ __('messages.question') }}</a>
    @if($book->user_id === $user_id)
        <button popovertarget="edit_book">{{ __('messages.edit') }}</button>
        <div id="edit_book" popover>
        		<form method="POST" action="{{ route('book.edit', ['id' => $book->id]) }}">
                    @csrf
                    <input type="text" placeholder="{{ $book->name }}" name="name" value="{{ old('name') }}" />
                    <input type="submit" id="ok" onclick="okfunc()" value="{{ __('messages.update') }}" />
                </form>
        </div>
    <a href="{{ route('book.delete', ['id' => $book->id]) }}">{{ __('messages.delete') }}</a>
    @endif
    <br>
    @foreach($cards as $card)
    ___
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
            <button popovertarget="{{ $card->id }}">{{ __('messages.edit') }}</button>
            <div id="{{ $card->id }}" popover>
                <form method="POST" action="{{ route('card.edit', ['id' => $card->id, 'book_id' => $book->id]) }}">
                    @csrf
                    <input type="text" placeholder="{{ $card->front }}" name="front" value="{{ old('front') }}" />
                    <input type="text" placeholder="{{ $card->back }}" name="back" value="{{ old('back') }}" />
                    <input type="submit" value="{{ __('messages.update') }}" />
                </form>
            </div>
        @endif
    <br>
    ___
    <br>
    @endforeach
    @if($book->user_id === $user_id)
        <button popovertarget="create_card">+</button>
        <div id="create_card" popover>
            <form method="POST" action="{{ route('card.create', ['book_id' => $book->id]) }}">
                @csrf
                <input type="text" placeholder="{{ __('messages.front') }}" name="front" value="{{ old('front') }}" />
                <input type="text" placeholder="{{ __('messages.back') }}" name="back" value="{{ old('back') }}" />
                <input type="submit" value="{{ __('messages.register') }}" />
            </form>
            <br>
            or
            <br>
            <form method="POST" action="{{ route('card.process_image', ['book_id' => $book->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="file" class="form-control" name="img_data" accept=".jpeg, .png, .gif, .bmp, .webp, .raw, .ico, .pdf, .tiff">
                <input type="submit" value="{{ __('messages.submit') }}">
            </form>
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