<?php 
session_start();
$config = parse_ini_file('config.ini');
$host = $config['host'];
$user = $config['user'];
$pass = $config['pass'];
$db = $config['db'];

$_con = mysqli_connect($host, $user, $pass, $db);
if ( mysqli_connect_errno() ) {
	//Just exit without leaking any sensitive errors to the user
	exit('<main><div class="alert alert__danger">Failed to connect.</div></main>');
}
