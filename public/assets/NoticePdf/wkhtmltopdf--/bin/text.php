<?php 

 echo $file_path = $_REQUEST['path'];

echo $app_no = $_REQUEST['po_no'];
// exit();

echo exec("C:\Program Files\wkhtmltopdf\bin\cmd.exe /c START D:\adkl\public\assets\PurhaseOrderPDF\wkhtmltopdf\bin\test.bat ".$app_no." ".$file_path); 
 

?>