<?php
if(!file_exists("page/_system/license.key"))
{
	header("location: page/install/install.php");
}
else {
	header("location: page/index.php");
}
?>