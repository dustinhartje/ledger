<html>
<head>
</head>
<body>

<?php

// setup db connection parameters
$dbhost = "piggy.dustycorners.local";
$dbname = "ledger";
$dbuser = "ledgerapp";
$dbpass = "dw#vG*;b?3FV";

// connect to db
$dbcon = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

// verify db connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
  echo "<H2>Connected!</H2>";
}

// verify we can read relevant entries
echo "<H1>I am aware of the following accounts:</H1>";

// define query
$q = "select * from accounts";

// run query and store
$r = mysqli_query($dbcon,$q);

// get fields from query results
$f = mysqli_fetch_fields($r);

// start building a table with field names in the header
echo "<table border=1><tr>";

// list fields
foreach ($f as $val) {
  echo "<th>" . $val->name . "</th>";
  //printf("Name: %s\n",$val->name);
  //printf("Table: %s\n",$val->table);
  //printf("max. Len: %s\n",$val->max_length);
}

echo "</tr>";

//list account names from results
while ($row = mysqli_fetch_array($r)) {
  //echo $row['name'] . "<br>";
  echo "<tr>";
  for($i=0;$i<count($row);$i++) {
    echo "<td>" . $row[$i] . "</td>";
  }
  echo "</tr>";
}


echo "</table>";

mysqli_close($dbcon);
?>

</body>
</html>
