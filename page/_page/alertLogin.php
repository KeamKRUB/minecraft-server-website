<?php
	if(isset($_POST['login_submit']))
	{
		$msg = '';
		$alert = 'error';
		$msg_alert = 'เกิดข้อผิดพลาด!';

		$username = $connect->real_escape_string($_POST['username']);
		$sql = 'SELECT * FROM authme WHERE username = "'.$username.'"';
		$a = $connect->query($sql);
		$a_num = $a->num_rows;
		if($a_num == 1)
		{
			$password_info = $a->fetch_assoc();
			$sha_info = explode("$",$password_info['password']);
			$salt = $sha_info[2];
			$sha256_password = hash('sha256', $_POST['password']);
			$sha256_password .= $sha_info[2];

			if(strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password)) == 0){
				$sql_user = 'SELECT * FROM authme WHERE username = "'.$username.'"';
				$query_user = $connect->query($sql_user);
				$fetch_user = $query_user->fetch_assoc();

				$_SESSION['uid'] = $fetch_user['id'];
				$_SESSION['username'] = $fetch_user['username'];
				$_SESSION['realname'] = $fetch_user['realname'];


				$msg = 'ยินดีต้อนรับคุณ: '.$_SESSION['realname'];
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
	else
	{
		?>
			<div class="alert alert-danger">
				<i class="fa fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนทำรายการ !
			</div>
		<?php
	}
?>

	<br>
	<?php
		if(isset($_POST['login_submit']))
		{
			?>
				<button class="btn btn-primary btn-block" type="button" disabled>
				  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				  Loading...
				</button>
			<?php
		}
	?>