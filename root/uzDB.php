<?php
    $_POST['autors']=trim($_POST['autors']);
    $_POST['komentars']=trim($_POST['komentars']);
    $_POST['autors']=strip_tags($_POST['autors']);
    $_POST['komentars']=strip_tags($_POST['komentars']);
    $_POST['autors']=htmlentities($_POST['autors']);
    $_POST['komentars']=htmlentities($_POST['komentars']);
	$kluda="";
    if(!$_POST['autors']){$kluda.="Pietrūkst informācijas!<br>";}
    if(!$_POST['komentars']){$kluda.="Pietrūkst informācijas!<br>";}
    if(!$kluda)
    { 
		$link = mysql_connect("localhost", "root", "usbw");
        mysql_select_db("viesu_gramata", $link);
        $tabula="viesi";
        $sql="INSERT INTO $tabula (autors, komentars, datums) values ( '".mysql_real_escape_string($_POST['autors'], $link)."', '".mysql_real_escape_string($_POST['komentars'], $link)."', now())";
        mysql_query("SET NAMES utf8 COLLATE utf8_bin", $link);
		mysql_query($sql, $link);
    }
    header("Location: viesuforma2.html");
?>
