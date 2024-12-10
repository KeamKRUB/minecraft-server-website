<?php
if(!file_exists("_system/license.key"))
{
	header("location: install/install.php");
}
	require_once("_system/_config.php");
	require_once("_system/_database.php");
	require_once("_system/func_wallet/_time2reset_mtopup.php");

	if(isset($_SESSION['uid']) || isset($_SESSION['username']))
	{
		$sql_player = 'SELECT * FROM authme WHERE id = "'.$_SESSION['uid'].'"';
		$query_player = $connect->query($sql_player);

		if($query_player->num_rows <= 0)
		{
			session_destroy();

				//* REFRESH
			echo "<meta http-equiv='refresh' content='0 ;'>";
		}
		else
		{
			$player = $query_player->fetch_assoc();
		}
	}

	if($time2reset_mtopup <= time())
	{
		file_put_contents('_system/func_wallet/_time2reset_mtopup.php','<?php $time2reset_mtopup = '.strtotime('first day of next month midnight').'; ?>');
		$connect->query("UPDATE authme SET topup_m = 0, topup_w = 0");
		$connect->query("UPDATE wallet_account SET money = 0");
		//* REFRESH
		echo "<meta http-equiv='refresh' content='0 ;'>";
	}
                $sql_setting = 'SELECT * FROM setting';
			$query_setting = $connect->query($sql_setting);
                $setting = $query_setting->fetch_assoc();
                $sql_download = 'SELECT * FROM download';
		$query_download = $connect->query($sql_download);
                $download = $query_download->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">
    <head>
      <meta charset="utf-8">
            <title><?php echo $setting['name_server'];?></title>
            <link href="assets/css/kanit.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/css/style-theme.css">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-6jHF7Z3XI3fF4XZixAuSu0gGKrXwoX/w3uFPxC56OtjChio7wtTGJWRW53Nhx6Ev" crossorigin="anonymous">
			      <link rel="stylesheet" href="assets/fa/css/font-awesome.css?1">
            <link rel="stylesheet" href="assets/css/sweetalert2.min.css" >
            <link rel="stylesheet" href="assets/css/mary.css">
            <link rel="stylesheet" href="assets/css/lt.css">
            <script src="assets/js/sweetalert2.all.min.js"></script>
			      <link rel="icon" href="<?php echo $setting['icon']; ?>">
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
font-size: 17px;
border-bottom: 1px solid white;
text-decoration: none !important;
color: black;
transition-duration: 0.3s;
background: rgba(238,238,238,1)
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
.div-fixed {position: fixed;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
width: 50%;
}
</style>
<script type="text/javascript">
    func();
    var seconds = 5 /*SECONDS, UPDATE INTERVAL*/;
    setInterval(function(){
        func();
    }, seconds * 1000);
    function func(){ 

        var ip = "<?php echo $setting['ip_server']; ?>";
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://eu.mc-api.net/v3/server/info/" + ip, true);
        xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                        data = JSON.parse(xhr.responseText);
                        if (data.status) {
                                document.getElementById("sta").innerHTML="<span id='sta' <span style='color: green;font-size: 18px;'>Online</span>";
                                document.getElementById("bar").innerHTML=data.players.online + "/" + data.players.max;
                                document.getElementById("bar2").innerHTML=data.players.online;
                                document.getElementById("bar").style.width = Math.round(100*(data.players.online/data.players.max)) + "%";
                        } else {
                                document.getElementById("bar").innerHTML="0/0";
                                document.getElementById("sta").innerHTML="<span id='sta' <span style='color: red;font-size: 18px;'>Offline</span>";
                                $online = document.getElementById("bar").innerHTML=data.players.online;
                        }
                }
        }
        xhr.send();
    };
</script>
<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  -webkit-animation-name: fadeIn; /* Fade in the background */
  -webkit-animation-duration: 0.4s;
  animation-name: fadeIn;
  animation-duration: 0.4s
}

/* Modal Content */
.modal-content {
  position: fixed;
  bottom: 0;
  background-color: #fefefe;
  width: 100%;
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 0.4s;
  animation-name: slideIn;
  animation-duration: 0.4s
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

/* Add Animation */
@-webkit-keyframes slideIn {
  from {bottom: -300px; opacity: 0} 
  to {bottom: 0; opacity: 1}
}

@keyframes slideIn {
  from {bottom: -300px; opacity: 0}
  to {bottom: 0; opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 0}
}

@keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 0}
}
</style>

        <div style="width:1200px; max-width:100%; margin:auto; margin-top:40px;">	
		<a style="font-size: 56px;"> </a>
<div id="header" style="margin-bottom:10px;">

<div class="header">
        <div style="text-align:center; margin-top:20px;margin-bottom:30px;">
	<img class="animated infinite pulse" style="width: 25%;" src="<?php echo $setting['icon']; ?>">
            <br>  
            <center>
			<br>
  <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
                  <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fa fa-bars"></i>
                    </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto pt-10 pt-lg-0">
                          <li class="nav-item dropdown"> 

                          <li class="nav-item">
                              <a class="nav-link" href="?page=home"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Home</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หน้าหลัก</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							 <?php
                            $sql_bungeecord = 'SELECT id FROM bungeecord ORDER BY id ASC';
                            $query_bungeecord = $connect->query($sql_bungeecord);
                            $server_bungeecord = $query_bungeecord->fetch_assoc();
							?>
                            <li class="nav-item">
                              <a class="nav-link" href="?page=shop&server=<?php echo $server_bungeecord['id'];?>"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Shop</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ร้านค้า</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                            
                            <li class="nav-item">
                              <a class="nav-link" href="?page=topup"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Topup</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เติมเงิน</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <li class="nav-item">
                              <a class="nav-link" href="?page=gift"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Code</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใส่โค้ด</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                            
                            <li class="nav-item">
                              <a class="nav-link" href="?page=gacha"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Gacha</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สุ่มกาชา</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                            
                            <li class="nav-item">
                              <a class="nav-link" href="?page=invite"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Invite</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชวนเพื่อน</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                            
                            <li class="nav-item">
                              <a class="nav-link" href="?page=mission"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Promotion</span></b>
                                  <br>
                                <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรโมชัน</span>
                                </span><span class="sr-only">(current)</span></a>
	                          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                          <?php if(!$_SESSION['username']){ ?>
                            <li class="nav-item">	
                              <a class="nav-link" href="?page=login"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Login</span></b>
                                 <br>
                              <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เข้าสู่ระบบ</span>
                              </span><span class="sr-only">(current)</span></a>
                            </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php }else{?>
                            <li class="nav-item">	
                              <a class="nav-link" href="?page=logout"></i><span class="pull-right">
                                <span id="xnav-upp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Logout</span></b>
                                 <br>
                              <span id="xnav-btt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ออกจากระบบ</span>
                              </span><span class="sr-only">(current)</span></a>
                            </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php } ?>
                        </ul>
                      </div>
                    <br>
</nav>
</div>

</div>
</div>
     <div class="card card-transparent" style="padding: 20px;color: black; -webkit-box-shadow: 0px 5px 30px -5px #000000;
  -moz-box-shadow: 0px 5px 30px -5px #000000;
    box-shadow: 0px 5px 30px -5px #000000;">



<div class="row col-md-12">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text lp-title-input bg-success btn-line-b text-white">ประกาศ :</span>
      </div>
      <marquee class="form-control form-control-lg lp-input" onmouseout="this.start()" onmouseover="this.stop()"><?php echo $setting['announce']; ?></marquee>
    </div>
  </div>
    <a href="#" class="twitch-widget" id="twitch-widget" target="_blank"></a><br><br>
    <main>*
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                  <?php
                    if(!$_GET){$_GET["page"] = 'home';}
                    if(!$_GET["page"])
                    {
                      $_GET["page"] = "home";
                    }
                     if($_GET["page"] == "home"){
                         include_once __DIR__.'/_page/home.php';
                    }elseif($_GET['page'] == "shop"){
                        include_once __DIR__.'/_page/shop.php';
                    }elseif($_GET['page'] == "download"){
                        include_once __DIR__.'/_page/download.php';
                    }elseif($_GET['page'] == "topup"){
                        include_once __DIR__.'/_page/topup.php';
                    }elseif($_GET['page'] == "log"){
                        include_once __DIR__.'/_page/log.php';
                    }elseif($_GET['page'] == "gift"){
                        include_once __DIR__.'/_page/gift.php';						
                    }elseif($_GET['page'] == "confirm"){
                        include_once __DIR__.'/_page/confirm.php';
                    }elseif($_GET['page'] == "login"){
                        include_once __DIR__.'/_page/login.php';
                    }elseif($_GET['page'] == "register"){
                        include_once __DIR__.'/_page/register.php';
                    }elseif($_GET['page'] == "topuptest"){
                        include_once __DIR__.'/_page/topuptest.php';
                    }elseif($_GET['page'] == "logout"){
                        include_once __DIR__.'/_page/logout.php';
                    }elseif($_GET['page'] == "mission"){
                        include_once __DIR__.'/_page/mission.php';
                    }elseif($_GET['page'] == "invite"){
                        include_once __DIR__.'/_page/invite.php';
                    }elseif($_GET['page'] == "gacha"){
                        include_once __DIR__.'/_page/gacha.php';
                    }elseif($_GET['page'] == "confirmgacha"){
                        include_once __DIR__.'/_page/confirmgacha.php';
                    }elseif($_GET['page'] == "user"){
                        include_once __DIR__.'/_page/user.php';
                    }elseif($_SESSION['uid'] && $player['status'] == "admin" && $_GET['page'] == "admin")
                    {
                        include_once __DIR__.'/admin/index.php';
                    }
                    else
					{
                      echo '<meta http-equiv="refresh" content="2;URL=?page=home">';
                      $msg = 'ไม่พบหน้าที่ต้องการ';
                      $alert = 'error';
                      $msg_alert = 'ผิดพลาด!';
                    ?>
                    </div>
<script>
  swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
		button: "Reload",
		})
</script>               
<script>
	swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
		button: "Reload",
		})
</script> 
<?php
}
?>
</div>
<div class="col-lg-4">
<div class="card border-0 shadow mb-4 d-none d-lg-block">
<div class="card-body">
<?php if($_SESSION['username']){ ?>
<h5 class="m-0"><i class="fa fa-user fa-fw"></i>Profile</h5>
<hr>
<text style="font-size: 16px;"> 
<center>
<img src="https://minotar.net/armor/bust/<?php echo $_SESSION['realname']; ?>/175">
<br>
</center>
<hr>
         <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-success btn-line-b text-white"><i class="fa fa-user"></i>&nbsp;ชื่อผู้ใช้</span>
  </div>
<input class="form-control form-control-lg lp-input mypointlive" value="<?php echo $_SESSION['realname']; ?>" disabled/>
</div>
       
<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-dark btn-line-b text-white"><i class="fa fa-credit-card"></i>&nbsp;Point</span>
  </div>
<input class="form-control form-control-lg lp-input" value="<?php echo number_format($player['points']); ?>.00" disabled/>
</div>
<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-dark btn-line-b text-white"><i class="fa fa-credit-card"></i>&nbsp;RealPoint</span>
  </div>
<input class="form-control form-control-lg lp-input" value="<?php echo number_format($player['rp']); ?>.00" disabled/>
</div>
<div class="input-group mb-3" style="margin-top: -10px;">
  <div class="input-group-prepend">
    <span class="input-group-text lp-title-input bg-dark btn-line-b text-white"><i class="fa fa-credit-card"></i>&nbsp;EventPoint</span>
  </div>
<input class="form-control form-control-lg lp-input" value="<?php echo number_format($player['eve']); ?>.00" disabled/>
</div>


            </text>
            <hr class="is-divider" data-content="หรือส่งให้เพื่อน" style="margin: 1.5rem 0;">
<div class="d-flex flex-column" style="width: 100%">
<a class="lp-menu" href="?page=user"><i class="fa fa-user"></i>&nbsp;ข้อมูลส่วนตัว</a>
<a class="lp-menu" href="?page=logout"><i class="fa fa-sign-out"></i>&nbsp;ออกจากระบบ</a>
</div><hr>
<?php }else{ ?>
<div class="card-header slash bg-success" style="color: white; font-size:20px;"><center><b>Login เข้าสู่ระบบ</b><center></div>
<hr>
<form method="post" action="">
	<input type="hidden" name="login_submit">
	<div class="form-group">
	<input type="text"  name="username" class="form-control" placeholder="ชื่อตัวละคร : ">
	</div>
	<div class="form-group">
	<input type="password"  name="password" class="form-control" placeholder="รหัสผ่าน : ">
	</div>
	<button type="submit" class="btn btn-block btn-outline-success mb-3"><i class="fa fa-sign-in fa-fw"></i> เข้าสู่ระบบ</button>
</form>
<?php } ?>
</div>
</div>
<?php
	require __DIR__ . '/_system/status/_MinecraftQuery.php';
	require __DIR__ . '/_system/status/_MinecraftQueryException.php';
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;
	
	$MCQuery = new MinecraftQuery();
?>
 <div class="card border-0 shadow mb-4">
<div class="card-body">
<div class="card-header bg-secondary" style="color: white;"><i class="fa fa-exchange"></i>&nbsp;สถานะเซิฟเวอร์
</div>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-server"></i>&nbsp;IP Server : <?php echo $setting['ip_server']; ?></span><br>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-power-off"></i>&nbsp;สถานะเซิฟ :</span> <span id="sta"></span><br>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-tag"></i>&nbsp;เวอร์ชั่น : <?php echo $setting['version_server']; ?></span><br>
  <span id="hover" style="font-size:15px;"><i class="fa fa-fw fa-users"></i>&nbsp;ผู้เล่นออนไลน์ : <span id="bar">คน</span></span>
</div>
</div>
<div class="card border-0 shadow mb-4">
<div class="card-body">
<div class="card-header bg-dark" style="color: white;"><i class="fa fa-list"></i>&nbsp;Storyworld Fanpage
</div>

<?php
$sql_list = 'SELECT * FROM authme ORDER BY topup DESC LIMIT 5';
$query_list = $connect->query($sql_list);

$sql_last = 'SELECT * FROM activities WHERE (action = "TOPUP Truewallet" || action = "TOPUP TrueMoney") ORDER BY id DESC';
$query_last = $connect->query($sql_last);
?>
<table class="table table-striped ranking_tb" border="0" style="font-size:13px;">
  <thead>
    <tr>
	<th><iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fpermalink.php%3Fstory_fbid%3Dpfbid02XKk3hfYiDTT6X8v7noxeSBMTGQegKQA9pYeuSbWu65pmqHAZyPeE1xCYknnJ6A2Vl%26id%3D2329802287081311&show_text=true&width=500" width="315" height="506" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
    </th></tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>
</div>
  </tbody>
</table>
</div>
</div>

 </tbody>
</table>
</div>
</div>
 </div>
</div>	
 
 <div style="background-color: #2f3133!important;padding:8px;color: white; text-align:center;margin-top: 40px;">
    <small style="font-size:14px;">Design &amp; System By <a href="https://www.facebook.com/profile.php?id=100005002366932" style="color:#FFF;text-decoration:underline;">Pawat Chaijaroen </a></small>
</div>
</body>

 <?php
	if(isset($_POST['login_submit']))
	{
		$msg = '';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';
		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$stmt = $connect->prepare('SELECT * FROM authme WHERE username = ?');
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$password_hash = password_hash($password, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
		if($result->num_rows == 1)
		{
			$password_info = $result->fetch_assoc();
			if(password_verify($password, $password_info['password'])) {
				$query_user = $connect->query("SELECT * FROM authme WHERE username = '$username'");
				$fetch_user = $query_user->fetch_assoc();
				//* SET SESSION
				$_SESSION['uid'] = $fetch_user['id'];
				$_SESSION['username'] = $fetch_user['username'];
				$_SESSION['realname'] = $fetch_user['username'];
				
				$msg = 'ยินดีต้อนรับคุณ: '.$_SESSION['username'];
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
				}
			else
			{
				$msg = 'รหัสผ่านไม่ถูกต้อง';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
		}
		else
		{
			$msg = 'ไม่พบตัวละครนี้';
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
	if(isset($_POST['register_submit']))
	{
		$msg = '';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';
		$reg_username = mysqli_real_escape_string($connect, $_POST['username']);
		$reg_password = mysqli_real_escape_string($connect, $_POST['password']);
		$reg_conpassword = mysqli_real_escape_string($connect, $_POST['con_password']);

		$sql = 'SELECT * FROM authme WHERE username = "'.$reg_username.'"';
		$result = $connect->query($sql);
		
		$password_hash = password_hash($reg_password, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
		$reg_conpassword_hash = password_hash($con_password, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
		if($result->num_rows == 1)
			{
				$msg = 'ชื่อนี้มีผู้ใช้งานแล้ว';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
		else
		{
				$insert="insert into authme (username,password) values('$reg_username','$password_hash')";
				mysqli_query($connect,$insert);
				$sql_user = 'SELECT * FROM authme WHERE username = "'.$reg_username.'"';
				$query_user = $connect->query($sql_user);
				$fetch_user = $query_user->fetch_assoc();
				//* SET SESSION
				$_SESSION['uid'] = $fetch_user['id'];
				$_SESSION['username'] = $fetch_user['username'];
				$_SESSION['realname'] = $fetch_user['username'];
				
				$msg = 'สมัครสมาชิกเสร็จสิ้น: '.$_SESSION['username'];
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
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
if(isset($_POST['submit']) == "redeem")
{
  if($_SESSION['username']){
  $code = $_POST['redeem_code'];

  $redeem_q = $connect->query("SELECT * FROM redeem WHERE code = '".$code."'");
  $redeem = $redeem_q->fetch_assoc();

  $checkip = $connect->query("SELECT id FROM redeemm WHERE (code,ip)=('".$code."','".$_SERVER['REMOTE_ADDR']."')");
  $checkus = $connect->query("SELECT id FROM redeemm WHERE (code,username)=('".$code."','".$_SESSION['username']."')");
  $numrowip = $checkip->num_rows;
  $numrowus = $checkus->num_rows;
  if($numrowus > 0)
	{
		$msg = 'USER นี้ได้ใช้งานโค๊ดแล้ว';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';
	}
	elseif($numrowip > 0)
	{
		$msg = 'IP นี้ได้ใช้งานโค๊ดแล้ว';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';
	}
    else
    {
      if($redeem_q->num_rows != 0)
		{
			$update_q = $connect->query("UPDATE authme set points = points + '".$redeem['cmd']."' WHERE username = '".$_SESSION['username']."'");
			$update_q = $connect->query("UPDATE authme set rp = rp + '".$redeem['cmd1']."' WHERE username = '".$_SESSION['username']."'");
			$update_q = $connect->query("UPDATE authme set eve = eve + '".$redeem['cmd2']."' WHERE username = '".$_SESSION['username']."'");
			$update_q = $connect->query("UPDATE redeem set counts = counts - 1 WHERE code = '".$code."'");
      $insert = $connect->query("INSERT INTO redeemm (ip,username,code) VALUES('".$_SERVER['REMOTE_ADDR']."','".$_SESSION['username']."','".$code."')");

		  	$msg = "คุณได้รับสินค้าแล้ว";
			  $alert = 'success';
       $msg_alert = 'สำเร็จ!';

      $sql_redeem = "SELECT counts FROM redeem WHERE code = '".$code."'";
			$query_redeem = $connect->query($sql_redeem);
			$count = $query_redeem->fetch_assoc();
			if($count['counts'] == 0)
      {
				$sql_delete = $connect->query("DELETE FROM redeem WHERE code = '".$code."'");
				$sql_delete = $connect->query("DELETE FROM redeemm WHERE code = '".$code."'");
			}
			else
		  {
				$update_q = $connect->query("UPDATE redeem set counts = counts + 0 WHERE code = '".$code."'");
			}
		}
		else
		{
			$msg = 'ไม่มีโค๊ดที่ท่านเลือก';
			$alert = 'error';
			$msg_alert = 'ผิดพลาด!';
		}
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
}
?>
<?php
		$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
		$query_wallet = $connect->query($sql_wallet);
    $wallet = $query_wallet->fetch_assoc();

    $dayp = 'SELECT * FROM daypro WHERE id = 1';
    $query_dayp = $connect->query($dayp);
    $pday = $query_dayp->fetch_assoc();

		date('w'); 
		if(date('w') == 6){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['saturday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
		}
		elseif(date('w') == 0){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['sunday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
    }
    elseif(date('w') == 1){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['monday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
    }
    elseif(date('w') == 2){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['tuesday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
    }
    elseif(date('w') == 3){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['wednesday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
		}
    elseif(date('w') == 4){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['thursday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
		}
    elseif(date('w') == 5){
			$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = "'.$pday['friday'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
		}

?>

<?php
if(isset($_POST['submitmis']) == "miss1")
{
	if($_SESSION['username'])
	{
    $missionsetcount = "SELECT * FROM missionset WHERE id  = 1";
	  $mission_query = $connect->query($missionsetcount);
	  $missioncount = $mission_query->fetch_assoc();

	  $missionsetcount2 = "SELECT * FROM missionset WHERE id  = 2";
	  $mission_query2 = $connect->query($missionsetcount2);
    $missioncount2 = $mission_query2->fetch_assoc();
    

		$miss1 = 'miss1';
		$misscheckip = $connect->query("SELECT id FROM mission WHERE (mission,ip)=('".$miss1."','".$_SERVER['REMOTE_ADDR']."')");
		$misscheckus = $connect->query("SELECT id FROM mission WHERE (mission,username)=('".$miss1."','".$_SESSION['username']."')");
		$missip = $misscheckip->num_rows;
    $missus = $misscheckus->num_rows;
		if($missus > 0)
		{
			$msg = 'USER รับของไปแล้ว';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
		}
		elseif($missip > 0)
		{
			$msg = 'IP รับของไปแล้ว';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
    }
    else
    {
      $rconselect = "SELECT * FROM missionrcon WHERE id = 1";
      $query_rcon = $connect->query($rconselect);
      $rcpncount = $query_rcon->fetch_assoc();
  
      $rcon_ip = $rcpncount['ip_server'];
      $rcon_port = $rcpncount['port'];
      $rcon_password = $rcpncount['password'];
      
      require_once('_system/Rcon/_rcon.php');
      $rcon = new Rcon($rcon_ip, $rcon_port, $rcon_password, '3');
      
      if($rcon->connect())
      {
        $sql_rem_points = 'UPDATE authme SET points = points-0 WHERE id = "'.$_SESSION['uid'].'"';
        $query_rem_points = $connect->query($sql_rem_points);
        if($query_rem_points)
				{
          $connect->query($sql_insert_log);
          $rcon->sendCommand("tell ".$_SESSION['username']." คุณได้รับของแล้ว");
          $command = str_replace("<player>", $player['username'], $missioncount['com1']);
          $commanda = str_replace("<player>", $player['username'], $missioncount['com2']);
          $misscheckip = $connect->query("INSERT INTO mission (mission,ip,username) VALUES ('".$miss1."','".$_SERVER['REMOTE_ADDR']."','".$_SESSION['username']."')");
          $exp = explode('<and>',$command);
          $expa = explode('<and>',$commanda);

          foreach($exp as &$val)
          {
              $rcon->sendCommand($val);
          }
          foreach($expa as &$val)
          {
              $rcon->sendCommand($val);
          }
          $msg = 'ได้รับของแล้ว';
			    $alert = 'success';
          $msg_alert = 'สำเร็จ!';
        }
        else
        {
          $msg = 'เกิดข้อผิดพลาด #ไม่สามารถอัพเดทข้อมูลได้ !';
          $alert = 'error';
          $msg_alert = 'เกิดข้อผิดพลาด!';
        }
      }
      else
      {
        $msg = 'ผิดพลาดโปรดแจ้งผู้ดูแล';
        $alert = 'warning';
        $msg_alert = 'ผิดพลาด!'; 
      }
    }
  ?> 
<script>swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {button: "Reload",}).then((value) => {window.location.href = window.location.href;});</script> 
<?php 
	}
} 
?>

<?php
if(isset($_POST['submitmis2']) == "miss2")
{
	if($_SESSION['username'])
	{
		$miss2 = 'miss2';
		$miss2checkip = $connect->query("SELECT id FROM mission WHERE (mission,ip)=('".$miss2."','".$_SERVER['REMOTE_ADDR']."')");
		$miss2checkus = $connect->query("SELECT id FROM mission WHERE (mission,username)=('".$miss2."','".$_SESSION['username']."')");
		$miss2ip = $miss2checkip->num_rows;
    $miss2us = $miss2checkus->num_rows;
		if($miss2us > 0)
		{
			$msg = 'USER รับของไปแล้ว';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
		}
		elseif($miss2ip > 0)
		{
			$msg = 'IP รับของไปแล้ว';
			$alert = 'error';
			$msg_alert = 'เกิดข้อผิดพลาด!';
    }
    else
    {
      $rconselect = "SELECT * FROM missionrcon WHERE id = 1";
      $query_rcon = $connect->query($rconselect);
      $rcpncount = $query_rcon->fetch_assoc();
  
      $rcon_ip = $rcpncount['ip_server'];
      $rcon_port = $rcpncount['port'];
      $rcon_password = $rcpncount['password'];
      
      require_once('_system/Rcon/_rcon.php');
      $rcon = new Rcon($rcon_ip, $rcon_port, $rcon_password, '3');
      
      
      if($rcon->connect())
      {
        $sql_rem_points = 'UPDATE authme SET points = points-0 WHERE id = "'.$_SESSION['uid'].'"';
        $query_rem_points = $connect->query($sql_rem_points);
        if($query_rem_points)
				{
          $connect->query($sql_insert_log);
          $rcon->sendCommand("tell ".$_SESSION['username']." คุณได้รับของแล้ว");
          $command = str_replace("<player>", $player['username'], $missioncount2['com1']);
          $commanda = str_replace("<player>", $player['username'], $missioncount2['com2']);
          $misscheckip = $connect->query("INSERT INTO mission (mission,ip,username) VALUES ('".$miss2."','".$_SERVER['REMOTE_ADDR']."','".$_SESSION['username']."')");
          $exp = explode('<and>',$command);
          $expa = explode('<and>',$commanda);

          foreach($exp as &$val)
          {
              $rcon->sendCommand($val);
          }
          foreach($expa as &$val)
          {
              $rcon->sendCommand($val);
          }
          $msg = 'ได้รับของแล้ว';
			    $alert = 'success';
          $msg_alert = 'สำเร็จ!';
        }
        else
        {
          $msg = 'เกิดข้อผิดพลาด #ไม่สามารถอัพเดทข้อมูลได้ !';
          $alert = 'error';
          $msg_alert = 'เกิดข้อผิดพลาด!';
        }
      }
      else
      {
        $msg = 'ผิดพลาดโปรดแจ้งผู้ดูแล';
        $alert = 'warning';
        $msg_alert = 'ผิดพลาด!'; 
      }
    }
  ?> 
<script>swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {button: "Reload",}).then((value) => {window.location.href = window.location.href;});</script> 
<?php 
	}
} 
?>