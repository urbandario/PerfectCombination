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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new training</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('create_training') }}" id="multiple_select_form" method="POST">
                        @csrf
                        <div class="form-group">
    
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <h5 for="name">Name</h5>
                                    <input id="name" type="text" maxlength="32"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <small id="infoName" class="text-secondary"></small><br>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <h5 for="type">Type</h5>
                                    <input id="type" type="text" maxlength="25"  class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>
                                    <small id="infoType" class="text-secondary"></small><br>

                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <h5 for="description" class="mt-3">Description</h5>
                                    <textarea rows="4" , cols="54" class="form-control @error('description') is-invalid @enderror" name="description" id="description" required >{{ old('description') }}</textarea>
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
                                            <option value="{{$exercise->id}}">{{$exercise->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <h5>Choose recepi: </h5><br/>
                                    <select name="recipe" id="recipe" class="form-control selectpicker"  title="Choose one of the recipies..." data-live-search="true">
                                        @foreach ($recipes as $recipe)
                                            <option value="{{$recipe->id}}">{{$recipe->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h5>Add thumbnail: </h5><br/>
                                    <input type="file" id="thumbnail" name="thumbnail"><br><br>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="hidden_recipe" id="hidden_recipe" />
                        <input type="hidden" name="hidden_exercise" id="hidden_exercise" />
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.training')
@endsection
