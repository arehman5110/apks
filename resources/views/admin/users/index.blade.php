@extends('layouts.app', ['page_title' => 'Index'])

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        div#myTable_length,
        div#roads_length {
            display: none;
        }
    </style>
@endsection



@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Tiang</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">


            @include('components.message')




            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title  ">
                                <div class="text-right"><button class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#teamModal" type="button">Add team</button></div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Team Name</th>
                                            <th>Team Type</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $data)
                                            <tr>
                                                <td class="align-middle">{{ $data->name }}</td>
                                                <td class="align-middle">
                                                    {{ $data->email }}</td>

                                                    <td>{{$data->userTeam->team_name}}</td>
<td>{{$data->userTeam->team_type}}</td>
                                                <td class="text-center">

                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">




                                                        <button type="button" class="btn btn-primary dropdown-item"
                                                        data-id="{{ $data->id }}" data-toggle="modal"
                                                        data-target="#myModal">
                                                        Remove
                                                    </button>


                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>






                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Remove Recored</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" id="remove-foam" method="POST">
                    @method('DELETE')
                    @csrf

                    <div class="modal-body">
                        Are You Sure ?
                        <input type="hidden" name="id" id="modal-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="teamModal">
        <div class="modal-dialog">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('team-users.store')}}" id="remove-foam" method="POST">

                    @csrf

                    <div class="modal-body form-input">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>

                        <label for="team-name">Team</label>
                        <select name="id_team" id="team-id" class="form-control " required>
                            <option value="" hidden>Select team</option>
                            @foreach ($teams as $team)
                            <option value="{{$team->id}}">{{$team->team_name}}</option>

                            @endforeach
                        </select>

                        <label for="email">Password</label>
                        <input type="text" name="password" id="email" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@section('script')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', 'team-users/' + id)
            });



        });
    </script>
@endsection
