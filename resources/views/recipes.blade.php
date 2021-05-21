@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="insertSeeIngredients"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Available recipes <i class="fas fa-utensils"></i></h3></div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($recipes as $recipe)
                            <div class="col-12 col-md-4 text-center">
                                <img src="/img/recipes/{{ $recipe->thumbnail }}" class="image-look" alt="Recipe">
                                <button type="button" title="See all ingredients" class="btn btn-success mt-3 text-black-50" data-toggle="modal" style="width: 50px" onclick="seeIngredients({{$recipe->id}})"><i class="fas fa-carrot"></i></button>
                            </div>
                            <div class="col-12 col-md-5">
                                <h5>{{ $recipe->name }}</h5>
                                <p>{!! $recipe->way_of_making !!}</p>
                            </div>
                            <div class="col-12 col-md-3">
                                Total amount of calories: <span class="font-weight-bold">~ {{ $recipe->totalCalories() }} kcal</span>
                            </div>
                            <hr class="w-100">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.recipe')
@endsection
