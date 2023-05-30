@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.admin_page'))
@section('content')
    @foreach($cards as $card)
        id: {{ $card->id }}, front:{{ $card->front }}, back:{{ $card->back }}
        <br>
    @endforeach
@endsection