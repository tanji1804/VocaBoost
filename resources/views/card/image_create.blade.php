@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.image_create'))
@section('content')
    <div class="card" style="position: relative; width: 750px; height: 885px; background-image: url('https://storage.cloud.google.com/bucket-warm-lane-387513/IMG_7507.img.PNG');">
        <!-- 重ねたい要素 -->
        @foreach ($coordinates as $coordinate)
        <div class="card-item" style="position: absolute; left: {{ $coordinate['boundingPoly']['vertices'][0]['x'] }}px; top: {{ $coordinate['boundingPoly']['vertices'][0]['y'] }}px;">
            <h4 style="font-size: 20px; font-weight: bold; color: red;">{{ $coordinate['description'] }}</h4>
        </div>
        @endforeach
    </div>
@endsection