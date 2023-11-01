<table id="" class="table table-bordered table-hover">


    <thead style="background-color: #E4E3E3 !important">
        <tr>
            <th>NAME</th>
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
                    <td>{{ $data->name }}</td>
                    <td class="align-middle">{{ $data->zone }}</td>
                    <td>{{ $data->ba }}</td>
                    <td class="align-middle text-center">{{ $data->team }}</td>
                    <td class="align-middle text-center">

                        {{ date('Y-m-d', strtotime($data->visit_date)) }}
                    </td>
                    <td class="text-center">

                        <button type="button" class="btn  " data-toggle="dropdown">
                            <img
                                src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                        </button>
                        <div class="dropdown-menu" role="menu">

                            <form
                                action="{{ route('substation.show', [app()->getLocale(), $data->id]) }}"
                                method="get">
                                <button type="submit"
                                    class="dropdown-item pl-3 w-100 text-left">Detail</button>
                            </form>

                            <form
                                action="{{ route('substation.edit', [app()->getLocale(), $data->id]) }}"
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
        @else
            <tr>
                <td class="text-center" colspan="6"><strong>no recored found</strong>
                </td>


            </tr>
        @endif

    </tbody>
</table>

@if ($datas != [])
    {{ $datas->links() }}
@endif
