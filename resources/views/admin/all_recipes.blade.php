@extends('layouts.admin')

@section('pageTitle','Check trainers')

@section('content')
    <style>
        th {
            cursor: pointer;
        }
        .vl {
          border-left: 1px solid #dee2e6;
          height: 337px;
          position: absolute;
          left: 50%;
          margin-left: -3px;
          top: 0;
        }
    </style>
    <div class="container" style="max-width: max-content; text-align: center">
        <!-- Modal for modify user -->
        <div id="checkPartner"></div>
        <div id="historyPartner"></div>

        <div class="row justify-content-center">
            <div class="table-responsive" id="check-trainers-table">
                <table class="table table-striped" id="check-trainers-table-element">
                    <thead class="text-left" style="color: white;background: #a0a0a0">
                        <tr>
                            <th scope="col" onclick="sortTable(0)"># <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(1)">Name <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(2)">Made by <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Way of making <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)">Thumbnail <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Created at <i class="fa fa-sort-down"></i></th>
                            <th scope="col" class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <div class="clearfix"></div>
                        @foreach($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->name }}</td>
                                <td>{{ $recipe->user->name }}</td>
                                <td>{!! $recipe->way_of_making !!}</td>
                                <td><img src="/img/recipes/{{ $recipe->thumbnail }}" style="width: 75px; height: 75px; float:left" ></td>
                                <td>{{ $recipe->created_at }}</td>
                                <td class="text-center">
                                    <button type="button" title="Delete recipe" class="btn btn-sm btn-danger text-black-50" style="width: 30.6px;height: 28.9px" onclick="deleteRecipe({{ $recipe->id }})"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @include('partials.js.admin')
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{ $errors->first() }}'
            });
        </script>
    @endif
@stop
