@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.admin_page'))
@section('content')
    <a href="admin/users">{{ __('messages.user') }}</a>
    <br>
    <a href="admin/books">{{ __('messages.book') }}</a>
@endsection