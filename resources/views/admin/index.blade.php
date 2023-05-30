@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.admin_page'))
@section('content')
    <a href="users">{{ __('messages.user') }}</a>
    <br>
    <a href="books">{{ __('messages.book') }}</a>
@endsection