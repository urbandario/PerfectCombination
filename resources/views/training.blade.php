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
    <div id="insertSeeIngredients"></div>
    <div id="insertSeeRecipe"></div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><a href="{{ route('trainings') }}" class="text-success">Trainings</a> / {{ $training->name }} <i class="fas fa-running"></i>
                    @if ($training->recipe_id != 0)
                        <button type="button" title="See recipe" class="btn btn-success text-left" data-toggle="modal" onclick="seeRecipe( {{ $training->id }} )">Check recipe <i class="fas fa-carrot"></i></button>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($training->exercisesGet() as $exercise)
                            <div class="col-12 col-md-6 text-center">
                                @if ($exercise->video != null)
                                    <div class="youtube-player" data-id="{{$exercise->video}}"></div>
                                @elseif ($exercise->image != null)
                                    <img class="image-look" src="/img/exercise/{{ $exercise->image }}">
                                @else
                                  No video or photo
                                @endif
                            </div>
                            <div class="col-12 col-md-6">
                                <h4 class="font-weight-bold">{{ $exercise->name }}</h4>
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

@include('partials.js.training')
@endsection
