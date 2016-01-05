<?PHP
session_start();
$uname = "";
$pword = "";
$errorMessage = "";
//==========================================
//	ESCAPE DANGEROUS SQL CHARACTERS
//==========================================
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$uname = $_POST['ID'];
	$pword = $_POST['password'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$user_name = "blogacc";
	$pass_word = "blogacc";
	$database = "myblog";
	$server = "127.0.0.1";
	$tbl_name = "login";

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) {

		$uname = quote_smart($uname, $db_handle);
		$pword = quote_smart($pword, $db_handle);

		$SQL = "SELECT * FROM $tbl_name WHERE ID = $uname 
										AND BINARY password = $pword";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);

	//====================================================
	//	CHECK TO SEE IF THE $result VARIABLE IS TRUE
	//====================================================

		if ($result) {
			if ($num_rows > 0) {
				// session_start();
				$_SESSION['username'] = $uname;
				header ("Location: /myblog/index.php");
			} else {
				// session_start();
				$_SESSION['login'] = "";
				header ("Location: /myblog/index.php");
			}	
		} else {
			$errorMessage = "Error logging on";
		}
		mysql_close($db_handle);
	} else {
		$errorMessage = "Error logging on";
	}
}
?>