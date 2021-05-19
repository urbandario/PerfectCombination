<script>
    $('.selectpicker').selectpicker({
        dropupAuto: false
    });

    $('#ingredient').change(function(){
        $('#hidden_ingredient').val($('#ingredient').val());
    });

    ClassicEditor
        .create( document.querySelector( '#way_of_making' ) )
        .catch( error => {
            console.error( error );
        } );

    $("#name").keyup(function () {
        $("#infoName").text("Character left:" + (32 - $(this).val().length));
    });

    function createIngredient() {
        $.ajax({
            url: "{{ route('create_ingredient')}}",
            type: "GET",
            data: {"_token": "{{ csrf_token() }}"},
            success: function (data) {
                $('#insertCreateIngredient').html(data);
                $('#edit').modal('show');
            },
            error: function (data) {
                handleError(data);
            }
        })
    }

    function seeIngredients(id) {
        $.ajax({
            url: "{{ route('see_ingredients')}}",
            type: "GET",
            data: {"_token": "{{ csrf_token() }}",'id':id},
            success: function (data) {
                $('#insertSeeIngredients').html(data);
                $('#see').modal('show');
            },
            error: function (data) {
                handleError(data);
            }
        })
    }

    function deleteRecipe(id) {
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
                    url: "{{route('delete_recipe')}}",
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