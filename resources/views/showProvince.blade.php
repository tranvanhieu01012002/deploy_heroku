<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <form>
       
        <select id="province">
            @isset($response)
                @foreach ($response['data'] as $item)
                    <option {{ isset($id) && $id == $item['ProvinceID'] ? 'selected' : '' }} value="{{ $item['ProvinceID'] }}">
                        {{ $item['ProvinceName'] }}</option>
                @endforeach
            @endisset
        </select>

        <select id="district">
            @isset($responseDistrict)
                @foreach ($responseDistrict['data'] as $item)
                    <option {{ isset($idDistrict) && $idDistrict == $item['DistrictID'] ? 'selected' : '' }} value="{{ $item['DistrictID'] }}"> {{ $item['DistrictName'] }}</option>
                @endforeach
            @endisset
        </select>

        <select id="ward">
            @isset($responseWard)
                @foreach ($responseWard['data'] as $item)
                    <option value="{{ $item['WardCode'] }}"> {{ $item['WardName'] }}</option>
                @endforeach
            @endisset
        </select>

    </form>
    <button  id="myBtn">Try it</button>

    <p id="demo">

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

        <script>
            const element = document.getElementById("province");
            element.addEventListener("change", myFunction);

            function myFunction() {
                document.getElementById("demo").innerHTML = element.value;
                window.location.href = `/list-province?province=${element.value}`
            }
            const elementDistrict = document.getElementById("district");
            elementDistrict.addEventListener("change", myFunction1);

            function myFunction1() {
              console.log('ttttt');
                document.getElementById("demo").innerHTML = element.value;
                window.location.href = `/list-province?province=${element.value}&district=${elementDistrict.value}`
            }

            const clickBtn = document.getElementById("myBtn");
            clickBtn.addEventListener("click", ()=>{
                window.location.href = `/calFee?district=${elementDistrict.value}&ward=${ document.getElementById("ward").value}`;
            });

        </script>
</body>

</html>
