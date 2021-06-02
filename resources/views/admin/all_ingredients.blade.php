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
                            <th scope="col" onclick="sortTable(2)">Calorie <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Thumbnail <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)">Description <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Created at <i class="fa fa-sort-down"></i></th>
                            <th scope="col" class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <div class="clearfix"></div>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->id }}</td>
                                <td>{{ $ingredient->name }}</td>
                                <td>~ {{ $ingredient->calorie }} kcal</td>
                                <td><img src="/img/ingredients/{{ $ingredient->thumbnail }}" style="width: 75px; height: 75px; float:left" ></td>
                                <td style="width: 300px">{{ $ingredient->description }}</td>
                                <td>{{ $ingredient->created_at }}</td>
                                <td class="text-center">
                                    <button type="button" title="Delete ingredient" class="btn btn-sm btn-danger text-black-50" style="width: 30.6px;height: 28.9px" onclick="deleteIngredient({{ $ingredient->id }})"><i class="fa fa-trash"></i></button>
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
