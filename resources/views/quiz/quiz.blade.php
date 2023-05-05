@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    {{ $book->name }}
    {{ __('messages.question_from') }}
    <br>
    <form method="POST" action="{{ route('quiz.result') }}">
    @csrf
        @foreach($shuf_cards as $card)
            ----------------------------
            <br>
            {{ $card->front }} は？ 
            <br>
            ----------------------------
            <br>
        @endforeach
        <input type="submit">
    </form>
    
@endsection