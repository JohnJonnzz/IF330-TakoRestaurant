<?php
define('DSN', 'mysql:host=localhost;dbname=uts');
define('DBUSER', 'root');
define('DBPASS', '');

$db = new PDO(DSN, DBUSER, DBPASS);
