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
                <div class="card-header">Add ingredient</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('create_ingredient') }}" id="multiple_select_form" method="POST">
                        @csrf
                        <div class="form-group">
    
                            <div class="row">
                                <div class="col-6">
                                    <h5 for="name">Name</h5>
                                    <input id="name" type="text" maxlength="32"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <small id="infoName" class="text-secondary"></small><br>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <h5 for="calorie">Calorie</h5>
                                    <input id="calorie" type="calorie" maxlength="32"  class="form-control @error('calorie') is-invalid @enderror" name="calorie" value="{{ old('calorie') }}" required autocomplete="calorie" autofocus>

                                    @error('calorie')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="col-6 ">
                                    <h5 for="description" class="mt-3">Description</h5>
                                    <textarea rows="4" , cols="54" class="form-control @error('description') is-invalid @enderror" name="description" id="description" required >{{ old('description') }}</textarea>
                                    <small id="infoDescription" class="text-secondary"></small><br>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <h5>Add thumbnail: </h5><br/>
                                    <input type="file" id="thumbnail" name="thumbnail"><br><br>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.recipe')
@endsection
