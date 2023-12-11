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

        .collapse {
            visibility: visible;
        }

        /* .table-responsive::-webkit-scrollbar {
            display: none;
        } */
    </style>
@endsection



@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.notice') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item text-lowercase"><a
                                href="/{{ app()->getLocale() }}/dashboard">{{ __('messages.dashboard') }}</a></li>
                        <li class="breadcrumb-item text-lowercase active">{{ __('messages.index') }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">



            @include('components.message')


            <div class="row">
                @include('components.qr-filter', ['url' => 'generate-third-party-digging-excel'])
                <div class="card">

                    <div class="card-header d-flex justify-content-between ">
                        <div class="card-title">
                            {{ __('messages.notice') }}
                        </div>
                        <div class="d-flex ml-auto">
                            <a href="{{ route('third-party-digging.create', app()->getLocale()) }}"><button
                                    class="btn text-white btn-success  btn-sm mr-4">{{ __('messages.add_notice') }}</button></a>
                            {{-- <p>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                              Link with href
                                            </a> --}}
                            <button class="btn text-white  btn-sm mr-4" type="button" data-toggle="collapse"
                                style="background-color: #708090" data-target="#collapseQr" aria-expanded="false"
                                aria-controls="collapseQr">
                                QR Notice
                            </button>
                            {{-- </p> --}}

                            {{-- <a href="{{ route('generate-third-party-digging-excel', app()->getLocale()) }}"> <button
                                        class="btn text-white  btn-sm mr-4" style="background-color: #708090">QR Notice</button></a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="text-right mb-4">

                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-hover data-table">


                                <thead style="background-color: #E4E3E3 !important">
                                    <tr>
                                        <th>WP NAME</th>
                                        <th>ZONE</th>
                                        <th>BA</th>
                                        <th>SURVEY DATE</th>
                                        <th>PATROLLING TIME</th>
                                        <th>DIGGING</th>
                                        <th>SUPERVISION</th>
                                        <th>SURVEY STATUS</th>
                                        <th>NOTICE</th>
                                        <th>ACTION</th>

                                    </tr>
                                </thead>
                                <tbody>

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
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        var from_date = '';
        var to_date = '';
        var excel_ba = '';
        $(document).ready(function() {



            var table = $('.data-table').DataTable({

                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('third-party-digging.index', app()->getLocale()) }}",
                    type: "GET",
                    data: function(d) {

                        if (from_date) {
                            d.from_date = from_date;
                        }

                        if (to_date) {
                            d.to_date = to_date;
                        }
                        if (excel_ba) {
                            d.ba = excel_ba;
                        }
                    }
                },
                columns: [{
                        data: 'wp_name',
                        name: 'wop_name '
                    },
                    {
                        data: 'zone',
                        name: 'zone',
                    },
                    {
                        data: 'ba',
                        name: 'ba'
                    },
                    {
                        render: function(data, type, full) {
                            var surveyDate = new Date(full.survey_date);
                            var formattedDate = surveyDate.toLocaleDateString('en-US');
                            return formattedDate;
                        },
                        name: 'survey_date'
                    },
                    {
                        render: function(data, type, full) {
                            var patrollingTime = new Date(full.patrolling_time);
                            var formattedTime = patrollingTime.toLocaleTimeString('en-US', {
                                hour12: false
                            });
                            return formattedTime;
                        },
                        name: 'patrolling_time'
                    },
                    {
                        data: 'digging',
                        name: 'digging'
                    },
                    {
                        data: 'supervision',
                        name: 'supervision'
                    },
                    {
                        data: 'survey_status',
                        name: 'survey_status',
                    },
                    {
                        data: 'notice',
                        name: 'notice'
                    },


                    {
                        render: function(data, type, full) {

                            var id = full.id;
                            return `<button type="button" class="btn  " data-toggle="dropdown">
                            <img
                                src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <form action="/{{ app()->getLocale() }}/third-party-digging/${id}" method="get">

                                <button type="submit" class="dropdown-item pl-3 w-100 text-left">Detail</button>
                            </form>
                            <form action="/{{ app()->getLocale() }}/third-party-digging/${id}/edit" method="get">

                                <button type="submit" class="dropdown-item pl-3 w-100 text-left">Edit</button>
                            </form>
                            <button type="button" class="btn btn-primary dropdown-item" data-id="${id}" data-toggle="modal" data-target="#myModal">
                                Remove
                            </button>
                        </div>
                        `;
                        }
                    }

                ],
                order: [
                    [3, 'desc']
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(1)').addClass('text-center');
                    $(row).find('td:eq(2)').addClass('text-center');
                    $(row).find('td:eq(3)').addClass('text-center');
                    $(row).find('td:eq(4)').addClass('text-center');
                }
            })
            $('#excelBa').on('change', function () {
                console.log("dsfdsf");
                excel_ba = $(this).val();
                console.log(excel_ba);
        table.ajax.reload(function () {
            table.draw('page');
        });
    })


            $('#excel_from_date').on('change', function() {
                from_date = $(this).val();
                table.ajax.reload(function() {
                    table.draw('page');
                });
            })

            $('#excel_to_date').on('change', function() {
                to_date = $(this).val();
                table.ajax.reload(function() {
                    table.draw('page');
                });
            });
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var langs = '{{ app()->getLocale() }}'
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', '/' + langs + '/third-party-digging/' + id)
            });

        });
    </script>
@endsection
