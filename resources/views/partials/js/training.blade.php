<script>
    document.addEventListener("DOMContentLoaded",
        function() {
            var div, n,
            v = document.getElementsByClassName("youtube-player");
            for (n = 0; n < v.length; n++) {
                div = document.createElement("div");
                div.setAttribute("data-id", v[n].dataset.id);
                div.innerHTML = labnolThumb(v[n].dataset.id);
                div.onclick = labnolIframe;
                v[n].appendChild(div);
            }
         }
    );

    function labnolThumb(id) {
        var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg" class="image-look">',
            play = '<div class="play"></div>';
        return thumb.replace("ID", id) + play;
    }

    function labnolIframe() {
        var iframe = document.createElement("iframe");
        iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.id + "?autoplay=1");
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "1");
        this.parentNode.replaceChild(iframe, this);
    }

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
       function seeRecipe(id) {
        $.ajax({
            url: "{{ route('see_recipe')}}",
            type: "GET",
            data: {"_token": "{{ csrf_token() }}",'id':id},
            success: function (data) {
                $('#insertSeeRecipe').html(data);
                $('#see').modal('show');
            },
            error: function (data) {
                handleError(data);
            }
        })
    }

    $("#pop").on("click", function() {
        $('#imagemodal').modal('show');
    });

</script>