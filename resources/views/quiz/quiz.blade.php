@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    {{ $book->name }}
    {{ __('messages.question_from') }}
    <br>
    @foreach($shuf_cards as $card)
        ----------------------------
        <br>
        {{ $card->front }} は？ 
        <br>
        @for($i = 0; $i < 4; $i++)
            [{{ $shuf_cards[mt_rand(0, $cards_num)]->back }}] 
        @endfor
        <br>
        ----------------------------
        <br>
    @endforeach
@endsection