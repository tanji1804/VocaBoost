@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
    {{ __('messages.question_from') }}
    <br>
    <form method="POST" action="{{ route('quiz.result') }}">
    @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        @foreach($shuf_cards as $card)
            ----------------------------
            <br>
            {{ $card->front }} は？ 
            <br>
            @php
                shuffle($choises);
                $counter = 0;
                if(count($shuf_cards) < 3){
                    $right_choise = mt_rand(0, count($shuf_cards)-1);
                }else{
                    $right_choise = mt_rand(0, 3);
                }
            @endphp
            {{ $right_choise }}
            @foreach($choises as $choise)
                @if($counter == $right_choise)
                    <label>
                        <input type="radio" name="{{ $card->id }}" value="{{ $card->id }}">
                        {{ $card->back }}
                    </label>
                @elseif($card->id != $choise->id)
                    <label>
                        <input type="radio" name="{{ $card->id }}" value="{{ $choise->id }}">
                        {{ $choise->back }}
                    </label>
                @endif
                @if($counter == 4)
                    @break
                @endif
                <!--{{ $counter++ }}-->
            @endforeach
            <label>
                <input type="radio" name="{{ $card->id }}" value="0">
                {{ __('messages.dont_know') }}
            </label>
            <br>
            ----------------------------
            <br>
        @endforeach
        <input type="submit">
    </form>
@endsection