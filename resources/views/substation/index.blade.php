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



                                {{-- <table id="pagination" class="table table-bordered table-hover"> --}}
                                <div class="">
                                    <div class="d-flex justify-content-end input-group mb-2">
                                        <input type="search" name="substation" id="substation" class="mb-0"
                                            placeholder="Search by name">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text">
                                                <i class="fa fa-search"></i>
                                                <!-- You can use a different search icon class if needed -->
                                            </button>
                                        </div>
                                    </div>
                               </div>
 <div class="table-responsive add-substation" id="add-substation">
                                @include('substation.pagination')
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

            var name = '%';
            name = encodeURIComponent(name)

            $(document).on('click', 'span a', function(event)

                {


                    $('span a').removeClass('active')

                    $(this).addClass('active');

                    event.preventDefault();

                    var page = $(this).attr('href').split('page=')[1];
                    $.ajax({
                        url: `/{{app()->getLocale()}}/substation-paginate/${name}?page=${page}`,
                        dataType: 'html',
                        method: 'GET',
                        async: false,
                    }).done(function(data) {

                        $("#add-substation").empty().html(data);




                    })

                })

                $(document).on('change', '#substation', function(event)
                {
                   name = encodeURIComponent(this.value);
                    //  name = this.value;
                    name = name == '' ? '%' : name;
                    name = encodeURIComponent(name);
                    console.log(name);

                    
                    // name = JSON.stringify(name);

                    $('span a').removeClass('active')

                    $(this).addClass('active');

                    event.preventDefault();


                    $.ajax({
                        url: `/{{app()->getLocale()}}/substation-paginate/${name}`,
                        dataType: 'html',
                        method: 'GET',
                        async: false,
                    }).done(function(data) {

                        $("#add-substation").empty().html(data);




                    })

                })

        });
    </script>
@endsection
