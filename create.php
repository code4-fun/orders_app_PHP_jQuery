<?php
require_once('functions.php');

$res = create_order($_POST);
echo $res;