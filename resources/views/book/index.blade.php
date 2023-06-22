@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. $book->name)
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h2 class="card-title">
                            {{ $book->name }}
                        </h2>
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('quiz.question', ['id' => $book->id, 'type' => 2]) }}">{{ __('messages.question') }}</a>
                        @if($book->user_id === $user_id)
                            
                            <button type="button" class="btn btn-outline-secondary btn-sm" popovertarget="edit_book">
                                {{ __('messages.edit') }}
                            </button>
                            <div class="blur" id="edit_book" popover>
                                <button class="btn-close" popovertarget="edit_book" popovertargetaction="hide"></button>
                        		<form method="POST" action="{{ route('book.edit', ['id' => $book->id]) }}">
                                    @csrf
                                    <div class="input-group p-2">
                                        <input type="text" class="form-control" placeholder="{{ $book->name }}" name="name" value="{{ old('name') }}" />
                                        <input type="submit" class="btn btn-outline-secondary" value="{{ __('messages.update') }}" />
                                    </div>
                                </form>
                            </div>
                            
                            <a class="btn btn-outline-danger btn-sm" href="{{ route('book.delete', ['id' => $book->id]) }}">{{ __('messages.delete') }}</a>
                            <button type="button" class="btn btn-primary rounded-pill btn-sm" popovertarget="create_card">
                                {{ __('messages.add') }}
                            </button>
                            <div class="blur" id="create_card" popover>
                                <button class="btn-close" popovertarget="create_card" popovertargetaction="hide"></button>
                                <div class="container">
                                    <div class="row">
                                        <form method="POST" action="{{ route('card.create', ['book_id' => $book->id]) }}">
                                            @csrf
                                            <div class="input-group p-2">
                                                <input type="text" class="form-control" placeholder="{{ __('messages.front') }}" name="front[]" value="{{ old('front') }}" />
                                                <input type="text" class="form-control" placeholder="{{ __('messages.back') }}" name="back[]" value="{{ old('back') }}" />
                                                <input type="submit" class="btn btn-outline-primary" value="{{ __('messages.register') }}" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <p class="col text-center">or</p>
                                    </div>
                                    <div class="row">
                                        <div class="input-group p-2">
                                            <form method="POST" action="{{ route('card.process_image', ['book_id' => $book->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" class="form-control" name="img_data" accept=".jpeg, .png, .gif, .bmp, .webp, .raw, .ico, .pdf, .tiff">
                                                <input type="submit" class="btn btn-outline-primary" value="{{ __('messages.submit') }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <p>
                        {{ __('messages.created_by') }}: {{ $book->user->name }}
                        {{ __('messages.book_id') }}: {{ $book->id }} 
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach($cards as $card)
                    <div class="col-3">
                        <div class="card p-2 m-2">
                            <h4>{{ $card->front }}</h4>
                            <p>{{ $card->back}}</p>
                            @if($book->user_id === $user_id)
                                <div class="card-footer">
                                    <a class="btn btn-outline-danger btn-sm" href="{{ route('card.delete', ['card_id' => $card->id, 'book_id' => $book->id]) }}">{{ __('messages.delete') }}</a>
                                    <button class="btn btn-outline-secondary btn-sm" popovertarget="{{ $card->id }}">{{ __('messages.edit') }}</button>
                                    <div class="blur" id="{{ $card->id }}" popover>
                                        <form method="POST" action="{{ route('card.edit', ['id' => $card->id, 'book_id' => $book->id]) }}">
                                            @csrf
                                            <div class="input-group p-2">
                                                <input type="text" class="form-control" placeholder="{{ $card->front }}" name="front" value="{{ old('front') }}" />
                                                <input type="text" class="form-control" placeholder="{{ $card->back }}" name="back" value="{{ old('back') }}" />
                                                <input type="submit" class="btn btn-outline-primary" value="{{ __('messages.update') }}" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <h3 class="">{{ __('messages.score_history') }}</h3>
                @foreach($histories as $history)
                    {{ $history->result }}
                    /
                    {{ $history->max_points }}
                    |
                    {{ $history->created_at->format('Y/m/d') }}
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection