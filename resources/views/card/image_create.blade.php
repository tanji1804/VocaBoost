@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.load_from_image'))
@section('content')
    <div style="position: relative;">
        <img src="data:{{ $img_type }};base64,{{ $img_data }}"style="-webkit-user-drag: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;" />
            <!-- 重ねる要素のコンテンツ -->
            @foreach ($coordinates as $coordinate)
                <div style="position: absolute; left: {{ $coordinate['boundingPoly']['vertices'][0]['x'] }}px; top: {{ $coordinate['boundingPoly']['vertices'][0]['y'] }}px;">
                    <h4 style="min-width: 100%; font-size: 15px; border: red solid 1px; color: transparent;">{{ $coordinate['description'] }}</h4>
                </div>
            @endforeach
    </div>
@endsection