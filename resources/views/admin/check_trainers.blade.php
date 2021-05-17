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
                            <th scope="col" onclick="sortTable(1)">E-mail <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(2)">Name <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(3)">Verified <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(4)" class="text-center">Trainer approved <i class="fa fa-sort-down"></i></th>
                            <th scope="col" onclick="sortTable(5)">Created at <i class="fa fa-sort-down"></i></th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-left">
                        <div class="clearfix"></div>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email_verified_at?$user->email_verified_at:"--" }}</td>
                                <td class="text-center">@if($user->trainer_approved) <i class="fa fa-check" title="Approved Trainer" style="font-size: 25px; color:lawngreen" aria-hidden="true"></i>
                                    @else <i class="fa fa-times" title="Disapproved Trainer" style="font-size: 25px; color:red" aria-hidden="true"></i> @endif 
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-center">
                                    @if (!$user->trainer_approved)
                                        <button type="button" title="Approve Trainer" class="btn btn-success" onclick="approveTrainer({{$user->id}})" >Approve Trainer</button>
                                        <button type="button" title="Disapprove Trainer" class="btn btn-danger" onclick="disapproveTrainer({{$user->id}})" >Disapprove Trainer</button>
                                    @else
                                        Partner successfuly approved!
                                    @endif                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @include('partials.js.check_trainers')
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
