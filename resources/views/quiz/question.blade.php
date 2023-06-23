@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @switch($type)
                    @case(0)
                        {{ __('messages.all_books') }}
                        <form method="POST" action="{{ route('quiz.result', ['max_points' => $max_points,
                                                                            'type' => $type,
                                                                            ]) }}">
                        @break
                    @case(1)
                        {{ __('messages.my_books') }}
                        <form method="POST" action="{{ route('quiz.result', ['max_points' => $max_points,
                                                                            'type' => $type,
                                                                            ]) }}">
                        @break
                    @case(2)
                        <a class="h2" href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
                        <form method="POST" action="{{ route('quiz.result', ['book_id' => $book->id,
                                                                            'max_points' => $max_points,
                                                                            'type' => $type,
                                                                            ]) }}">
                        @break
                @endswitch
                <p>
                    {{ __('messages.question_from') }}
                </p>
            </div>
            <div class="card-body">
                @csrf
                <div id="carouselExampleControls" class="carousel carousel-dark slide">
                    <div class="carousel-inner">
                        @foreach($question_book->shuffle() as $key => $card)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $card->front }} は？</h4>
                                        <p>{{ $key+1 }} of {{ $max_points }}</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                @foreach($card->getChoiseCards(4, $type) as $choise)
                                                    <div class="col-2 m-1 border ">
                                                        <label class="d-flex justify-content-center">
                                                            <input type="radio" name="{{ $card->id }}" value="{{ $choise->id }}">
                                                            {{ $choise->back }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-3 m-1 border">
                                                    <label class="d-flex justify-content-center">
                                                        <input type="radio" name="{{ $card->id }}" value="null">
                                                        {{ __('messages.dont_know') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class=="card-footer">
                <div class="row justify-content-center p-3">
                    <div class="col-1">
                        <button type="button" class="btn btn-outline-info" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="visually-hidden">前へ</span>
                            <span class="btn-text text-info">前へ</span>
                        </button>
                    </div>
                    
                    <div class="col-1">
                        <input type="submit" class="btn btn-outline-primary">
                    </div>
                    
                    <div class="col-1">
                        <button type="button" class="btn btn-outline-info" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="visually-hidden">次へ</span>
                            <span class="btn-text text-info">次へ</span>
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection