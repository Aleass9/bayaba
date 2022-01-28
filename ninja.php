
<?php 

fonction GetIP() 
{ 
	si (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "inconnu")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	sinon si (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "inconnu")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	sinon si (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "inconnu")) 
		$ip = getenv("REMOTE_ADDR"); 
	sinon si (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "inconnu"))
		$ip = $_SERVER['REMOTE_ADDR'] ;
	autre
		$ip = "inconnu" ;
	retour($ip);
}

fonction logData()
{ 
	$ipLog="log.txt" ;
	$cookie = $_SERVER['QUERY_STRING'] ;
	$register_globals = (bool) ini_get('register_gobals');
	si ($register_globals) $ip = getenv('REMOTE_ADDR');
	sinon $ip = GetIP();

	$rem_port = $_SERVER['REMOTE_PORT'] ;
	$user_agent = $_SERVER['HTTP_USER_AGENT'] ;
	$rqst_method = $_SERVER['METHOD'] ;
	$rem_host = $_SERVER['REMOTE_HOST'] ;
	$référent = $_SERVER['HTTP_REFERER'] ;
	$date=date ("l dS de FY h:i:s A");
	$log=fopen("$ipLog", "a+");

	si (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) 
		fputs($log, "IP : $ip | PORT : $rem_port | HOST : $rem_host | Agent : $user_agent | METHOD : $rqst_method | REF : $referer | DATE{ : } $date | COOKIE : $cookie <br> "); 
	autre
		fputs($log, "IP : $ip | PORT : $rem_port | HOST : $rem_host | Agent : $user_agent | METHOD : $rqst_method | REF : $referer | DATE : $date | COOKIE : $cookie \n\n" ); 
	fclose($log); 
} 

logData(); 

?>