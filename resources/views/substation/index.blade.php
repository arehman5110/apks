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

        span.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5 {
            background: #007BFF !important;
            color: white !important;
        }
    <
    </style>
@endsection



@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.substation') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a
                                href="/{{ app()->getLocale() }}/dashboard">{{ __('messages.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.index') }} </li>
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
                            <p class="mb-0">{{ __('messages.substation') }}</p>
                            <div class="d-flex ml-auto">
                                <a href="{{ route('substation.create', app()->getLocale()) }}"><button
                                        class="btn text-white btn-success  btn-sm mr-4">Add Substation</button></a>

                                <a href="{{ route('generate-substation-excel', app()->getLocale()) }}"> <button
                                        class="btn text-white  btn-sm mr-4" style="background-color: #708090">QR
                                        Substation</button></a>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>
                            <div class="table-responsive" id="substaion">
                                {{-- @include('substation.pagination') --}}

                                {{-- <table id="pagination" class="table table-bordered table-hover"> --}}


                                    <table id="" class="table table-bordered table-hover">


                                        <thead style="background-color: #E4E3E3 !important">
                                            <tr>
                                                <th>ZONE</th>
                                                <th>BA</th>
                                                <th>TEAM</th>
                                                <th>VISIT DATE</th>
                                                <th>ACTION</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                    @if ($datas != '')


                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">{{ $data->zone }}</td>
                                                <td>{{ $data->ba }}</td>
                                                <td class="align-middle text-center">{{ $data->team }}</td>
                                                <td class="align-middle text-center">
                                                  
                                                   {{ date('Y-m-d', strtotime($data->visit_date)) }}
                                                </td>
                                                <td class="text-center">

                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">

                                                        <form action="{{ route('substation.show', [app()->getLocale(), $data->id]) }}" method="get">
                                                            <button type="submit" class="dropdown-item pl-3 w-100 text-left">Detail</button>
                                                        </form>

                                                        <form action="{{ route('substation.edit', [app()->getLocale(), $data->id]) }}" method="get">
                                                            <button type="submit" class="dropdown-item pl-3 w-100 text-left">Edit</button>
                                                        </form>


                                                        <button type="button" class="btn btn-primary dropdown-item" data-id="{{ $data->id }}"
                                                            data-toggle="modal" data-target="#myModal">
                                                            Remove
                                                        </button>


                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6"><strong>no recored found</strong></td>


                                        </tr>

                                    @endif

                                </tbody>
                            </table>

                            @if ($datas != [])
                                {{ $datas->links() }}
                            @endif
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
                    [3, 'desc']
                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
            });
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', '/en/substation/' + id)
            });

        });
    </script>
@endsection
