<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$name}}</title>
</head>
<body>
    <h1>Thank you for creating a quote! {{$name}}</h1>
    <p>Please register here <a href="{{ route('mail_callback',['author_name'=>$name]) }}">Link</a></p>

</body>
</html>
