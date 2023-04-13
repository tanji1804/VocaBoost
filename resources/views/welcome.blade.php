@extends('layouts.app')

@section('title',config('app.name','VocaBoost').' '.__('messages.top'))
@section('content')
    <script>
 
function popup() { // 問い合わせるボタンをクリックした場合
    document.getElementById('popup').style.display = 'block';
    return false;
}
 
function okfunc() { // OKをクリックした場合
    document.contactform.submit();
}
 
function nofunc() { // キャンセルをクリックした場合
    document.getElementById('popup').style.display = 'none';
}
</script>

<!--<div>-->
<!--    @foreach($all_books as $book)-->
<!--        {{ $book->book_name }}-->
<!--        <a href="{{ route('book.delete', ['book_id' => $book->book_id]) }}">{{ __('messages.delete') }}</a>-->
<!--        <br>-->
<!--    @endforeach-->
<!--</div>-->


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
            <button id="no" onclick="nofunc()">キャンセル</button>
        </form>
    </div>
@endauth

@endsection