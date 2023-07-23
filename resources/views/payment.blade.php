<html dir="rtl">
<head>
    <link rel="stylesheet" href='/css/login.css' type="text/css">
    <title>نتیجه تراکنش</title>
</head>
<div class="loginForm">
    <p class="heading">نتیجه تراکنش</p><br/><br/>
    @if(empty($message))
        <ul>
            <li>مبلغ تراکنش:</li>
            <p>{{$price}}</p><br />
            <li>شناسه یکتای رهگيری تراکنش:</li>
            <p>{{$ref_num}}</p><br />
            <li>شماره کارت پرداخت کننده:</li>
            <p>{{$card_number}}</p>
        </ul>
    @else
        <h3>{{$message}}</h3>
    @endif
</div>
</html>
