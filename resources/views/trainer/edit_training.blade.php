@extends('layouts.app')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit <span class="font-weight-bold">{{ $training->name }} </span>training <a href="{{ route('training_list') }}" class="btn btn-outline-success text-left" style="float: right" role="button" aria-pressed="true">Back on list</a></div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('update_training') }}" id="multiple_select_form" method="POST">
                        @csrf
                        <div class="form-group">
    
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <h5 for="name">Name</h5>
                                    <input id="name" type="text" maxlength="32"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $training->name }}" required autocomplete="name" autofocus>
                                    <small id="infoName" class="text-secondary"></small><br>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 for="typeSelect">Types: </h5>
                                            <select name="typeSelect" id="typeSelect" class="form-control selectpicker"  title="Choose one of the type..." data-live-search="true">
                                                @foreach ($types as $type)
                                                    <option value="{{$type->id}}" @if($type->id == $selectedType) selected @endif>{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <h5 for="type">Create Type</h5>
                                            <input id="type" type="text" maxlength="25"  class="form-control @error('type') is-invalid @enderror" name="type" autocomplete="type" autofocus>
                                            <small id="infoType" class="text-secondary"></small><br>

                                            @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 mb-3">
                                    <h5 for="description" class="mt-3">Description</h5>
                                    <textarea rows="4" , cols="54" class="form-control @error('description') is-invalid @enderror" name="description" id="description" required >{{ $training->description }}</textarea>
                                    <small id="infoDescription" class="text-secondary"></small><br>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-6">
                                    <h5>Choose exersises: </h5><br/>
                                    <select name="exercise" id="exercise" class="form-control selectpicker" title="Can choose more than one" data-live-search="true" multiple>
                                        @foreach ($exercises as $exercise)
                                            <option value="{{$exercise->id}}" @if(in_array($exercise->id, $selectedExercises)) selected @endif>{{$exercise->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <h5>Choose recepi: </h5><br/>
                                    <select name="recipe" id="recipe" class="form-control selectpicker"  title="Choose one of the recipies..." data-live-search="true">
                                        @foreach ($recipes as $recipe)
                                            <option value="{{$recipe->id}}" @if($recipe->id == $selectedRecipes) selected @endif>{{$recipe->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5>Add thumbnail: </h5><br/>
                                    <input type="file" id="thumbnail" name="thumbnail"><br><br>
                                </div>
                                <div class="col-12 col-md-6 text-center">
                                    <h5>Current thumbnail: </h5><br/>
                                    <img src="/img/trainings/{{ $training->thumbnail }}" class="image-look" alt="Training">
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="training_id" id="training_id" value="{{ isset($training->id)?$training->id:"" }}"/>
                        <input type="hidden" name="hidden_recipe" id="hidden_recipe" value="{{ $selectedRecipes }}"/>
                        <input type="hidden" name="hidden_type" id="hidden_type" value="{{ $selectedType }}"/>
                        <input type="hidden" name="hidden_exercise" id="hidden_exercise" value="{{ json_encode($selectedExercises) }}"/>
                        <button type="submit" class="btn btn-success">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.training')
@endsection
