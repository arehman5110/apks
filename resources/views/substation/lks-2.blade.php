<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>generate lks</title>
</head>

<body>

    <p  >Total Number of downloads is <span class="counts"></span></p>
    <p  >Total download complete <span id="download-complete"></span> / <span class="counts"></span></p>
    <p id='handle-request'></p>

     

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        var ba = "{{ $ba }}";
        var from_date = "{{$from_date}}";
        var to_date = "{{$to_date}}"

        

    
            $.ajax({
            url: `/{{app()->getLocale()}}/generate-substation-lks-table-of-content?ba=${ba}&from_date=${from_date}&to_date=${to_date}`,
            method: 'GET',
            success: function(response) {
                // Handle the success response
                var pdfPath = response.pdfPath;
                   
                   const link = document.createElement('a');
                   link.setAttribute('href', '/temp/' + pdfPath);
                   link.setAttribute('download', pdfPath); 
                   link.click();

                   link.remove();

                   removeFiles(pdfPath);
                
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
     
        function getDates(){
            $.ajax({
            url: `/{{app()->getLocale()}}/generate-substation-lks?ba=${ba}&from_date=${from_date}&to_date=${to_date}`,
            method: 'GET',
            success: function(response) {
                // Handle the success response
                $('.counts').html(response.length +1)
                
                generateFiles(response, 0);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
        }

 
        function generateFiles(dates, index) {

            $('#handle-request').html('Please wait sending request ...');
            $('#download-complete').html(index + 1)
            if (index < dates.length) {

                $.ajax({
                    url: '/{{app()->getLocale()}}/generate-substation-lks-by-visit-date?ba=' + ba + '&visit_date=' + dates[index],
                    method: 'GET',
                    success: function(response) {
                        // Handle the success response
                        $('#handle-request').val('downloading ...' + index+1 + ' / ' + dates.length);

                        var pdfPath = response.pdfPath;
                   
                        const link = document.createElement('a');
                        link.setAttribute('href', '/temp/' + pdfPath);
                        link.setAttribute('download', pdfPath); 
                        link.click();

                        link.remove();

                        removeFiles(pdfPath ,dates , index);
                        // generateFiles(dates, index + 1);
                    },
                    error: function(error) {
                        // Handle the error
                        console.error('Error:', error);
                    }
                });
            } else {
                $('#handle-request').html('downloading complete ')
                window.close()
            }

        }

        function removeFiles(pdfPath ,dates ,index){
            $.ajax({
                    url: '/{{app()->getLocale()}}/remove-generate-lks-by-visit-date?fileName='+pdfPath,
                    method: 'GET',
                    success: function(response) {
                        if (dates) {
                            generateFiles(dates, index + 1);
                        }else{
                            getDates();
                        }
                 
                        

                     
                    },
                    error: function(error) {
                   
                        console.error('Error:', error);
                    }
                });

        }
    </script>
</body>

</html>
