<?php
    $myfile = fopen("../teslatrhsuncoekdmnicein283h4hi3b4b5in.txt","r") or die("Unable to open file!");
    $update=fread($myfile,filesize("../teslatrhsuncoekdmnicein283h4hi3b4b5in.txt"));
    fclose($myfile);
    echo '{"success": true, "data": '.$update.'}';
 ?>
