@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.admin_page'))
@section('content')
    @foreach($books as $book)
        <a href="{{ route('admin.cards', ['book_id' => $book->id]) }}">id: {{ $book->id }}, {{ $book->name }}</a>
        <br>
    @endforeach
@endsection