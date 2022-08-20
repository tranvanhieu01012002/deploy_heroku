<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>
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
    <form class="container" method="post" enctype="multipart/form-data" action="{{ route('cars.store') }}">
        @csrf
        <div class="spinner-grow text-border mt-5"><h1 class="text-center col-4">Create Form</h1></div>
        
        <div class="col-4">
            <label for="exampleInputEmail1" class="form-label">EnterName</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="col-4">
            <label for="exampleInputEmail1" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="col-4">
            <label for="exampleInputEmail1" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="col-4">
            <label for="exampleInputEmail1" class="form-label">Product_on</label>
            <input type="date" class="form-control" id="product_on" name="product_on">
        </div>
        <br>
        <div class="col-4">
            <select name="mf_id" class="form-select" aria-label="Default select example">
                @foreach ($mfs as $mf)
                    <option value="{{ $mf->id }}">{{ $mf->mf_name }}</option>
                @endforeach

            </select>
        </div>

        <br>
        <input type="submit" class="btn btn-primary"></input>
    </form>
</body>

</html>
