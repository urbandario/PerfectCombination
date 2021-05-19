@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="insertSeeIngredients"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of recipes <a href="{{ route('create_recipe') }}" class="btn btn-outline-success text-left" style="float: right" role="button" aria-pressed="true">Create recipe</a></div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($recipes as $recipe)
                            <div class="col-12 col-md-4">
                                <img src="/img/recipes/{{ $recipe->thumbnail }}" class="image-look" alt="Recipe">
                            </div>
                            <div class="col-12 col-md-5">
                                <h5>{{ $recipe->name }}</h5>
                                <p>{!! $recipe->way_of_making !!}</p>
                            </div>
                            <div class="col-12 col-md-3">
                                Total amount of calories: <span class="font-weight-bold">~ {{ $recipe->totalCalories() }} kcal</span>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="button" title="Delete recipe" class="btn btn-danger text-black-50" style="width: 50px" onclick="deleteRecipe({{$recipe->id}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="{{ $recipe->getManageCleanUrl() }}" title="Edit recipe" class="btn btn-primary text-black-50" style="width: 50px"  role="button" aria-pressed="true"><i class="fas fa-edit"></i></a>
                                <button type="button" title="See all ingredients" class="btn btn-success text-black-50" data-toggle="modal" style="width: 50px" onclick="seeIngredients({{$recipe->id}})"><i class="fas fa-carrot"></i></button>
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
