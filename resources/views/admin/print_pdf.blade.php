<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>print_pdf</title>
</head>
<body>

    <center>
        <h3>Customer name : {{$data->name}}</h3>
        <h3>Customer address :  {{$data->address}}</h3>
        <h3>Phone : {{$data->phone}}</h3>
        <h2>Product Title : {{$data->product->title}}</h2>
        <h2>Product Price : ${{$data->product->price}}</h2>
        <img style="height:150px;width:150px;" src="products/{{$data->product->image}}">
    </center>




</body>
</html>
