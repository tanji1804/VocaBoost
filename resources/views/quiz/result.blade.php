@extends('layouts.app')

@section('title',config('app.name','VocaBoost')." | ".__('messages.result'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @switch($type)
                        @case(0)
                            <h2>{{ __('messages.all_books') }}</h2>
                            <p>{{ __('messages.question_from') }}</p>
                            <a class="btn btn-outline-info" href="{{ route('quiz.question', ['type' => $type]) }}">{{ __('messages.again') }}</a>
                            @break
                        @case(1)
                            <h2>{{ __('messages.my_books') }}</h2>
                            <p>{{ __('messages.question_from') }}</p>
                            <a class="btn btn-outline-info" href="{{ route('quiz.question', ['type' => $type]) }}">{{ __('messages.again') }}</a>
                            @break
                        @case(2)
                            <a class="h2" href="{{ route('book.index', ['id' => $book->id]) }}">{{ $book->name }}</a>
                            <p>{{ __('messages.question_from') }}</p>
                            <a class="btn btn-outline-info" href="{{ route('quiz.question', ['id' => $book->id, 'type' => $type]) }}">{{ __('messages.again') }}</a>
                            @break
                    @endswitch
                    <a class="btn btn-outline-success" href="{{ url('/') }}">{{ __('messages.return_to_top') }}</a>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <h3>
                                {{ $max_points }}{{ __('messages.max_points') }}
                                {{ $points }}{{ __('messages.points') }}
                            </h3>
                        </div>
                        @foreach($histories as $history)
                            <div class="row">
                                {{ $history->result }}
                                /
                                {{ $history->max_points }}
                                |
                                {{ $history->created_at->format('Y/m/d') }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection