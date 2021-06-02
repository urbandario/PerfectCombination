<script>
    function sortTable(n) {
        var table, arrows, arrow, arrowClass, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("check-trainers-table-element");
        arrows = $('#check-trainers-table-element > thead > tr > th > i');
        arrow = arrows[n];
        arrowClass = arrow.attributes.class.value;

        if (arrowClass == 'fa fa-sort-down') {
            for (var j = 0; j < arrows.length; j++) {
                arrows[j].attributes.class.value = 'fa fa-sort-down';
            }
            arrow.attributes.class.value = 'fa fa-sort-up';
        } else {
            arrow.attributes.class.value = 'fa fa-sort-down';
        }

        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }

    function approveTrainer(id) {
        $.ajax({
            url: "{{ route('approve_trainer')}}",
            type: "POST",
            data: {"_token": "{{ csrf_token() }}", 'id': id},
            success: function (data) {
                countTrainerRequests();
                swal({
                    title: "Success", 
                    text: "Partner approved!", 
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false
                }).then(function(){ 
                   location.reload();
                   }
                );
            },
            error: function (data) {
                handleError(data);
            }
        })

    }

    function disapproveTrainer(id) {
        $.ajax({
            url: "{{ route('disapprove_trainer')}}",
            type: "POST",
            data: {"_token": "{{ csrf_token() }}", 'id': id},
            success: function (data) {
                countTrainerRequests();
                swal({
                    title: "Ups", 
                    text: "Partner disapproved!", 
                    icon: "error",
                    showCancelButton: false,
                    showConfirmButton: false
                }).then(function(){ 
                   location.reload();
                   }
                );
            },
            error: function (data) {
                handleError(data);
            }
        })
    }

    function countTrainerRequests() {
        $.ajax({
            url: "{{ route('trainer_request_count') }}",
            type: "POST",
            data: {"_token": "{{ csrf_token() }}"},
            success: function (count) {
                if(count == 0){
                    $('#trainer-count').addClass('invisible');
                }
                else {
                    $('#trainer-count').removeClass('invisible');
                    $('#trainer-count').html(count);
                }
            },
            error: function (data) {
                handleError(data);
            }
        })
    }
</script>
