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

//dan-start
if (isset($_POST['userName'])) {
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];
        $age = $_POST['age'];
        $password = $_POST['password'];
        echo $userName;
        $insertIntoPeople = "insert into business values($userId,'$userName',$age,'$password')";
        $sql_statement = OCIParse($conn,$insertIntoPeople);
        echo $insertIntoPeople;
OCIExecute($sql_statement);
}

$danVar = '';
echo '
<form name = "login" method="post">
ID <input type="text" name = "userId" >
<br>
COMPANY NAME <input type="text" name = "userName" >
<br>
SIZE <input type="text" name = "age" >
<br>
INDUSTRY <input type="text" name = "password" >
<br>
<input type = "submit" value = "submit">
</form>';
//dan-end

echo "<BR/>";
echo "<br>";
echo "</TR><TH> Get Business Name<TH>";
echo "<BR/>";

$sql="SELECT * from business";

echo "<BR/>";
echo "</TR><TH>-- Parsing<TH>";
$sql_statement=OCIParse($conn,$sql); #parse through database

echo $sql_statement;
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
echo              "<TR><TH>ID              Number</TH><TH>Company Name</TH><TH>Size</TH><TH>Industry</TH>";
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
?></html>
