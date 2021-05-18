@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of trainings <a href="{{ route('create_training') }}" class="btn btn-outline-success text-left" style="float: right" role="button" aria-pressed="true">Create training</a></div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($trainings as $training)
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card">
                                    @if ($training->thumbnail != null)
                                        <img class="card-img-top" src="/img/trainings/{{ $training->thumbnail }}" alt="Card image cap">
                                    @endif
                                    <div class="card-body">
                                      <h5 class="card-title font-weight-bold">Name: {{ $training->name }} </h5>
                                      <span class="card-text font-weight-bold">Type of training: {{ $training->type }}</span>
                                      <p class="card-text">Description: {{ $training->description }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" title="Delete training" class="btn btn-danger w-100 text-black-50" onclick="deleteTraining({{$training->id}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ $training->getManageCleanUrl() }}" title="Edit training" class="btn btn-primary w-100 text-black-50"  role="button" aria-pressed="true"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.training')
@endsection
