<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form class="container col-4"  action="{{route('Calculato.post')}}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Number 1</label>
            <input type="text" name = "numb1" class="form-control" id="numb1" value="{{isset($numb1)?$numb1:''}}">
        <div class="mb-3">
            <label class="form-label">Number 2</label>
            <input type="text" name = "numb2" class="form-control" id="numb2" value="{{isset($numb2)?$numb2:''}}">
        </div>
        =0
        <button type="submit" class="btn btn-primary">Check</button>


        <div class = "row">
            <div class="form-check">
                <input class="form-check-input" type="radio" value="cong" name="tinh" id="cong"checked>
                <label class="form-check-label" for="cong" >
                    Cộng +
                </label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" value = "tru" name="tinh" id="tru" >
            <label class="form-check-label" for="tru" >
                Trừ -
            </label>

            <div class="form-group">
                <input class="form-check-input" type="radio" value = "nhan" name="tinh" id="nhan">
                <label class="form-check-label" for="nhan">
                    Nhân *
                </label>
            </div>

            <div class="form-group">
                <input class="form-check-input" type="radio" value = "chia" name="tinh" id="chia">
                <label class="form-check-label" for="chia">
                    Chia /
                </label>
            </div>
        </div>
  
</form>
<h2 class="">Ket qua la: {{isset($kq)?$kq:''}}</h2>

</body>
</html>