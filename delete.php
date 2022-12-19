<?php
require_once('functions.php');

$res = delete_order($_POST['id']);
echo $res;