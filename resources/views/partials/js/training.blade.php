<script>
    $("#name").keyup(function () {
        $("#infoName").text("Character left:" + (32 - $(this).val().length));
    });

    $("#type").keyup(function () {
        $("#infoType").text("Character left:" + (25 - $(this).val().length));
    });

    $("#description").keyup(function () {
        $("#infoDescription").text("Character left:" + (255 - $(this).val().length));
    });

    $('.selectpicker').selectpicker({
        dropupAuto: false
    });

    $('#exercise').change(function(){
        $('#hidden_exercise').val($('#exercise').val());
    });

    $('#recipe').change(function(){
        $('#hidden_recipe').val($('#recipe').val());
    });

    function deleteTraining(id) {
        swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type: 'POST',
                    url: "{{route('delete_training')}}",
                    data: {"_token": "{{ csrf_token() }}", 'id': id},
                    success: function (data) {
                        if(data == 200){
                            location.reload();
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>