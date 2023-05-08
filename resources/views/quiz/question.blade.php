@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
    {{ __('messages.question_from') }}
    <br>
    <form method="POST" action="{{ route('quiz.result') }}">
    @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <input type="hidden" name="max_points" value="{{ count($shuf_cards) }}">
        @foreach($book->cards->shuffle() as $card)
            ----------------------------
            <br>
            {{ $card->front }} は？ 
            <br>
            @foreach($card->getChoiseCards(3) as $choise)
                    <label>
                        <input type="radio" name="{{ $choise->id }}" value="{{ $choise->id }}">
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