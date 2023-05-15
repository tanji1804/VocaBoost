@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.result'))
@section('content')
    @switch($type)
        @case(0)
            {{ __('messages.all_books') }}
            {{ __('messages.question_from') }}
            <a href="{{ route('quiz.question', ['type' => $type]) }}">{{ __('messages.again') }}</a>
            @break
        @case(1)
            {{ __('messages.my_books') }}
            {{ __('messages.question_from') }}
            <a href="{{ route('quiz.question', ['type' => $type]) }}">{{ __('messages.again') }}</a>
            @break
        @case(2)
            <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
            {{ __('messages.question_from') }}
            <a href="{{ route('quiz.question', ['id' => $book->id, 'type' => $type]) }}">{{ __('messages.again') }}</a>
            @break
    @endswitch
    <br>
    {{ $max_points }}点中
    {{ $points }}点
    <br>
    @foreach($histories as $history)
        {{ $history->result }}
        /
        {{ $history->max_points }}
        |
        {{ $history->created_at->format('Y/m/d') }}
        <br>
    @endforeach
@endsection