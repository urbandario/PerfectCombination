@extends('layouts.app')
@section('styles')
<style>
    .youtube-player {
    position: relative;
    padding-bottom: 56.23%;
    /* Use 75% for 4:3 videos */
    height: 0;
    overflow: hidden;
    max-width: 100%;
    background: #000;
    margin: 5px;
}

.youtube-player iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
    background: transparent;
}

.youtube-player img {
    bottom: 0;
    display: block;
    left: 0;
    margin: auto;
    max-width: 100%;
    width: 100%;
    position: absolute;
    right: 0;
    top: 0;
    border: none;
    height: auto;
    cursor: pointer;
    -webkit-transition: .4s all;
    -moz-transition: .4s all;
    transition: .4s all;
}

.youtube-player img:hover {
    -webkit-filter: brightness(75%);
}

.youtube-player .play {
    height: 72px;
    width: 72px;
    left: 50%;
    top: 50%;
    margin-left: -36px;
    margin-top: -36px;
    position: absolute;
    cursor: pointer;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>{{ $training->name }} <i class="fas fa-running"></i><a href="{{ route('trainings') }}" class="btn btn-outline-success text-left" style="float: right" role="button" aria-pressed="true">Go back</a></h3></div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($training->exercisesGet() as $exercise)
                            <div class="col-6 text-center">
                                @if ($exercise->video != null)
                                    <div class="youtube-player" data-id="{{$exercise->video}}"></div>
                                    @if ($exercise->image != null)
                                        <a href="#" id="pop" class="btn btn-outline-success">
                                            Preview Image
                                        </a>
                                    @endif
                                @elseif ($exercise->image != null)
                                    <img class="image-look" src="/img/exercise/{{ $exercise->image }}">
                                @else
                                  No video or photo
                                @endif
                            </div>
                            <div class="col-6">
                                <p>{!! $exercise->description !!}</p>
                            </div>
                            <hr class="w-100">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modal-body">
          <img src="/img/exercise/{{ $exercise->image }}" style="width: 400px; height: 264px;" >
        </div>
      </div>
    </div>
  </div>
<script>
    $("#pop").on("click", function() {
        $('#imagemodal').modal('show');
    });

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
@endsection
