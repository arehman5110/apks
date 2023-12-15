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
    </style>
@endsection
@section('content')
    <div class=" p-4 ">

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
                                    <p class="text-center mb-0 pb-0"><span>{{ $data->total_km}} KM</span></p>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center">{{__("messages.total_notice_generated")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->total_notice}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_supervision")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->total_supervision}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-12">
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
                                    <p class="text-center mb-0 pb-0"><span>{{$data->substation}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_substation_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->substation_defects}}</span></p>

                                </div>
                            </div>


                            <div class="col-md-12">
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
                                    <p class="text-center mb-0 pb-0"><span>{{$data->feeder_pillar}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_feeder_pillar_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->fp_defects}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-12">
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
                                    <p class="text-center mb-0 pb-0"><span>{{$data->tiang}}</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_tiang_defects")}}</h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->savr}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-12">
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
                                    <p class="text-center mb-0 pb-0"><span>{{$data->link_box}}</span></p>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_link_box_defects")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->linkbox}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-12">
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
                                    <p class="text-center mb-0 pb-0"><span>{{$data->cable_bridge}}</span></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card p-3">

                                    <h3 class="text-center"> {{__("messages.total_cable_bridge_defects")}} </h3>
                                    <p class="text-center mb-0 pb-0"><span>{{$data->cablebridge}}</span></p>

                                </div>
                            </div>

                            <div class="col-md-12">
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

<script>
    function mainBarChart(cat,series ,id  ){
        var barName = 'Defects';
        var titleName = 'Defects';
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
            text: 'Total Data'
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

$.ajax({
    url: '/{{app()->getLocale()}}/patrol_graph',
    dataType: 'JSON',
    method: 'GET',
    async: false,
    success: function callback(data) {
        // console.log(data['patrolling']);

        if (data && data['patrolling'] != '') {
            makeArray(data['patrolling'] , 'patrolling-container'  )
        }

        if (data && data['substation'] != '') {
            makeArray(data['substation'] , 'substation-container' )
        }

        if (data && data['feeder_pillar'] != '') {
            makeArray(data['feeder_pillar'] , 'feeder_pillar-container' )
        }

        if (data && data['link_box'] != '') {
            makeArray(data['link_box'] , 'link_box-container' )
        }

        if (data && data['cable_bridge'] != '') {
            makeArray(data['cable_bridge'] , 'cable_bridge-container' )
        }

        if (data && data['tiang'] != '') {
            makeArray(data['tiang'] , 'tiang-container' )
        }
        
       
    }
});



}

function makeArray(data ,id) {
     
    
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
        mainBarChart(cat,series ,id)
       
       
}


setTimeout(() => {
    getDateCounts();
}, 1000);
</script>    

@endsection