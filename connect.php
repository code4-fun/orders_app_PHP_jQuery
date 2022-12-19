<?php
$db = @mysqli_connect('localhost', 'root', '1', 'orders', 3306) or die('db connection error');
mysqli_set_charset($db, 'utf8') or die('charset is not set');