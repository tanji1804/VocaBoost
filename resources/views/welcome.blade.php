@extends('layouts.app')

@section('title',config('app.name','VocaBoost'))
@section('content')
    <script>
 
function confirm_test() { // 問い合わせるボタンをクリックした場合
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
<div >
<form method="POST" name="contactform" action="test2.php">
    <input type="submit" value="+" name="contact" onclick="return confirm_test()" />
</form>
 
<div id="popup" style="width: 200px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
    <br />
    <input type="text" name="user_name" value="" />
    <button id="ok" onclick="okfunc()">OK</button>
    <button id="no" onclick="nofunc()">キャンセル</button>
</div>
    
@endsection