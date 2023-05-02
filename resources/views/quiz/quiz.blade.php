@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    {{ $book->name }}
    {{ __('messages.question_from') }}
    <br>
    @foreach($card_keys as $key)
        ----------------------------
        <br>
        {{ $cards[$key]->front }}
        は？
        <br>
        [{{ $cards[$key]->back }}]
        [{{ $cards[rand(0, $cards_num)]->back }}]
        [{{ $cards[rand(0, $cards_num)]->back }}]
        [{{ $cards[rand(0, $cards_num)]->back }}]
        <br>
        ----------------------------
        <br>
    @endforeach
@endsection