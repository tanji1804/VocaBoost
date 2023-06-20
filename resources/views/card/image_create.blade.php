@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' | '. __('messages.load_from_image'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col" style="position: relative;">
                <img src="data:{{ $img_type }};base64,{{ $img_data }}"style="-webkit-user-drag: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;" />
                    <!-- 重ねる要素のコンテンツ -->
                    @foreach ($coordinates as $coordinate)
                        <div style="position: absolute; left: {{ $coordinate['boundingPoly']['vertices'][0]['x'] }}px; top: {{ $coordinate['boundingPoly']['vertices'][0]['y'] }}px;">
                            <h4 style="min-width: 100%; font-size: 15px; border: red solid 1px; color: transparent;">{{ $coordinate['description'] }}</h4>
                        </div>
                    @endforeach
            </div>
            <div class="col">
                <button class="w-25" id="add-button">{{ __('messages.add_input') }}</button>
                <form method="POST" action="{{ route('card.create', ['book_id' => $book_id]) }}">
                    @csrf
                    <div id="input-fields">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="{{ __('messages.front') }}" name="front[]" value="{{ old('front.0') }}" />
                            <input type="text" class="form-control" placeholder="{{ __('messages.back') }}" name="back[]" value="{{ old('back.0') }}" />
                        </div>
                    </div>
                    <input type="submit" value="{{ __('messages.register') }}" />
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/add-btn.js') }}"></script>
@endsection