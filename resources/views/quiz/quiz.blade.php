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
        <!--{{ shuffle($four_choises) }}-->
        @foreach($four_choises as $choise)
            {{ $choise->back }} 
        @endforeach
        <br>
        ----------------------------
        <br>
    @endforeach
@endsection