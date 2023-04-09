@extends('layouts.app')

@section('title',__('messages.create_book'))

@section('content')
    <form action="{{ route('book.create') }}" method="post">
        <input type="text" name="book_title" value="{{ old('book_title') }}">
        <input type="submit" value="{{ __('messages.register') }}">
    </form>
    
@endsection