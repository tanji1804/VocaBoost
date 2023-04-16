@extends('layouts.app')

@section('title',config('app.name','VocaBoost').__('messages.book'))
@section('content')
    {{ $book->book_name }}<br>
    {{ __('messages.book_id') }}: {{ $book->book_id }} {{ __('messages.created_by') }}: {{ $book->user_id }}<br>
    @if($book->user_id === $user_id)
        編集
    @endif
@endsection