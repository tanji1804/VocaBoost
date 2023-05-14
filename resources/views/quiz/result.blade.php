@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.result'))
@section('content')
    @switch($type)
        @case(0)
            {{ __('messages.all_books') }}
            {{ __('messages.question_from') }}
            @break
        @case(1)
            {{ __('messages.my_books') }}
            {{ __('messages.question_from') }}
            @break
        @case(2)
            <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
            {{ __('messages.question_from') }}
            <a href="{{ route('quiz.question', ['id' => $book->id]) }}">{{ __('messages.again') }}</a>
            @break
    @endswitch
    <br>
    {{ $max_points }}点中
    {{ $points }}点
    <br>
@endsection