<style>
    .row{
        border: 0px;
    }
</style>

<div class="col-12">
    <div id="collapseQr">
        <div class="card card-body">
            <form action="{{ isset($url) ? route($url, app()->getLocale()) : '#' }}"
                onsubmit="collapseFilter()" method="post">
                @csrf
                <div class="row form-input ">
                    <div class=" col-md-2">
                        <label for="excelZone">Zone :</label>
                        <select name="excelZone" id="excelZone" class="form-control" onchange="getBa(this.value)">
                            <option value="{{ Auth::user()->zone }}" hidden>
                                {{ Auth::user()->zone != '' ? Auth::user()->zone : 'Select Zone' }}
                            </option>
                            @if (Auth::user()->zone == '')
                                <option value="W1">W1</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="B4">B4</option>
                            @endif
                        </select>
                    </div>
                    <div class=" col-md-2">
                        <label for="excelBa">BA :</label>
                        <select name="ba" id="excelBa" class="form-control">
                            <option value="{{ Auth::user()->ba }}" hidden>
                                {{ Auth::user()->ba != '' ? Auth::user()->ba : 'Select BA' }} </option>

                        </select>
                    </div>


                    <div class=" col-md-2">
                        <label for="excel_from_date">From Date : </label>
                        <input type="date" name="excel_from_date" id="excel_from_date"
                            class="form-control" onchange="setMinDate(this.value,'{{explode('-',$url)[1]}}')">
                    </div>
                    <div class=" col-md-2">
                        <label for="excel_to_date">To Date : </label>
                        <input type="date" name="excel_to_date" id="excel_to_date" onchange="setMaxDate(this.value,'{{explode('-',$url)[1]}}')" class="form-control">
                    </div>
                    @isset($url)
                    <div class="col-md-1 pt-2 ">

                        <button type="button" class="btn text-white btn-sm mt-4 " class="form-control"
                            style="background-color: #708090" onclick="resetIndex()">Reset</button>
                    </div>

                    <div class="col-md-1 pt-2 ">

                        <button type="button" class="btn text-white btn-sm mt-4 " class="form-control"
                            style="background-color: #708090" onclick="generateLKS()">Generate LKS</button>
                    </div>


                    @endisset




            </form>
        </div>
    </div>
</div>
