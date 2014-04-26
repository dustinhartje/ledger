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
}


function drawqueryresults($connection,$query) {
  echo '<h3><font color=blue>' . $query . '</font></h3>';
  $r = mysqli_query($connection,$query);
  $fields = mysqli_fetch_fields($r);
  echo '<table border="1" cellpadding="5" cellspacing="0"><tr>';
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

drawqueryresults($dbcon,"select * from accounts");
drawqueryresults($dbcon,"select * from allocations");
drawqueryresults($dbcon,"select * from categories");
drawqueryresults($dbcon,"select c1.id, c1.name, c2.name as parent from categories as c1 left join (categories as c2) on c1.childof=c2.id");
drawqueryresults($dbcon,"select c1.id, c1.name, c2.name as parent, concat(c2.name, ' > ', c1.name) as fullname from categories as c1 left join (categories as c2) on c1.childof=c2.id");
drawqueryresults($dbcon,"select * from methods");
drawqueryresults($dbcon,"select * from payees");
drawqueryresults($dbcon,"select * from shipments");
drawqueryresults($dbcon,"select * from transactions");

?>



<?php
mysqli_close($dbcon);
?>

</body>
</html>
