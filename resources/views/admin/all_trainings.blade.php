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
                            <th scope="col" onclick="sortTable(1)">Trainer name <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(2)">Training Name <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Type <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)">Description <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Recipe <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(6)">Price <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(7)">Thumbnail <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(8)">Created at <i class="fa fa-sort-down"></i></th>
                            <th scope="col" class="text-center">Actions</th>

                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <div class="clearfix"></div>
                        @foreach($trainings as $training)
                            <tr>
                                <td>{{ $training->id }}</td>
                                <td>{{ $training->user->name }}</td>
                                <td>{{ $training->name }}</td>
                                <td>{{ $training->type()->first()->name }}</td>
                                <td style="width: 400px">{!! $training->description !!}</td>
                                @if ($training->recipe()->first() != null)
                                    <td>{{ $training->recipe()->first()->name }}</td>
                                @else
                                    <td><i class="fa fa-times" title="Dont have recipe" style="font-size: 25px; color:red" aria-hidden="true"></i> </td>
                                @endif
                                <td class="text-center">
                                    @if($training->price) <i class="fa fa-check" title="Need to pay" style="font-size: 25px; color:lawngreen" aria-hidden="true"></i>
                                    @else <i class="fa fa-times" title="Free for all" style="font-size: 25px; color:red" aria-hidden="true"></i> 
                                    @endif 
                                </td>
                                <td><img src="/img/trainings/{{ $training->thumbnail }}" style="width: 75px; height: 75px; float:left" ></td>
                                <td>{{ $training->created_at }}</td>
                                <td class="text-center">                                    
                                    <button type="button" title="Delete training" class="btn btn-sm btn-danger text-black-50" style="width: 30.6px;height: 28.9px" onclick="deleteTraining({{ $training->id }})"><i class="fa fa-trash"></i></button>
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
