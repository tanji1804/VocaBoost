@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' '.__('messages.top'))
@section('content')

@auth
    <strong>自分の単語帳</strong><br>
    @foreach($my_books as $book)
        <a href="{{ route('book.index', ['book_id' => $book->book_id]) }}">{{ $book->book_name }}</a>
        <a href="{{ route('book.delete', ['book_id' => $book->book_id]) }}">削除</a>
        <br>
    @endforeach
@endauth
<div>
    <br><strong>みんなの単語帳</strong><br>
    @foreach($all_books as $book)
        {{ $book->book_name }}
        <br>
    @endforeach
</div>
@auth
    <div>
        <form>
            @csrf
            <input type="button" value="+" name="create_book_button" onclick="return popup()" />
        </form>
    </div>
    <div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
        <br />
        <form method="POST" action="{{ route('book.create') }}">
            @csrf
            <input type="text" name="book_name" value="{{ old('book_name') }}" />
            <input type="submit" id="ok" onclick="okfunc()" value="登録" />
        </form>
            <button id="no" onclick="nofunc()">キャンセル</button>
    </div>
@endauth

@endsection