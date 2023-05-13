@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    @switch($type)
        @case(0)
            {{ __('messages.all_books') }}
            @break
        @case(1)
            {{ __('messages.my_books') }}
            @break
        @case(2)
            <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
            @break
    @endswitch
    {{ __('messages.question_from') }}
    <br>
    <form method="POST" action="{{ route('quiz.result', ['book_id' => $book->id,
                                                        'max_points' => $max_points]) }}">
    @csrf
        @foreach($book->cards->shuffle() as $card)
            ----------------------------
            <br>
            {{ $card->front }} は？ 
            <br>
            @foreach($card->getChoiseCards(4, $type) as $choise)
                    <label>
                        <input type="radio" name="{{ $card->id }}" value="{{ $choise->id }}">
                        {{ $choise->back }}
                    </label>
            @endforeach
            <label>
                <input type="radio" name="{{ $card->id }}" value="null">
                {{ __('messages.dont_know') }}
            </label>
            <br>
            ----------------------------
            <br>
        @endforeach
        <input type="submit">
    </form>
@endsection