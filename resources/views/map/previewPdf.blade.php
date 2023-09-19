<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
      @media print {
        #print-button {
            display: none;
        }

        header,
        footer {
            display: none;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            /*Chrome, Safari */
            color-adjust: exact !important;
            /*Firefox*/
        }
        .container{
            box-shadow: none !important;
        }
    }
    </style>
</head>


    <body>


<div class="container shadow p-4   my-5 bg-white ">

    <img src="{{URL::asset('assets/web-images/pdfimg.png')}}" alt="">
           
    <div class="text-end">
        <button type="button" class="btn btn-sm btn-secondary" id="print-button" onclick="exportToPDF()">Export to
            PDF</button>
    </div>
                <h5>BORANG RONDAAN / LAWATAN TAPAK KERJA KOREKAN DI LALUAN KABEL TENAGA NASIONAL BERHAD</h5>

                <table class="table-bordered w-100 caption-top">
                    <tr>
                        <th class="col-6">Tarikh Rondaan / Lawatan Tapak</th>
                        <td class="col-6">{{$data->survey_date}}</td>
                    </tr>

                    <tr>
                        <th>Masa Rondaan / Lawatan Tapak</th>
                        <td>{{$data->patrolling_time}}</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Nama Projek</th>
                        <td>{{$proj->project_name}}</td>
                    </tr>
                    <tr>
                        <th>Feeder Terlibat / Bil. Litar</th>
                        <td>{{$data->feeder_involved}}</td>
                    </tr>
                </table>

                <table class="table-bordered w-100 caption-top">
                    <caption>MAKLUMAT PEMAJU / KONTRAKTOR UTAMA</caption>
                    <tr>
                        <th class="col-6">Nama Syarikat</th>
                        <td>{{$data->company_name}}</td>
                    </tr>
                    <tr>
                        <th>No Telefon Pejabat</th>
                        <td>{{$data->office_phone_no}}</td>
                    </tr>
                    <tr>
                        <th>Wakil Pemaju / Kontraktor Utama</th>
                        <td>{{$data->main_contractor}}</td>
                    </tr>
                    <tr>
                        <th>No Telefon Wakil Pemaju / Kontraktor Utama</th>
                        <td>{{$data->developer_phone_no}}</td>
                    </tr>
                   
                </table>

                <table class="table-bordered w-100 caption-top">
                    <caption>MAKLUMAT KONTRAKTOR</caption>
                    <tr>
                        <th>Nama Syarikat Kontraktor</th>
                        <td>{{$data->contractor_company_name }}</td>
                    </tr>
                    <tr>
                        <th>Nama Penyelia Tapak</th>
                        <td>{{$data->site_supervisor_name }}</td>
                    </tr>
                    <tr>
                        <th class="col-6">No Telefon Penyelia Tapak</th>
                        <td>{{$data->site_supervisor_phone_no }}</td>
                    </tr>
                </table>
                <table class="table-bordered w-100 caption-top">
                    <caption class="caption-top">MAKLUMAT JENTERA PROJEK</caption>
                    <tr>
                        <th class="col-6">Nama Pengendali Jentera Pengorek</th>
                        <td>{{$data->excavator_operator_name}}</td>
                    </tr>
                    <tr>
                        <th>No Pendaftaran Jentera Pengorek</th>
                        <td>{{$data->excavator_machinery_reg_no}}</td>
                    </tr>
                </table>

                <p><strong>PERAKUAN</strong></p>
                <ol class="mb-5 pb-3">
                    <li> Saya dengan ini telah dimaklumkan dan faham bahawa terdapat / mungkin kabel TNB di tapak kerja
                        korekan sedang dilaksanakan.</li>
                        <li> Saya berjanji akan berhati-hati dan akan mengambil langkah yang sewajarnya bagi mengelakkan kerosakan 
                            di mana kerja berhampiran kabel TNB.</li>
                        <li> Saya juga faham akan bertanggungjawab sepenuhnya ke atas sebarang kerosakan kabel termasuk kos
                            pembaikan akibat kerja korekan yang diselia oleh saya.</li>
                        <li> Saya juga telah menerima Notis Pemberitahuan daripada TNB.</li>
                </ol>

                <table class="w-100 ">
                    <tr>
                        <td class="col-4">Wakil Pemaju / Kontraktor Utama</td>
                        <td class="col-4 text-center">Wakil Kontraktor</td>
                        <td class="col-4 text-center">Wakil TNB</td>
                    </tr>
                    <tr>
                        <td class="col-4">NAMA:</td>
                        <td>NAMA:</td>
                        <td>NAMA:</td>
                    </tr>
                    <tr class="col-4">
                        <td>NO IC:</td>
                        <td>NO IC:</td>
                        <td>NO IC:</td>
                    </tr>
                    <tr>
                        <td>NO H/P:</td>
                        <td>NO H/P:</td>
                        <td>NO H/P:</td>
                    </tr>

                </table>
            

        </div>

    
    <script> 
     $(document).ready(function() {

window.addEventListener('afterprint', function() {
    window.close()
})
})

    function exportToPDF() {

      
        window.print()
    }</script> 
    
    </body></html>
