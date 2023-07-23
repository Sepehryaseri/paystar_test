<html dir="rtl">
<head>
    <link rel="stylesheet" href='/css/login.css' type="text/css">
    <title>ورود</title>
</head>
@if($errors->any())
    <div class="error">
        <p>{{$errors->first()}}</p>
    </div>
@endif
<div class="loginForm">
    <p class="heading">پرداخت</p>
    <form action="{{route('payment')}}" method="post">
        @csrf
        <div class="box">
            <label for="amount">مبلغ</label><br />
            <input name="amount" type="text" placeholder="لطفا مبلغ مورد نظر را وارد کنید"><br />
        </div>
        <br />
        <input class="myButton" type="submit" value="پرداخت">
    </form>
</div>
</html>
