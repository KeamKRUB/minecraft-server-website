<?php
$sql_players = 'SELECT * FROM authme WHERE username = "'.$_POST['invite'].'"';
$query_players = $connect->query($sql_players);
$players = $query_players->fetch_assoc();
?>
<div class="card border-0 shadow mb-4">
<h6>
<div class="alert alert-info"></div></h6>
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-user"></i> เชิญเพื่อนรับคะแนน </h5>
                            <hr>
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    include_once '_page/alertLogin.php';
		}
		else
		{
			?>
<form method="post" action="">
	<input type="hidden" name="submitinvite" value="invite">
		<div class="input-group mb-3">
  		<div class="input-group-prepend">
   			<span class="input-group-text lp-title-input"><i class="fa fa-barcode"></i>&nbsp;ระบุผู้เชิญ&nbsp;:&nbsp;</span>
  		</div>
			<input type="text" name="invite" class="form-control form-control-lg lp-input">
		</div>
	<button type="submit" class="btn btn-outline-success btn-block"><i class="fa fa-check"></i>&nbsp;ยืนยัน</button>
</form>
			<?php
		}
	?>
</div></div>
<?php
if(isset($_POST['submitinvite']) == "invite")
{
	if($_SESSION['username'])
	{
		$invite = $_POST['invite'];
		$user = $_SESSION['username'];
		$inviteduser = $connect->query("SELECT username FROM invite WHERE username = ('".$invite."')");
		$inviteduserip = $connect->query("SELECT ip FROM invite WHERE (username,ip) = ('".$invite."','".$players['ip']."')");
		$sqlauthme = "SELECT username FROM authme WHERE username = '".$invite."'";

		$invitedcheck = $inviteduser->num_rows;
		$invitedcheckip = $inviteduserip->num_rows;

		$aauthme = $connect->query($sqlauthme);
		$authme = $aauthme->num_rows;

		if($_POST['invite'] == $user)
			{
				$msg = 'ไม่สามารถเชิญตัวเองได้';
				$alert = 'error';
				$msg_alert = 'ผิดพลาด';
			}
			elseif($invitedcheck > 0)
			{
				$msg = 'ตัวละครนี้ ถูกเชิญแล้ว';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
			elseif($invitedcheckip = 0)
			{
				$msg = 'IP นี้ถูกเชิญแล้ว';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}

			elseif($authme == 1)
			{
				$fiis = "สำเร็จ";

				$insert = $connect->query("INSERT INTO invite (username,ivusername,ip,status) VALUES('".$invite."','".$_SESSION['username']."','".$players['ip']."','".$fiis."')");
				$sql_update = 'UPDATE authme SET eve = eve+20 WHERE username = "'.$_SESSION['username'].'"';
				$sql_updatepoints = 'UPDATE authme SET eve  = eve+15 WHERE username = "'.$invite.'"';
				$query_updatepoints = $connect->query($sql_update);
				$query_updatepoint = $connect->query($sql_updatepoints);

				if($query_updatepoints)
				{
				$msg = 'เชิญสำเร็จ';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
				}
			}
			else
			{
				$msg = 'ไม่พบตัวละครนี้';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
			}
  ?> 
<script>swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {button: "Reload",}).then((value) => {window.location.href = window.location.href;});</script> 
<?php 
	}
} 
?>