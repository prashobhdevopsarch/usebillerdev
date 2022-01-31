<?php

  include("includes/config.php");/* ESTABLISH CONNECTION IN THIS FILE; MAKE SURE THAT IT IS mysqli_* */
   $tag=$_GET['term'];
   $htid=$_GET["htid"];
  $stmt = $conn->prepare("select el_name from us_elec WHERE el_name LIKE '%$tag%' AND user_id='$htid'"); /* START PREPARED STATEMENT */
  $stmt->execute(); /* EXECUTE THE QUERY */
  $stmt->bind_result($description); /* BIND THE RESULT TO THIS VARIABLE */
  while($stmt->fetch()){ /* FETCH ALL RESULTS */
    $description_arr[] = $description; /* STORE EACH RESULT TO THIS VARIABLE IN ARRAY */
  } /* END OF WHILE LOOP */

  echo json_encode($description_arr); /* ECHO ALL THE RESULTS */

?>