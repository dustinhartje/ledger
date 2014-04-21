<html>
<head>
</head>
<body>
<h1> Hello World!</h1>

<?php
//$dbhost = "piggy.dustycorners.local";
$dbhost = "10.20.30.38";
$dbname = "ledger";
$dbuser = "ledgerapp";
$dbpass = "dw#vG*;b?3FV";
echo "test";
// Open DB Connection
//$dbcon = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,3306);
$dbcon = mysqli_connect("piggy.dustycorners.local","ledgerapp",$dbpass) or die(mysql_error());

// Check DB Connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//  echo "<br>" . mysqli_error();
//  echo "<br>" . mysqli_error_list();
}
else
{
  echo "<H2>Connected!</H2>";
}
?>

</body>
</html>
