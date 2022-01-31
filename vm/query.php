<?php
$date="18-08-17";

$update="ALTER TABLE `us_payment` ADD `pa_transactionid` VARCHAR(100) NOT NULL AFTER `pa_updatedon`;";
$update="ALTER TABLE `us_payment` ADD `pa_mode` VARCHAR(10) NOT NULL COMMENT '(1)customer(2)supplier' AFTER `pa_updatedon`;";

?>