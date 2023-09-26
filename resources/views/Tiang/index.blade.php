@extends('layouts.app', ['page_title' => 'Index'])

@section('css')



<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<style>
    div#myTable_length ,div#roads_length {
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
                                Tiang
                             </div>

                        </div>

                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>Ba</th>
                                            <th>Contractor</th>

                                            <th>PO Start Date</th>
                                            <th>PO End Date</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                      @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">{{ $data->ba }}</td>
                                                <td class="align-middle">
                                                    {{ $data->name_contractor }}</td>


                                                <td class="align-middle text-center">
                                                    @php
                                                    $date = new DateTime($data->start_date );
                                                        $datePortion = $date->format("Y-m-d");


                                                    @endphp
                                                    {{ $datePortion }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    @php
                                                    $date = new DateTime($data->end_date );
                                                        $datePortion = $date->format("Y-m-d");


                                                    @endphp
                                                    {{ $datePortion }}
                                                </td>
                                                <td class="text-center">

                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">

                                                        <a class="dropdown-item"
                                                            href="#">Detail</a>

                                                            <form action="{{route('tiang-talian-vt-and-vr.edit',$data->id)}}" method="get">
                                                            <a href="#"><button type="submit" class="dropdown-list">Edit</button></a>
                                                            </form>


                                                            <a class="dropdown-item"
                                                            href="#" onclick="return confirm('Are you sure?')">Remove</a>


                                                   </a>
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

@endsection


@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#roads').DataTable();
        });

            </script>

            @endsection

