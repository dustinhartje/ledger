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
//$q = "select * from accounts";
$q = "select id, name, type, provider from accounts";

// run query and store
$r = mysqli_query($dbcon,$q);

// get fields from query results
$f = mysqli_fetch_fields($r);


// TABLE BUILD METHOD 1 ########################

// start building a table with field names in the header
echo "<table border=1><tr>";

// list fields
foreach ($f as $val) {
  echo "<th>" . $val->name . "</th>";
}

echo "</tr>";

//list account names from results
while ($row = mysqli_fetch_array($r)) {
  //echo $row['name'] . "<br>";
  echo "<tr>";
  echo "rowcount=" . count($row);
  for($i=0;$i<count($row);$i++) {
    echo "<td>" . $row[$i] . "</td>";
  }
  echo "</tr>";
}
echo "</table>";

// TABLE BUILD METHOD 2 ########################
?>


<BR/>
<BR/>

<h1>Let's try that again</h1>
<table border="1">
<?php
// list fields
foreach ($f as $val) {
  echo "<th>" . $val->name . "</th>";
}
?>

  <tr>
  <?php
    $r = mysqli_query($dbcon,$q);
    $row = mysqli_fetch_assoc($r);
    echo "row=" . $row;
    foreach($row as $field => $content): ?>
      <td><?php echo $field; ?>: <?php echo $content; ?></td>
    <?php endforeach; ?>
  </tr>
    
    

</table>


<!-- TABLE BUILD METHOD 3 (FUNCTION) ############################ -->
<h1>Now as a function!</h1>

<?php

//function drawtable($query="select id, name from accounts") {
//  global $dbcon;
function drawtable($connection,$query) {
  $r = mysqli_query($connection,$query);
  $fields = mysqli_fetch_fields($r);
  echo '<table border="1"><tr>';
  foreach ($fields as $f) {
    echo '<th>' . $f->name . '</th>';
  }
  echo '</tr>';

  while ($row = mysqli_fetch_assoc($r)) {
    echo '<tr>';
    foreach ($row as $f => $c) {
      echo '<td>' . $c . '</td>';
    }
    echo '</tr>';
  }
  echo '</table>';
}

drawtable($dbcon,"select id, name, type from accounts");

?>



<?php
mysqli_close($dbcon);
?>

</body>
</html>
