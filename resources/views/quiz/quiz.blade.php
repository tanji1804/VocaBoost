@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
    {{ __('messages.question_from') }}
    <br>
    <form method="POST" action="{{ route('quiz.result') }}">
    @csrf
        @foreach($shuf_cards as $card)
            ----------------------------
            <br>
            {{ $card->front }} は？ 
            <br>
            @php
                shuffle($choises);
                $counter = 0;
            @endphp
            @foreach($choises as $choise)
                <!--{{ $counter++ }}-->
                <label>
                    <input type="radio" name="{{ $card->id }}" value="{{ $choise->id }}">
                    {{ $choise->back }}
                </label>
                @if($counter == 4)
                    @break
                @endif
            @endforeach
            <br>
            ----------------------------
            <br>
        @endforeach
        <input type="submit">
    </form>
    
@endsection