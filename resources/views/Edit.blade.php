<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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
    <form class="container" method="post" enctype="multipart/form-data"
        action="{{ route('cars.update', $car->id) }}">
        @csrf
        @method('PUT')
        <div class="spinner-grow text-warning"><h1 class="text-center col-4">Edit Form</h1></div>
       
        <div class="col-4">
            <label for="exampleInput" class="form-label">EnterName</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $car->name }}">
        </div>

        <div class="col-4">
            <label for="exampleInput" class="form-label">Image</label>
            <input type="file" class="form-control" onchange="changeImage(event)" id="image" name="image">
            <img class="img-thumbnail" style="width:300px;height: 230px;" id="newImage"
                src="/image/{{ isset($car) ? $car->image : '' }}" />
        </div>
        <div class="col-4">
            <label for="exampleInputE" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description"
                value="{{ $car->description }}">
        </div>
        <div class="col-4">
            <label for="exampleInput" class="form-label">Product_on</label>
            <input type="date" class="form-control" id="product_on" name="product_on"
                value="{{ $car->product_on }}">
        </div>
        <br>
       <div class="col-4">
         <select class="form-select" name="mf_id">
            @foreach ($mfs  as $mf)
                <option value="{{$mf->id}}">{{$mf->mf_name}}</option>
            @endforeach
        </select>
       </div>

        <br>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
    <script>
        const changeImage = (e) => {
            console.log('change')
            var imgEle = document.getElementById('newImage')
            imgEle.src = URL.createObjectURL(e.target.files[0])
            imgEle.onload = () => {
                URL.revokeObjectURL(output.src)
            }
        }
    </script>
</body>

</html>
