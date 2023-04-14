@extends('layouts.app')

@section('title',config('app.name','VocaBoost').__('messages.book'))
@section('content')
    {{ $book->book_name }}<br>
    bookID: {{ $book->book_id }}<br>
    @if($book->user_id === $user_id)
        編集
    @endif
@endsection