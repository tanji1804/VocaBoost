@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.image_create'))
@section('content')
    {{ $text }}
@endsection