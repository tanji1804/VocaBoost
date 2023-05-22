@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.admin_page'))
@section('content')
    @foreach($users as $user)
        id: {{ $user->id }}, {{ $user->name }}<br>
    @endforeach
@endsection