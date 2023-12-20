@extends('layouts.app')
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        h3 {
            font-weight: 600
        }

        .collapse .card-body {
            padding: 0px !important
        }

        h3 {
            color: #7379AE;
            font-size: 20px !important;
        }

        .accordion .card {
            background: #d1cfcf14;
        }

        .dashboard-counts h3 {
            font-size: 1rem !important
        }

        .dashboard-counts p {
            font-weight: 600;
            color: slategrey;
        }
        .form-input{
            padding: 0  10px 0 0 ;

    border: 0px;
        }
    </style>
@endsection
@section('content')

@if(Auth::user()->ba=='')


    <div class=" px-4  mt-2  from-input  ">
            <div class="card p-0 mb-3">
                <div class="card-body row">

                    <div class=" col-md-3">
                        <label for="excelZone">Zone :</label>
                        <select name="excelZone" id="excelZone" class="form-control" onchange="getBa(this.value)">
                            <option value="" hidden>
                                Select Zone
                            </option>

                                <option value="W1">W1</option>
                                <option value="B1">B1</option>
                                <option value="B2">B2</option>
                                <option value="B4">B4</option>

                        </select>
                    </div>
                    <div class=" col-md-3">
                        <label for="excelBa">BA :</label>
                        <select name="excelBa" id="excelBa" class="form-control" onchange="onChangeBA()">


                        </select>
                    </div>
                    <div class=" col-md-2 form-input">
                        <label for="excel_from_date">From Date : </label>
                        <input type="date" name="excel_from_date" id="excel_from_date"
                            class="form-control" onchange="setMinDate(this.value)">
                    </div>
                    <div class=" col-md-2 form-input">
                        <label for="excel_to_date">To Date : </label>
                        <input type="date" name="excel_to_date" id="excel_to_date" onchange="setMaxDate(this.value)" class="form-control">
                    </div>
                    <div class="col-md-2 pt-2">
                        <br>
                        <button class="btn btn-secondary  " type="button" onclick="resetDashboard()">Reset</button>
                    </div>



                </div>
            </div>
        </div>


        <div class=" px-4  mt-2  from-input  ">
            <div class="card p-0 mb-3">
                <div class="card-body row">

            <table class="table">
            <thead>
                <tr>

                <th scope="col">BA</th>
                <th scope="col">Patroling</th>
                <th scope="col">Substation</th>
                <th scope="col">Feeder Pillar</th>
                <th scope="col">Tiang</th>
                <th scope="col">Link Box</th>
                <th scope="col">Cable Bridge</th>
                </tr>
            </thead>
            <tbody id='stats_table'>

    </tbody>
    </table>
                </div>
            </div>
        </div>

@endif
    <div class=" px-4 mt-2">
        <div class="row dashboard-counts">
            {{-- <div class="col-md-2">
        <div class="card p-3">

                <h3 class="text-center">   3rd Party Digging </h3>
                <p class="text-center mb-0 pb-0"><span>0</span></p>

          </div>
    </div> --}}

            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">{{__("messages.patroling")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_patrollig_done")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span id="total_km">{{ $data->total_km}} KM</span></p>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_notice_generated")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span id="total_notice">{{$data->total_notice ?? '0'}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_supervision")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span id="total_supervision">{{$data->total_supervision ?? 0}}</span></p>

                                </div>
                            </div>

                           

                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="suryed_patrolling-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="patrolling-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header text-white">{{__("messages.substation")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_substation_visited")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span id="substation">{{$data->substation}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_substation_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0" ><span id="substation_defects">{{$data->substation_defects}}</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="suryed_substation-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="substation-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>


                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">{{__("messages.feeder_pillar")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_feeder_pillar_visited")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span id="feeder_pillar">{{$data->feeder_pillar}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_feeder_pillar_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span id="fp_defects">{{$data->fp_defects}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="suryed_feeder_pillar-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="feeder_pillar-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>


                           
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">{{__("messages.tiang")}}</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_tiang_visited")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span id="tiang">{{$data->tiang}}</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_tiang_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span id="savr">{{$data->savr}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="suryed_tiang-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="tiang-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">{{__("messages.link_box")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_link_box_visited")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span id="link_box">{{$data->link_box}}</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_link_box_defects")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span id="linkbox">{{$data->linkbox}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="suryed_link_box-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="link_box-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card card-danger">
                    <div class="card-header"> {{__("messages.cable_bridge")}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_cable_bridge_visited")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span id="cable_bridge">{{$data->cable_bridge}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_cable_bridge_defects")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span id="cablebridge">{{$data->cablebridge}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="suryed_cable_bridge-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">
                                <div id="cable_bridge-container" style="width:100%; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>


                            
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('script')

<script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>


<script>

    function onChangeBA(){
         // console.log(data['patrolling']);
         $("#patrolling-container").html('')
            $("#substation-container").html('')
            $("#feeder_pillar-container").html('')
            $("#link_box-container").html('')
            $("#link_box-container").html('')
            $("#cable_bridge-container").html('')
            $("#tiang-container").html('')

            // $("#suryed_patrolling-container").html('')
            $("#suryed_substation-container").html('')
            $("#suryed_feeder_pillar-container").html('')
            $("#suryed_link_box-container").html('')
            $("#suryed_link_box-container").html('')
            $("#suryed_cable_bridge-container").html('')
            $("#suryed_tiang-container").html('')

        getDateCounts();
    }


    function mainBarChart(cat,series ,id ,tName ){
        var barName =  '';
        var titleName = 'Total ' +tName;
        if (id == "patrolling-container") {
            barName = 'KM'
            titleName = 'KM Patrol'
        }
    Highcharts.chart(id, {
        chart: {
            type: 'column'
        },
        credits:false,

        title: {
            text: 'Total ' + tName
        },
        subtitle: {
            text: 'Source:Aerosynergy'
        },
        xAxis: {
            categories:cat,
            min: 0,
            max:3,
            scrollbar:{
                enabled:true
              },

            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: titleName
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: `<tr><td style="color:{series.color};padding:0">{series.name}: </td>` +
                `<td style="padding:0"><b>{point.y:f}</b>${barName}</td></tr>`,
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: series
    });
}




function getDateCounts(){



    var cu_ba=$('#excelBa').val() ?? 'null';
    var from_date=$('#excel_from_date').val() ?? '';
    var to_date=$('#excel_to_date').val() ?? '';

    




    $.ajax({
        url: `/{{app()->getLocale()}}/patrol_graph?ba_name=${cu_ba}&from_date=${from_date}&to_date=${to_date}`,

        dataType: 'JSON',
        method: 'GET',
        async: false,
        success: function callback(data) {


            if (data && data['patrolling'] != '') {
                makeArray(data['patrolling'] , 'patrolling-container' ,'Defcets' )
            }

            if (data && data['substation'] != '') {
                makeArray(data['substation'] , 'substation-container' ,'Defcets')
            }

            if (data && data['feeder_pillar'] != '') {
                makeArray(data['feeder_pillar'] , 'feeder_pillar-container' ,'Defcets' )
            }

            if (data && data['link_box'] != '') {
                makeArray(data['link_box'] , 'link_box-container' ,'Defcets')
            }

            if (data && data['cable_bridge'] != '') {
                makeArray(data['cable_bridge'] , 'cable_bridge-container' ,'Defcets' )
            }

            if (data && data['tiang'] != '') {
                makeArray(data['tiang'] , 'tiang-container'  ,'Defcets' )
            }

            // if (data && data['suryed_patrolling'] != '') {
            //     makeTotalArray(data['suryed_patrolling'] , 'suryed_patrolling-container'  )
            // }

            if (data && data['suryed_substation'] != '') {
                makeArray(data['suryed_substation'] , 'suryed_substation-container' ,'Visited' )
            }

            if (data && data['suryed_feeder_pillar'] != '') {
                makeArray(data['suryed_feeder_pillar'] , 'suryed_feeder_pillar-container' ,'Visited' )
            }

            if (data && data['suryed_link_box'] != '') {
                makeArray(data['suryed_link_box'] , 'suryed_link_box-container' ,'Visited' )
            }

            if (data && data['suryed_cable_bridge'] != '') {
                makeArray(data['suryed_cable_bridge'] , 'suryed_cable_bridge-container' ,'Visited' )
            }

            if (data && data['suryed_tiang'] != '') {
                makeArray(data['suryed_tiang'] , 'suryed_tiang-container' ,'Visited' )
            }
        }
    });



    $.ajax({
        url: '/{{app()->getLocale()}}/dashboard?ba_name='+cu_ba,
        dataType: 'JSON',
        method: 'GET',
        async: false,
        success: function callback(data) {

            for (var key in data){
              $("#"+key).html(data[key]);
            }
        }
    });


}

function makeTotalArray(arr ,id) {

    console.log(arr);
    var cate = arr.map(item => item.ba);
var seriesD = arr.map(item => item.count);

var series = [{
  name: 'Count',
  data: seriesD
}];

console.log(series);
mainBarChart(cate, series, id ,'Counts');


}


function makeArray(data ,id , tName) {


    var series=[];
        var temp=[];
        var cat=[];
        for(var k=0;k<data.length;k++){
            if(cat.includes(data[k].visit_date)==false){
                cat.push(data[k].visit_date)
            }
        }
        for(var i=0;i<data.length;i++){
            // if(cat.includes(data[i].updated_at)==false){
            //     cat.push(data[i].updated_at)
            // }
            var username=data[i].ba;
        if(temp.includes(username)==true){
            continue;
        }else{
            temp.push(username);
            var obj={};
            obj.name=username;
            var arr=[]
            for(var j=0;j<data.length;j++){
                if(data[j].ba==username){
                     var len=0;
                     if(arr.length>0){
                         len=arr.length;
                     }
                    //if(data[j].updated_at==cat[len]){
                    var index = cat.indexOf(data[j].visit_date);
                    if(index>len){
                    for(g=len;g<index;g++){
                    arr.push(0)
                    }
                    arr.push(parseInt(data[j].bar));
                    }else{
                        arr.push(parseInt(data[j].bar));
                    }
                    // }else{
                    //     arr.push(0)
                    // }
                }

            }
            obj.data=arr;
            series.push(obj)
        }

        }
        // console.log(series);
        mainBarChart(cat,series ,id , tName)


}

$(function(){
    if ('{{Auth::user()->ba}}' == '') {
        getAllStats()
    }

    $('#excel_from_date , #excel_to_date').on('change',function(){
        onChangeBA();
        getAllStats();



    })
})


function getAllStats(){
    let  todaydate='{{date("Y-m-d")}}';



var cu_ba=$('#excelBa').val() ?? 'null';
if($('#excel_from_date').val()==''){
    var from_date='1970-01-01'
}else{
    var from_date = $('#excel_from_date').val();
}if($('#excel_to_date').val()==''){
    var to_date=todaydate
}else{
    var to_date = $('#excel_to_date').val() ;
}

    $.ajax({
        url: `/{{app()->getLocale()}}/statsTable?from_date=${from_date}&to_date=${to_date}`,
        dataType: 'JSON',
        method: 'GET',
        async: false,
        success: function callback(data) {
            var str='';
            for (var i=0; i<data.length;i++){
              str+='<tr><td>'+data[i].ba+'</td><td>'+data[i].patroling+'</td>'+'<td>'+data[i].substation+'</td><td>'+data[i].feeder_pillar+'</td><td>'+data[i].tiang+'</td><td>'+data[i].link_box+'</td><td>'+data[i].cable_bridge+'</td></tr>'
            }
            $('#stats_table').html(str);
        }
    });
}


function resetDashboard(){
    $('#excelBa').empty();
    $('#excel_from_date, #excel_to_date ').val('');
    onChangeBA();
}


setTimeout(() => {
    getDateCounts();
}, 1000);
</script>

@endsection
