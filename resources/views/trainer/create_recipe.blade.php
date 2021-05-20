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
        <div id="insertCreateIngredient"></div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add recipe</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('create_recipe') }}" id="multiple_select_form" method="POST">
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
                                    <h5 for="way_of_making" class="mt-3">Way of making:</h5>
                                    <textarea name="way_of_making" id="way_of_making"></textarea><br>                                    
                                    @error('way_of_making')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <button type="button" title="Add ingredient" class="btn btn-sm btn-success text-black-50" data-toggle="modal" onclick="createIngredient()" style="float: right"><span class="font-weight-bold">+</span><i class="fas fa-carrot"></i></button>
                                    <h5>Choose ingredients: </h5><br/>
                                    <select name="ingredient" id="ingredient" class="form-control selectpicker" title="Can choose more than one" data-live-search="true" multiple>
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5>Add thumbnail: </h5><br/>
                                    <input type="file" id="thumbnail" name="thumbnail"><br><br>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="hidden_ingredient" id="hidden_ingredient" />
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.recipe')
@endsection
