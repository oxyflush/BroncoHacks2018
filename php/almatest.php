<html> 

<?php
$conn=oci_connect('aniu','Damnright1','//dbserver.engr.scu.edu/db11g');
if($conn) {
  print "<br> connection successDan";
} else {
  $e=oci_error;
  print "<br> connection fail:";
  print htmlentities($e['message']);
  exit;
}

//Fetch Queries
echo "<BR/>";
echo "<br>";
echo "</TR><TH> Get Count Values Company  Name<TH>";
echo "<BR/>";
echo '
<button onclick="myFunction()">Click me </button>';
$sql="select name,industry from people,business where people.job_interest=business.industry";
echo "<BR/>";
echo "</TR><TH>-- Parsing<TH>";
$sql_statement=OCIParse($conn,$sql); #parse through database
// execute SQL query
OCIExecute($sql_statement);
// get number of columns for use later
$num_columns = OCINumCols($sql_statement);
echo "<BR/>";
echo "</TR><TH>
--
Obtaining results<TH>";
// start results formatting
echo "<TABLE BORDER=1>";
echo              "<TR><TH> Name</TH><TH>Industry Match</TH>";
// format results by row
while (OCIFetch($sql_statement)){
echo "<TR>";
for ($i = 1; $i <= $num_columns; $i++) {
$column_value = OCIResult($sql_statement,$i);
echo "<TD>$column_value</TD>";
}
echo "</TR>";
}
echo "</TABLE>";
// free resources and close connection
OCIFreeStatement($sql_statement);
OCILogoff($conn);
echo "
/*
<script>
function myFunction() {
var x=document.getElementById('myDIV');
if(x.style.display ==='none'){
  x.style.display='block';
  } else {
    x.style.display='none';
   }
}
</script>
*/
";

?></html>

