<script>
    $(document).ready(function() {
        $.get(`/api/fee`, function(data, status) {
            data.data.data.forEach(element => {
                $("#province").append(
                    `<option value=${element.ProvinceID}>${element.ProvinceName}</option>`
                )
            });

        });

    })
    $(document).ready(function() {
        $('#province').change(
            function() {
                $.get(`/api/fee?province=${$("#province").find(":selected").val()}`, function(data,
                    status) {
                    $('#district').empty();
                    $('#ward').empty();
                    data.data.data.forEach(element => {
                        $("#district").append(
                            `<option value=${element.DistrictID}>${element.DistrictName}</option>`
                        )
                    });
                })
            }
        )
    })
    $(document).ready(function() {
        $('#district').change(
            function() {
                $.get(`/api/fee?province=${$("#province").find(":selected").val()}
                &district=${$("#district").find(":selected").val()}`,
                    function(data,
                        status) {
                        $('#ward').empty();
                        data.data.data.forEach(element => {
                            // console.log(element);
                            $("#ward").append(
                                `<option value=${element.WardCode}>${element.WardName}</option>`
                            )
                        });
                    });
            }
        );

    })
    $(document).ready(function() {
        const quan = {{Session::has('cart')?Session::get('cart')->totalQty:0}};
        $('#ward').change(
            function() {
                $.get(
                    `/api/calFee?district=${$("#district").find(":selected").val()}&ward=${$("#ward").find(":selected").val()}&quantity=${quan} `,
                    function(data, status) {
                        console.log( `/api/calFee?district=${$("#district").find(":selected").val()}&ward=${$("#ward").find(":selected").val()}&quantity=${quan} `);
                        $('#quantity').val(data.data.data.total);
                    })
            }
        )
    })
    // const elementDistrict = document.getElementById("district");
    // elementDistrict.addEventListener("change", myFunction1);

    // function myFunction1() {
    //     window.location.href = `/check-out?province=${element.value}&district=${elementDistrict.value}`
    // }
</script>


