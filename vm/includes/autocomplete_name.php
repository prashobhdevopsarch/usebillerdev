<?php

  include("config.php");/* ESTABLISH CONNECTION IN THIS FILE; MAKE SURE THAT IT IS mysqli_* */
  $htid=$_GET["htid"];
   $tag=$_GET['term'];
  $stmt = $conn->prepare("select pr_productname from us_products WHERE pr_isactive='0' and pr_productname  LIKE '%$tag%' AND user_id='$htid'"); /* START PREPARED STATEMENT */
  $stmt->execute(); /* EXECUTE THE QUERY */
  $stmt->bind_result($description); /* BIND THE RESULT TO THIS VARIABLE */
  while($stmt->fetch()){ /* FETCH ALL RESULTS */
    $description_arr[] = $description; /* STORE EACH RESULT TO THIS VARIABLE IN ARRAY */
  } /* END OF WHILE LOOP */

  echo json_encode($description_arr); /* ECHO ALL THE RESULTS */

?>