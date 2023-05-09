@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.result'))
@section('content')
    <a href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>から
    <br>
    {{ $max_points }}点中
    {{ $points }}点
    <br>
    <a href="{{ route('quiz.question', ['id' => $book->id]) }}">{{ __('messages.again') }}</a>
@endsection