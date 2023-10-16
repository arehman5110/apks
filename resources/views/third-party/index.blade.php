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
                    <h3>Notice Form</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="/{{app()->getLocale()}}/dashboard">Home</a></li>
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

                        <div class="card-header d-flex justify-content-between ">
                            <div class="card-title">
                                Notice
                            </div>
                            <div class="d-flex ml-auto">
                                <a href="{{ route('third-party-digging.create', app()->getLocale()) }}"><button
                                        class="btn text-white btn-success  btn-sm mr-4">Add Notice</button></a>

                                <a href="{{ route('generate-third-party-digging-excel', app()->getLocale()) }}"> <button
                                        class="btn text-white  btn-sm mr-4" style="background-color: #708090">QR Notice</button></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>WP NAME</th>
                                            <th>ZONE</th>
                                            <th>BA</th>
                                            <th>TEAM</th>
                                            <th>SURVEY DATE</th>
                                            <th>ACTION</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">{{ $data->wp_name }}</td>
                                                <td class="align-middle">{{ $data->zone }}</td>
                                                <td>{{ $data->ba }}</td>
                                                <td class="align-middle text-center">{{ $data->team_name }}</td>
                                                <td class="align-middle text-center">
                                                    @php
                                                        $date = new DateTime($data->survey_date);
                                                        $datePortion = $date->format('Y-m-d');

                                                    @endphp
                                                    {{ $datePortion }}
                                                </td>
                                                <td class="text-center">

                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">

                                                        <form action="{{ route('third-party-digging.show',[app()->getLocale(), $data->id]) }}"
                                                            method="get">
                                                            <button type="submit"
                                                                class="dropdown-item pl-3 w-100 text-left">Detail</button>
                                                        </form>

                                                        <form action="{{ route('third-party-digging.edit', [app()->getLocale() ,$data->id]) }}"
                                                            method="get">
                                                            <button type="submit"
                                                                class="dropdown-item pl-3 w-100 text-left">Edit</button>
                                                        </form>


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
@endsection


@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                aaSorting: [
                    [0, 'asc']
                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
            });
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var langs='{{ app()->getLocale() }}'
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', '/'+langs+'/third-party-digging/' + id)
            });

        });
    </script>
@endsection
