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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add exercise</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('create_exercise') }}" id="multiple_select_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <h5 for="name">Name</h5>
                                    <input id="name" type="text" maxlength="32"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <small id="infoName" class="text-secondary"></small><br>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <h5 for="description" class="mt-3">Description</h5>
                                    <textarea name="description" id="description"></textarea><br>                                    
                                    <small id="infoDescription" class="text-secondary"></small>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5>Add image(Optional): </h5><br/>
                                    <input type="file" id="thumbnail" name="thumbnail"><br><br>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5>Add video(Optional): </h5><br/>
                                    <div class="custom-file">
                                        <input type="text" class="form-control" name="url" maxlength="150" id="url" placeholder="https://www.youtube.com">
                                        <small id="video-help" class="form-text text-muted">Please insert valid youtube video</small><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                    <hr>
                    <h4 class="text-center">List of exercises</h4><br/>

                    <div class="row">
                        @foreach ($exercises as $exercise)
                        <div class="col-md-6">
                            <div class="youtube-player" data-id="{{$exercise->video}}"></div>
                        </div>
                        <div class="col-md-6">
                            <span class="font-weight-bold">Exercise name: </span>{{ $exercise->name }}<br>
                            <span class="font-weight-bold">Exercise description: </span>{!! $exercise->description !!}
                        </div>
                        
                        <div class="col-12">
                            <button type="button" title="Delete exercise" class="btn btn-danger text-black-50" style="width: 50px" onclick="deleteExercise({{$exercise->id}})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <a href="{{ $exercise->getManageCleanUrl() }}" title="Edit exercise" class="btn btn-primary text-black-50" style="width: 50px"  role="button" aria-pressed="true"><i class="fas fa-edit"></i></a>

                        </div>
                        
                        <hr class="w-100">
                        @endforeach
                    </div>
                    {{ $exercises->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.exercise')
@endsection