@extends('layouts.app')

@section('title',__('messages.create_book'))

@section('content')
    <form>
        <input type="text" id="book_name">
        <input type="submit" value="{{ __('messages.register') }}">
    </form>
    
@endsection