<html> 
<?php 
$conn=oci_connect('aniu','Damnright1','//dbserver.engr.scu.edu/db11g');
if($conn) {
  print "<br> connection successful";
} else {
  $e=oci_error;
  print "<br> connection failed:";
  print htmlentities($e['message']);
  exit;
}


echo "<BR/>";
echo "</TR><TH> Get Prisoner Name<TH>";
echo "<BR/>";

$sql="SELECT * from t";

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
echo              "<TR><TH>Customer              Number</TH><TH>Customer Name</TH><TH>Street</TH><TH>City</TH>";
// format results by row
while 
(OCIFetch($sql_statement)){
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
?></html>

