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

        .collapse {
            visibility: visible;
        }

        .table-responsive::-webkit-scrollbar {
            display: none;
        }

        .lower-header th,
        td {
            font-size: 14px !important;
            padding: 5px !important;
        }

        th {
            font-size: 15px !important
        }
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
                @include('components.qr-filter', ['url' => 'generate-substation-excel'])

                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between ">
                            <p class="mb-0">{{ __('messages.substation') }}</p>
                            <div class="d-flex ml-auto">
                                <a href="{{ route('substation.create', app()->getLocale()) }}"><button
                                        class="btn text-white btn-success  btn-sm mr-4">Add Substation</button></a>


                                <button class="btn text-white  btn-sm mr-4" type="button" data-toggle="collapse"
                                    style="background-color: #708090" data-target="#collapseQr" aria-expanded="false"
                                    aria-controls="collapseQr">
                                    QR Substation
                                </button>
                                {{--               <a href="{{ route('generate-substation-excel', app()->getLocale()) }}"> <button
                                        class="btn text-white  btn-sm mr-4" style="background-color: #708090">QR
                                        Substation</button></a> --}}
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>



                            {{-- <table id="pagination" class="table table-bordered table-hover"> --}}

                            <div class="table-responsive add-substation" id="add-substation">
                                <table id="" class="table table-bordered  table-hover data-table">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th rowspan="2">{{ __('messages.name') }}</th>
                                            <th rowspan="2">{{__('messages.visit_date')}} </th>
                                            <th colspan="3" class="text-center">{{ __('messages.gate') }}</th>
                                            <th colspan="2" class="text-center">{{ __('messages.tree') }}</th>
                                            <th colspan="4" class="text-center">{{ __('messages.building_defects') }}
                                            </th>
                                            <th>{{ __('messages.add_clean_up') }}</th>
                                            <th rowspan="2">{{ __('messages.total_defects') }} </th>
                                            {{-- <th rowspan="2">QA Status</th> --}}

                                            <th rowspan="2">ACTION</th>

                                        </tr>
                                        <tr class="lower-header">
                                            <th>{{ __('messages.unlocked') }}</th>
                                            <th>{{ __('messages.demaged') }}</th>
                                            <th>{{ __('messages.others') }} </th>
                                            <th>{{ __('messages.long_grass') }} </th>
                                            <th>{{ __('messages.tree_branches_in_PE') }} </th>
                                            <th>{{ __('messages.broken_roof') }} </th>
                                            <th>{{ __('messages.broken_gutter') }} </th>
                                            <th>{{ __('messages.broken_base') }} </th>
                                            <th>{{ __('messages.others') }} </th>
                                            <th>{{ __('messages.cleaning_illegal_ads_banners') }} </th>
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

    <div class="modal fade" id="qaStatusModal">
        <div class="modal-dialog">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" id="remove-foam" method="POST">

                    @csrf

                    <div class="modal-body form-input">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="" id="modal-name" disabled readonly >
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Total defects</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="" id="modal-defects" disabled readonly >
                            </div>


                        </div>
                        <input type="hidden" name="id" id="status-modal-id">
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
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>


    <script>
        var from_date = $('#excel_from_date').val();
        var to_date = $('#excel_to_date').val();
        var excel_ba = $('#excelBa').val();

        $(document).ready(function() {



            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: '{{ route('substation.index', app()->getLocale()) }}',
                    type: "GET",
                    data:function (d) {

                if (from_date) {
                    d.from_date = from_date;
                }

                if (excel_ba) {
                    d.ba = excel_ba;
                }

                if (to_date) {
                    d.to_date = to_date;
                }}
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data:'visit_date',
                        name:'visit_date',
                        orderable: true
                    },
                    {
                        data: 'unlocked',
                        name: 'unlocked'
                    },
                    {
                        data: 'demaged',
                        name: 'demaged'
                    },

                    {
                        data: 'other_gate',
                        name: 'other_gate'
                    },
                    {
                        data: 'grass_status',
                        name: 'grass_status'
                    },
                    {
                        data: 'tree_branches_status',
                        name: 'tree_branches_status'
                    },
                    {
                        data: 'broken_roof',
                        name: 'broken_roof'
                    },
                    {
                        data: 'broken_gutter',
                        name: 'broken_gutter'
                    },
                    {
                        data: 'broken_base',
                        name: 'broken_base'
                    },
                    {
                        data: 'building_other',
                        name: 'building_other'
                    },

                    {
                        data: 'advertise_poster_status',
                        name: 'advertise_poster_status'
                    },
                    {
                        data: 'total_defects',
                        name: 'total_defects'
                    },
                    // {
                    //     render:function(data , type , full){
                    //         if (full.visit_date != '' && full.substation_image_1 != '' && full.substation_image_2 != '') {
                    //             if (full.qa_status == '' ) {
                    //                 return ` <button type="button" class="btn btn-primary "
                    //                                         data-id="${full.id}" data-name="${full.name}" data-total_defects="${full.total_defects}" data-toggle="modal"
                    //                                         data-target="#qaStatusModal">
                    //                                         QA Status
                    //                                     </button>`;
                    //             }
                    //         }else{
                    //             return `<td></td>`;
                    //         }
                    //     }
                    // },
                    {
                        render: function(data, type, full) {

                            var id = full.id;
                            return `<button type="button" class="btn  " data-toggle="dropdown">
                            <img
                                src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <form action="/{{ app()->getLocale() }}/substation/${id}" method="get">

                                <button type="submit" class="dropdown-item pl-3 w-100 text-left">Detail</button>
                            </form>
                            <form action="/{{ app()->getLocale() }}/substation/${id}/edit" method="get">

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
            [1, 'desc']
        ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(1)').addClass('text-center');
                    $(row).find('td:eq(2)').addClass('text-center');
                    $(row).find('td:eq(3)').addClass('text-center');
                    $(row).find('td:eq(4)').addClass('text-center');
                    $(row).find('td:eq(5)').addClass('text-center');
                    $(row).find('td:eq(6)').addClass('text-center');
                    $(row).find('td:eq(7)').addClass('text-center');
                    $(row).find('td:eq(8)').addClass('text-center');
                    $(row).find('td:eq(9)').addClass('text-center');
                    $(row).find('td:eq(10)').addClass('text-center');
                    $(row).find('td:eq(11)').addClass('text-center');
                    $(row).find('td:eq(12)').addClass('text-center');

                }
            })


            $('#excelBa').on('change', function () {
                excel_ba = $(this).val();
        table.ajax.reload(function () {
            table.draw('page');
        });
    })


    $('#excel_from_date').on('change', function () {
                from_date = $(this).val();
        table.ajax.reload(function () {
            table.draw('page');
        });
    })

        $('#excel_to_date').on('change', function () {
                to_date = $(this).val();
        table.ajax.reload(function () {
            table.draw('page');
        });
    });


            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action', '/en/substation/' + id)
            });

            $('#qaStatusModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                $('#modal-name').val(button.data('name'));
                $('#modal-defects').val(button.data('total_defects'));
                $('#status-modal-id').val(id)
                var modal = $(this);
                $('#remove-foam').attr('action', '/en/substation/' + id)
            });


        });


    </script>
@endsection
