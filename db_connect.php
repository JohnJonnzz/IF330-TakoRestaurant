<?php
define('DSN', 'mysql:host=localhost;dbname=uts');
define('DBUSER', 'root');
define('DBPASS', '123');

$db = new PDO(DSN, DBUSER, DBPASS);
