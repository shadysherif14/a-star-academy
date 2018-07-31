<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @php 
    $a = $_SERVER['HTTP_USER_AGENT'];
    //$res = strpos($a, 'Moz');
    //dd($res);
    if (!strpos($a, 'idm')) {
        echo '<embed width="400" height="400" src="res/2.swf">
';
    }

    @endphp
    
</body>
</html>