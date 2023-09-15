@extends('layouts.app', ['page_title' => 'Index'])
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Site Data</h3>
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



            @if (Session::has('failed'))
                <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
                    {{ Session::get('failed') }}

                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <a href="{{ route('site-data-collection.create') }}" class="btn  btn-sm"
                                    style="background-color: #367FA9; border-radius:0px; color:white">Add new</a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>NAMA PE</th>
                                            <th>SUB STATION TYPE</th>

                                            <th>BEFORE</th>
                                            <th>DURING</th>
                                            <th>AFTER</th>
                                            {{-- <th>TYPE FEEDER</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">{{ $data->nama_pe ? $data->nama_pe : '-' }}</td>
                                                <td class="align-middle">
                                                    {{ $data->sub_station_type ? $data->sub_station_type : '-' }}</td>

                                                <td class="align-middle text-center">
                                                    @if ($data->count_before > 0)
                                                        <span class="check "
                                                            style="font-weight: 600; color: green;">&#x2713;</span>
                                                    @else
                                                        <span class="check"
                                                            style="font-weight: 600; color: red;">&#x2715;</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($data->count_during > 0)
                                                        <span class="check "
                                                            style="font-weight: 600; color: green;">&#x2713;</span>
                                                    @else
                                                        <span class="check"
                                                            style="font-weight: 600; color: red;">&#x2715;</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($data->count_after > 0)
                                                        <span class="check "
                                                            style="font-weight: 600; color: green;">&#x2713;</span>
                                                    @else
                                                        <span class="check"
                                                            style="font-weight: 600; color: red;">&#x2715;</span>
                                                    @endif
                                                </td>
                                                {{-- <td class="align-middle">{{ $data->type_feeder ? $data->type_feeder : '-' }}</td> --}}
                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('site-data-collection.edit', $data->id) }}">Edit
                                                            Foam</a>
                                                        {{-- <a class="dropdown-item " href="{{ route('update-site-data-images.edit', $data->id) }}">Upload Images</a> --}}
                                                        <button class="dropdown-item " data-id="{{ $data->id }}"
                                                            data-toggle="modal" data-target="#imagesModal">Upload
                                                            Images</button>
                                                        <a class="dropdown-item"
                                                            href="{{ route('site-data-collection.show', $data->id) }}">Detail</a>

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



    <div class="modal fade" id="imagesModal">
        <div class="modal-dialog">
            <div class="modal-content ">


                <div class="modal-header">
                    <h4 class="modal-title">Upload Images</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" id="edit-foam" method="POST">
                    @csrf

                    <div class="modal-body">

                        <input type="hidden" name="id" id="edit-modal-id">
                        <label for="satus">Select images status</label>
                        <select name="status" id="status" required class="form-control">
                            <option value="" hidden>Select images status</option>
                            <option value="before">Before</option>
                            <option value="during">During</option>
                            <option value="after">After</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-secondary">Submit</button>
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
            $('#myTable').DataTable();

            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', 'site-data-collection/' + id)
            });


            $('#imagesModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                $('#edit-modal-id').val(id);
                var modal = $(this);
                $('#edit-foam').attr('action', 'update-site-data-images')
            });

            $("#example2").DataTable({
                "lengthChange": false,
                "autoWidth": false,
            })
        })
    </script>
@endsection
