<?php

function connect()
{
	$db_connection = mysql_connect('localhost', 'cs143', '');
	mysql_select_db('CS143', $db_connection);
	return $db_connection;
}

?>