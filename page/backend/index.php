<?php
if(!file_exists("../_system/license.key"))
{
	header("location: install/install.php");
}

	require_once("../_system/_config.php");
    require_once("../_system/_database.php");
    $sql_setting = 'SELECT * FROM setting';
	$query_setting = $connect->query($sql_setting);
	$setting = $query_setting->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">
    <head>
            <meta charset="utf-8">
            <title><?php echo $setting['name_server'];?></title>
            <link href="../assets/css/kanit.css" rel="stylesheet">
            <link rel="stylesheet" href="../assets/css/style-theme.css">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous">
            <link rel="stylesheet" href="../assets/fa/css/font-awesome.css">
            <link rel="stylesheet" href="../assets/css/sweetalert2.min.css" >
            <link rel="stylesheet" href="../assets/css/mary.css">
            <link rel="stylesheet" href="../assets/css/lt.css">
            <script src="../assets/js/sweetalert2.all.min.js"></script>
            <link rel="icon" href="<?php echo $setting['icon'];?>" sizes="16x16">
            <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta>
    </head>
<style type="text/css">
body,td,th {
font-family: 'Kanit', sans-serif;
font-size: 15px;
}
body
{
  background: url(<?php echo $setting['bg'];?>) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.lp-panel {
color: black;
font-size: 18px;
background: rgba(255,255,255.1);
padding: 20px;
}
.lp-menu {
padding: 11px;
border-bottom: 1px solid grey;
font-size: 17px;
text-decoration: none !important;
color: white;
transition-duration: 0.3s;
background: rgb(51,51,51)
}
.lp-logout {
padding: 11px;
font-size: 17px;
border-bottom: 1px solid white;
text-decoration: none !important;
color: black;
transition-duration: 0.3s;
background: rgb(251,66,66)
}
.lp-menu:hover {
border-left: 6.5px solid transparent;
color: black;
background: rgba(223,223,223,1)
}
.lp-title-input {
color: white;
background: rgba(0,0,0,0.5);
border: 0px;
border-radius: 0px;
}
.lp-input {
font-size:16px;
background: rgba(255,255,255,1);
border-radius: 0px;
color: black;
}
.lp-input:disabled {
background: rgba(0,0,0,0.1);
}
.modal-content
 {
 border-radius: 0px;
 border: solid 1px white;
     padding:9px 15px;
     background-color: rgba(255,255,255,1);
 }
 .lp-card {
color: black;
background: rgba(255,255,255.1);
}
</style>
<?php 

$authmeselect = 'SELECT * from authme where username = "'.$_SESSION['username'].'"';
$slqcheck = $connect ->query($authmeselect);
$admincheck = $slqcheck ->fetch_assoc();

?>

<body>
<?php 
if(!$_SESSION['username'])
{ 
    $alert = 'info';
    $msg_alert = 'โปรดเข้าสู่ระบบ!';

    echo '<meta http-equiv="refresh" content="2;URL=../?page=login">';
?>
<script>
  swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>")
</script> 
<?php 
}
else
{
 ?>
 <?php
if($admincheck['status'] == "admin")
    {
?>
<body style="color:#0099CC;">
    <div class="container">
        <br><br>
        <?php if(!isset($_SESSION['admin']) || $_SESSION['admin'] == NULL || $_SESSION['admin'] == "" || $_SESSION['admin'] != $setting['backend_password'])
			{
        if(isset($_POST['login_submit_backend']))
	{
		$password_backend = $connect->real_escape_string($_POST['password_backend']);
		if($password_backend == $setting['backend_password'])
		{
			$_SESSION['admin'] = $password_backend;

			$msg = 'เข้าสู่ระบบหลังบ้านเรียบร้อยแล้ว !';
			$alert = 'success';
			$msg_alert = 'สำเร็จ!';
		}
		else
		{
			$msg = 'ERROR!';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
		}

		?>
			<script>
				swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
					button: "Reload",
				})
				.then((value) => {
					window.location.href = window.location.href;
				});
			</script>
		<?php
	}
        ?>
<div class="row">
<div class="col-sm-2"></div>
<div class="col-sm-8">
<div class="card">
<div class="card-body">
    <h5><i class="fa fa-cogs"></i>&nbsp;<?php if($menu == 'download'){echo'จัดการ Download';}elseif($menu == 'manageuser'){echo'จัดการชื่อผู้ใช้';}elseif($menu == 'historytopup'){echo'รายการเติมเงิน';}elseif($menu == 'manageproduct'){echo'จัดการสินค้า';}elseif($menu == 'managecategory'){echo'จัดการหมวดหมู่';}elseif($menu == 'managetopup'){echo'ระบบเติมเงิน';}elseif($menu == 'slide'){echo'จัดการ Video YT';}elseif($menu == 'bungeecord'){echo'จัดการ Server';}elseif($menu == 'manageannounce'){echo'จัดการการประกาศ';}elseif($menu == 'settings'){echo'ตั้งค่า WebShop';}else{echo 'หน้า Backend';} ?> 
    </h5><hr>
<form name="login" method="POST">
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text">
				<i class="fa fa-lock"></i>
			</span>
		</div>
		<input name="password_backend" class="form-control" type="password" placeholder="รหัสผ่านเข้าสู่ระบบหลังบ้าน #Backend"/>
	</div>
	<hr/>
	<?php
		if(isset($_POST['login_submit_backend']))
		{
			?>
				<button class="btn btn-primary btn-block" type="button" disabled>
				  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				  Loading...
				</button>
			<?php
		}
		else
		{
			?>
				<input name="login_submit_backend" class="btn btn-primary btn-block" type="submit" value="เข้าสู่ระบบ.."/>
			<?php
		}
	?>
</form>
                       
</div>
</div>
    </div>
</div>
         <?php }else{ ?>
                        <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                    <div class="col-sm-4">
                    </div>
                        <div class="col-sm-4">
                    </div>
                        <div class="col-sm-4">
                    </div>
                </div>
                    <br>
                    <div class="navbar navbar-dark bg-dark">
                        <div class="card-body" >
						<div class="border-bottom">
                            <h5><div class="border-bottom"><p style="color: white"><b>Backend Setting</b><?php echo($menu) ?>
                            </h5><hr>
                                <?php
                                    if(isset($_GET['menu']) && $_GET['menu'] != NULL && $_GET['menu'] != "")
				{
					$menu = $_GET['menu'];
					if($menu == 'manageuser')
					{
						include_once '_page/manageuser.php';
					}
					elseif($menu == 'historytopup')
					{
						include_once '_page/list_topup.php';
					}
					elseif($menu == 'admin')
					{
						include_once '_page/admin.php';
					}
					elseif($menu == 'manageproduct')
					{
						include_once '_page/product.php';
					}
					elseif($menu == 'managecategory')
					{
						include_once '_page/managecategory.php';
					}
					elseif($menu == 'managetopup')
					{
						include_once '_page/ads.php';
					}
					elseif($menu == 'slide')
					{
						include_once '_page/slide.php';
					}	
					elseif($menu == 'discord')
					{
						include_once '_page/discord.php';						
					}
					elseif($menu == 'announce')
					{
						include_once '_page/announce.php';						
					}					
					elseif($menu == 'bungeecord')
					{
						include_once '_page/bungeecord.php';
					}
					elseif($menu == 'manageannounce')
					{
						include_once '_page/manageannounce.php';
					}
                    elseif($menu == 'settings')
					{
						include_once '_page/settings.php';
					}
                    elseif($menu == 'redeem')
					{
						include_once '_page/redeem.php';
                    }
                    elseif($menu == 'boxrandom')
					{
						include_once '_page/boxrandom.php';
                    }
                    elseif($menu == 'random')
					{
						include_once '_page/random.php';
					}
                    elseif($menu == 'update')
					{
						include_once '_page/update.php';
					}
                    elseif($menu == 'mission')
					{
						include_once '_page/mission.php';
					}
                    elseif($menu == 'logout')
					{
						include_once '_page/logout.php';
					}
                                        else
					{
                                            echo "<h5 class='mb-2 text-center'><div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> ไม่พบเมนูนี้</div></h5>";
					}
				}
				else
				{
				  ?>
				  <tr>
					  <center><img src="https://imgur.com/ZItN4Wk.png" class="mr-3" width="50%"></center>
					  <br>
					  <div class="alert alert-success" style="font-size: 26px"><center>ยินดีต้อนรับสู่ระบบหลังร้าน Mc-Storyworld</center></div>
				  </tr>
				  <?php
				}
                                  ?>
                        </div>
                    </div>
                </div>
				</div>
                <div class="col-lg-4">
                    <div class="navbar navbar-dark bg-dark" class="card border-0 shadow mb-4 d-none d-lg-block-primary">
                            <div class="card-body">
                                <h5><div class="border-bottom"><p style="color: white;">Backend - หลังร้าน</p>
                            </h5><hr>
                                <div class="d-flex flex-column" style="width: 100%">
                                <a class="lp-menu" href="?page=backend&menu=manageuser">&nbsp;จัดการสมาชิก</a>
								<a class="lp-menu" href="?page=backend&menu=admin">&nbsp;จัดการทีมงาน</a>
								<a class="lp-menu" href="?page=backend&menu=bungeecord">&nbsp;จัดการเซิฟเวอร์</a>
								<a class="lp-menu" href="?page=backend&menu=settings">&nbsp;ตั้งค่าเว็บไซต์</a>
								<br>
								<a class="lp-menu" href="?page=backend&menu=historytopup">&nbsp;รายการเติมเงิน</a>
                                <a class="lp-menu" href="?page=backend&menu=managetopup">&nbsp;ระบบเติมเงิน</a>
								<a class="lp-menu" href="?page=backend&menu=manageproduct">&nbsp;จัดการสินค้า</a>
								<a class="lp-menu" href="?page=backend&menu=manageproduct&action=add">&nbsp;เพิ่มสินค้า</a>
								<a class="lp-menu" href="?page=backend&menu=boxrandom">&nbsp;จัดการGacha</a>
                                <br>
								<a class="lp-menu" href="?page=backend&menu=discord">&nbsp;จัดการ Discord</a>
								<a class="lp-menu" href="?page=backend&menu=announce">&nbsp;จัดการ Promotion</a>
                                <a class="lp-menu" href="?page=backend&menu=managecategory">&nbsp;จัดการ Rank</a><br>
                                <a class="lp-menu" href="?page=backend&menu=mission"></i>&nbsp;เพิ่ม Promotion</a>
                                <a class="lp-menu" href="?page=backend&menu=redeem">&nbsp;เพิ่ม Code</a>
                                <a class="lp-menu" href="?page=backend&menu=bungeecord">&nbsp;เพิ่ม Server</a>
                                <br>
                               
                                
                                <a class="lp-logout" href="?page=backend&menu=logout">&nbsp;ออกจากระบบ</a>
                                </div>
                                </div>
                </div>
                </div>
            </div>
        </div>
    </main>
                        
                        <?php  } ?>
    </div>
<script id="dsq-count-scr" src="//startbootstrap.disqus.com/count.js" async type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script type="1bd4d45c54bc5ac897fcf366-text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script type="1bd4d45c54bc5ac897fcf366-text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<script src="../assets/js/scripts.js" type="1bd4d45c54bc5ac897fcf366-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="1bd4d45c54bc5ac897fcf366-|49" defer=""></script></body>
</html>
<?php 
    }
else
    {
        $alert = 'info';
        $msg_alert = 'สิทธิ์ของคุณไม่เพียงพอ!';
        echo '<meta http-equiv="refresh" content="2;URL=../?page=home">';
?>  
<script>
  swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>")
</script> 
<?php }} ?>