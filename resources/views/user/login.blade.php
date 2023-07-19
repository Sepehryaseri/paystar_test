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
    <p class="heading">ورود</p>
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="box">
            <label for="username">نام کاربری</label><br />
            <input name="username" type="text" placeholder="لطفا نام کاربری خود را وارد کنید"><br />
        </div>

        <div class="box">
            <label for="password">گذرواژه</label><br />
            <input name="password" type="password" placeholder="لطفا گذرواژه خود را وارد کنید"><br />
        </div>
        <br />
        <input class="myButton" type="submit" value="ورود">
    </form>
</div>
</html>
