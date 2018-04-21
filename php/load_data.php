<?php
    $conn = oci_connect('aniu@db11g','Damnright1','//dbserver.engr.scu.edu/db11g');
    if($conn) {
        print "<br> Success.";
    }
    else {
        print "<br> Failed.";
        exit;
    }
    echo "<BR/>";
    
        $sql = "select * from people";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conn);
?>
