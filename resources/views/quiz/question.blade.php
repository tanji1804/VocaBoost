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
                $right_choise = mt_rand(0, 3);
            @endphp
            @foreach($choises as $choise)
                @if($counter == $right_choise)
                    <label>
                        <input type="radio" name="{{ $card->id }}" value="{{ $card->id }}">
                        {{ $card->back }}
                    </label>
                    <!--{{ $counter++ }}-->
                @elseif($card->id != $choise->id)
                    <label>
                        <input type="radio" name="{{ $card->id }}" value="{{ $choise->id }}">
                        {{ $choise->back }}
                    </label>
                    <!--{{ $counter++ }}-->
                @endif
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