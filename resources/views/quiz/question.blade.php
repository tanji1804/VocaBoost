@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.quiz'))
@section('content')
    <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
    {{ __('messages.question_from') }}
    <br>
    <form method="POST" action="{{ route('quiz.result') }}">
    @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <input type="hidden" name="shuf_cards" value="{{ $shuf_cards }}">
        @foreach($shuf_cards as $card)
            ----------------------------
            <br>
            {{ $card->front }} は？ 
            <br>
            @php
                $choises->shuffle();
                $counter = 0;
                if(count($shuf_cards) < 4){
                    $right_choise = mt_rand(0, count($shuf_cards)-1);
                }else{
                    $right_choise = mt_rand(0, 3);
                }
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