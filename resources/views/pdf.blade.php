<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bussiness Permit</title>
</head>
<style>
    .rotateimg180 {
        -webkit-transform:rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    img{
        float:right;
    }
</style>
<body>



        <img class="florotateimg180" src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(150)->generate('Permit Number: '.$user->permit_no.'
'.'Name: '.$user->name.'
'.'Business Name: '. $user->bname.'
'.'Line of Business: '. $user->lob.'
'.'Issued By: '. $user->issued.'
'.'Position: '.$user->position.'')) !!}" alt="">



</body>
</html>




