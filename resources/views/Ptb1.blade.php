<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <form action="{{route('Ptb1.post')}}" method="post">
        @csrf
        <div class="mb-3">
            <label  class="form-label">Nhap A:</label>
            <input type="text" name="a" class="form-control" id="a" value="">
            
        </div>
        <div class="mb-3">
            <label  class="form-label">Nhap B:</label>
            <input type="text" name="b" class="form-control" id="b" value="">
        </div>
        =0
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <h2>{{isset($kq)?$kq:''}}</h2>
</body>
</html>