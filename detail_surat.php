<?php 
    $filenya = $_GET['isi_surat'];
    $targetfile = "surat/$filenya";
    header("Content-type: application/pdf"); 
    header("Content-Length: " . filesize($targetfile)); 
  
// Send the file to the browser. 
readfile($targetfile); 
?>  