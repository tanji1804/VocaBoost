@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '.__('messages.top'))
@section('content')

@auth
    <div class="container p-3">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-start">
                    <div class="col-3">
                        <h2>{{ __('messages.my_books') }}</h2>
                    </div>
                    <div class="col-2">
                        <p><a class="btn btn-outline-dark" href="{{ route('quiz.question', ['type' => 1]) }}">
                                {{ __('messages.from_all') }}{{ __('messages.question') }}
                        </a></p>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary rounded-pill" popovertarget="create_book">
                            {{ __('messages.add') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card-group">
                        @foreach($my_books as $book)
                            <div class="col-3 p-2">
                                <a class="btn btn-primary w-100" href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="create_book" class="blur" popover>
        <button class="btn-close" popovertarget="blur" popovertargetaction="hide"></button>
        <form method="POST" action="{{ route('book.create') }}">
            @csrf
            <div class="input-group p-2">
                <input type="text" class="form-control" placeholder="{{ __('messages.book_name') }}" name="name" value="{{ old('name') }}" />
                <input type="submit" class="btn btn-outline-primary" value="{{ __('messages.register') }}" />
            </div>
        </form>
    </div>
            
@endauth
<div class="container p-3">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-start">
                <div class="col-3">
                    <h2>{{ __('messages.all_books') }}</h2>
                </div>
                <div class="col-2">
                    <p><a class="btn btn-outline-dark" href="{{ route('quiz.question', ['type' => 0]) }}">
                            {{ __('messages.from_all') }}{{ __('messages.question') }}
                    </a></p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card-group">
                    @foreach($all_books as $book)
                        <div class="col-3 p-2">
                            <a class="btn btn-primary w-100" href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
                            {{ __('messages.created_by') }}: 
                            {{ $book->user->name }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection