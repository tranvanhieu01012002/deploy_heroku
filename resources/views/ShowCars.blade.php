<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowCars</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <table class="table">
        <div class="mr-0">
            <a class="btn btn-primary" href="{{ route('cars.create') }}">ADD</a>
        </div>

        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Producer</th>
                <th scope="col">Description</th>
                <th><i class="fa-solid fa-gears"></i></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <th class="row">Car {{ $car->id }}</th>
                    <td>Name {{ $car->name }}</td>
                    <td><img class="img-thumbnail" src="image/{{ $car->image }}" width="300px" height="230px"></td>
                    <td>{{ $car->mf->mf_name }}</td>
                    <td>{{ $car->description }}</td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning"><i class="fa fa-pencil"
                                aria-hidden="true"></i></a>
                        <a href="{{ route('cars.delete', $car->id) }}" class="btn btn-danger"
                            onclick="return confirm('Delete?')"><i class="fas fa-trash" aria-hidden="true"></i></a>
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
