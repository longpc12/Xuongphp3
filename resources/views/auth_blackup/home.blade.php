<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   
    
<div class="container">

    <h1>Dây là trang chủ</h1>

    <form action="{{route('auth.logout')}}" method="POST">
@csrf
<button type="submit">logout</button>

    </form>
</div>



</body>
</html>