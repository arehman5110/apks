<?php

 echo $file_path = $_REQUEST['path'];

echo $app_no = $_REQUEST['po_no'];
// exit();

echo shell_exec("c:\WINDOWS\system32\cmd.exe /c START test.bat ".$app_no." ".$file_path);


?>
