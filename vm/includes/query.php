<?php
$date="13-4-17";

$update="ALTER TABLE `us_supplier` ADD `rs_tinnum` VARCHAR(100) NOT NULL AFTER `rs_isactive`;";

$date="15-4-17";

$update="ALTER TABLE `us_billentry` ADD `be_gtotal` VARCHAR(100) NOT NULL AFTER `be_total`;";

$update="ALTER TABLE `us_billentry` ADD `be_oldbal` VARCHAR(100) NOT NULL AFTER `be_coolie`;";

$update="ALTER TABLE `us_purentry` ADD `pe_gtotal` VARCHAR(100) NOT NULL AFTER `pe_total`, ADD `pe_oldbal` VARCHAR(100) NOT NULL AFTER `pe_gtotal`;";

?>