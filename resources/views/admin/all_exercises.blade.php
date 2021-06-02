@extends('layouts.admin')

@section('pageTitle','Check trainers')

@section('content')
    <style>
        th {
            cursor: pointer;
        }
        .vl {
          border-left: 1px solid #dee2e6;
          height: 337px;
          position: absolute;
          left: 50%;
          margin-left: -3px;
          top: 0;
        }
    </style>
    <div class="container" style="max-width: max-content; text-align: center">
        <!-- Modal for modify user -->
        <div id="checkPartner"></div>
        <div id="historyPartner"></div>

        <div class="row justify-content-center">
            <div class="table-responsive" id="check-trainers-table">
                <table class="table table-striped" id="check-trainers-table-element">
                    <thead class="text-left" style="color: white;background: #a0a0a0">
                        <tr>
                            <th scope="col" onclick="sortTable(0)"># <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(1)">Name <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(2)">Created by <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Image <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)">Video <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Description <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(6)">Created at <i class="fa fa-sort-down"></i></th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <div class="clearfix"></div>
                        @foreach($exercises as $exercise)
                            <tr>
                                <td>{{ $exercise->id }}</td>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->user->name }}</td>
                                @if ($exercise->image != null)
                                    <td><img src="/img/exercise/{{ $exercise->image }}" style="width: 75px; height: 75px; float:left" ></td>
                                @else
                                    <td><i class="fa fa-times" title="Dont have image" style="font-size: 25px; color:red" aria-hidden="true"></i> </td>
                                @endif
                                <td><div class="youtube-player" data-id="{{$exercise->video}}"></div></td>
                                <td style="width: 450px">{!! $exercise->description !!}</td>
                                <td>{{ $exercise->created_at }}</td>
                        @endforeach
                    </tbody>
                </table>
                
                @include('partials.js.admin')
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{ $errors->first() }}'
            });
        </script>
    @endif
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
    </script>
@stop
