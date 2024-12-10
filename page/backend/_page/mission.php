<?php
	$missioncheck = "SELECT * FROM missionrcon WHERE id  = 1";
	$query_mission = $connect->query($missioncheck);
	$missionrcon = $query_mission->fetch_assoc();

	$missionsetcount = "SELECT * FROM missionset WHERE id  = 1";
	$mission_query = $connect->query($missionsetcount);
	$missioncount = $mission_query->fetch_assoc();

	$missionsetcount2 = "SELECT * FROM missionset WHERE id  = 2";
	$mission_query2 = $connect->query($missionsetcount2);
	$missioncount2 = $mission_query2->fetch_assoc();

	if(isset($_POST['rconsubmit']))
	{
		$missionrconupdate = 'UPDATE missionrcon SET ip_server = "'.$_POST['ipserver'].'", port = "'.$_POST['rconport'].'", password = "'.$_POST['rconpassword'].'" WHERE id = 1';
		$checkmissionrcon = $connect->query($missionrconupdate);

		if($checkmissionrcon)
		{
		$msg = 'อัปเดทสำเร็จ';
		$alert = 'success';
		$msg_alert = 'สำเร็จ';
		}
		else
		{
		$msg = 'อัปเดทไม่สำเร็จ';
		$alert = 'error';
		$msg_alert = 'ผิดพลาด';	
		}
?>
<script>swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {button: "Reload",}).then((value) => {window.location.href = window.location.href;});</script> 
<?php 
} 
?>
<div class="row">
				<div class="col-md-12 mb-2">
					<span class="is-divider" data-content="ตั้งค่า Wallet Account" style="margin: 1.5rem 0;"></span>
				</div>
			</div>
			<h4 class="mb-3 text-center">
				จัดการระบบ rcon <small>#Server Mission</small>
			</h4>
			<form name="missionrcon" method="POST">
				<div class="row">
					<div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">IP SERVER</label>
			            <input type="tel" class="form-control" id="ipserver" name="ipserver" required="" value="<?php echo $missionrcon['ip_server']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">RCON PORT</label>
			            <input type="tel" class="form-control" id="rconport" name="rconport" required="" value="<?php echo $missionrcon['port']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">RCON PASSWORD</label>
			            <input type="password" class="form-control" id="rconpassword" name="rconpassword" required="" value="<?php echo $missionrcon['password']; ?>">
			        </div>
			        <div class="col-md-12 mb-3">
			        	<button name="rconsubmit" type="submit" class="btn btn-primary btn-block">
			        		อัปเดท
			        	</button>
			        </div>
			    </div>
			</form>
			<hr>
			<h4 class="mb-3 text-center">
				จัดการ Mission Count <small># Mission set count</small>
			</h4>
			<form name="missionrcon" method="POST">
				<div class="row">
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">Mission 1 หากยอดเติมรวมครบ</label>
						<input type="tel" class="form-control" id="mission1" name="mission1" required="" value="<?php echo $missioncount['count']; ?>">
			        </div>
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">Mission 2 หากยอดเติมรวมครบ</label>
						<input type="tel" class="form-control" id="mission2" name="mission2" required="" value="<?php echo $missioncount2['count']; ?>">
			        </div>
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">อธิบายของรางวัล</label>
						<input type="tel" class="form-control" id="missionmess1" name="missionmess1" required="" value="<?php echo $missioncount['mess']; ?>">
			        </div>
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">อธิบายของรางวัล</label>
						<input type="tel" class="form-control" id="missionmess2" name="missionmess2"  required="" value="<?php echo $missioncount2['mess']; ?>">
			        </div>
					
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">คำสั่ง</label>
						<input type="tel" class="form-control" id="missioncom11" name="missioncom11" required="" value="<?php echo $missioncount['com1']; ?>">
			        </div>

					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">คำสั่ง</label>
						<input type="tel" class="form-control" id="missioncom21" name="missioncom21" required="" value="<?php echo $missioncount2['com1']; ?>">
			        </div>
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">คำสั่ง</label>
						<input type="tel" class="form-control" id="missioncom11" name="missioncom12" required="" value="<?php echo $missioncount['com2']; ?>">
			        </div>

					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">คำสั่ง</label>
						<input type="tel" class="form-control" id="missioncom21" name="missioncom22" required="" value="<?php echo $missioncount2['com2']; ?>">
			        </div>
					<div class="col-md-12 mb-3">
			        	<button name="commandsubmit" type="submit" class="btn btn-primary btn-block">
			        		อัปเดท
			        	</button>
					</div>
					</div>
<?php
if(isset($_POST['commandsubmit']))
{
	$missionrconupdate = 'UPDATE missionset SET  count = "'.$_POST['mission1'].'", mess = "'.$_POST['missionmess1'].'", com1 = "'.$_POST['missioncom11'].'", com2 = "'.$_POST['missioncom12'].'" WHERE id = 1';
	$missionrconupdate2 = 'UPDATE missionset SET count ="'.$_POST['mission2'].'", mess = "'.$_POST['missionmess2'].'", com1 = "'.$_POST['missioncom21'].'", com2 = "'.$_POST['missioncom22'].'" WHERE id = 2';
	$checkmissionrconupdate = $connect->query($missionrconupdate);
	$checkmissionrconupdate = $connect->query($missionrconupdate2);

	if($checkmissionrconupdate)
	{
	$msg = 'อัปเดทสำเร็จ';
	$alert = 'success';
	$msg_alert = 'สำเร็จ';
	}
	else
	{
	$msg = 'อัปเดทไม่สำเร็จ';
	$alert = 'error';
	$msg_alert = 'ผิดพลาด';	
	}
?>
<script>swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {button: "Reload",}).then((value) => {window.location.href = window.location.href;});</script> 
<?php 
} 
?>