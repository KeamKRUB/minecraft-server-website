<?php
		$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
		$query_wallet = $connect->query($sql_wallet);
		$wallet = $query_wallet->fetch_assoc();

		$sql_count = 'SELECT * FROM redeemmember WHERE id = 1';
		$query_count = $connect->query($sql_count);
		$count = $query_count->fetch_assoc();
	
		$dayp = 'SELECT * FROM daypro WHERE id = 1';
   		$query_dayp = $connect->query($dayp);
    	$pday = $query_dayp->fetch_assoc();

		if(isset($_POST['wallet_submit']))
		{
			$sql_edit_wallet = 'UPDATE wallet_account SET email = "'.$_POST['we'].'", password = "'.$_POST['wp'].'", phone = "'.$_POST['wph'].'", name = "'.$_POST['wn'].'" WHERE id = 1';
			$sql_edit_count = 'UPDATE redeemmember SET count = "'.$_POST['wallet_reference'].'" WHERE id = 1';
			$sql_edit_dayp ='UPDATE daypro SET sunday = "'.$_POST['d1'].'", monday = "'.$_POST['d2'].'", tuesday = "'.$_POST['d3'].'", wednesday = "'.$_POST['d4'].'", thursday = "'.$_POST['d5'].'", friday = "'.$_POST['d6'].'", saturday = "'.$_POST['d7'].'" WHERE id = 1';
			$query_edit_wallet = $connect->query($sql_edit_wallet);
			$query_edit_wallet = $connect->query($sql_edit_count);
			$query_edit_wallet = $connect->query($sql_edit_dayp);
			if($query_edit_wallet)
			{
				$msg = 'แก้ไขการตั้งค่า Tmweasy เรียบร้อยแล้ว';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่า Wallet เรียบร้อยแล้ว</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
			}
			else
			{
				$msg = 'แก้ไขการตั้งค่า Wallet ไม่สำเร็จ';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่า Wallet ไม่สำเร็จ</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
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
		
		$now_month = "-".date("m")."-";
		$sql_list_topup_wallet = 'SELECT * FROM activities WHERE action = "TOPUP Truewallet" AND date LIKE "%'.$now_month.'%"';
		$query_list_topup_wallet = $connect->query($sql_list_topup_wallet);
		$sql_list_topup_tmn = 'SELECT * FROM activities WHERE action = "TOPUP TrueMoney" AND date LIKE "%'.$now_month.'%"';
		$query_list_topup_tmn = $connect->query($sql_list_topup_tmn);

		$amount_wallet = 0;
		while($topup_wallet = $query_list_topup_wallet->fetch_assoc())
		{
			$amount_wallet += $topup_wallet['topup_amount'];
		}

		$amount_tmn = 0;
		while($topup_tmn = $query_list_topup_tmn->fetch_assoc())
		{
			$amount_tmn += $topup_tmn['topup_amount'];
		}
		?>
			<div class="row">
				<div class="col-md-12 mb-2">
					<span class="is-divider" data-content="ตั้งค่า Wallet Account" style="margin: 1.5rem 0;"></span>
				</div>
			</div>
			<h4 class="mb-3 text-center">
				จัดการระบบเติมเงิน <small>#Wallet Account</small>
			</h4>
			<form name="topup_settings" method="POST">
				<div class="row">
					<div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">User Tmweasy</label>
			            <input type="tel" class="form-control" id="we" name="we" required="" value="<?php echo $wallet['email']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">Password Tmweasy</label>
			            <input type="password" class="form-control" id="wp" name="wp" required="" value="<?php echo $wallet['password']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="wallet_mutiple">Phone Wallet</label>
			            <input type="tel" class="form-control" id="wph" name="wph" required="" value="<?php echo $wallet['phone']; ?>">
			        </div>
			        <div class="col-md-6 mb-3">
			            <label for="wallet_name">Name Wallet</label>
			            <input type="text" class="form-control" id="wn" name="wn" required="" value="<?php echo $wallet['name']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันอาทิตย์</label>
			            <input type="tel" class="form-control" id="d1" name="d1" required="" value="<?php echo $pday['sunday']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันจันทร์</label>
			            <input type="tel" class="form-control" id="d2" name="d2" required="" value="<?php echo $pday['monday']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันอังคาร</label>
			            <input type="tel" class="form-control" id="d3" name="d3" required="" value="<?php echo $pday['tuesday']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันพุธ</label>
			            <input type="tel" class="form-control" id="d4" name="d4" required="" value="<?php echo $pday['wednesday']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันพฤหัสบดี</label>
			            <input type="tel" class="form-control" id="d5" name="d5" required="" value="<?php echo $pday['thursday']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันศุกร์</label>
			            <input type="tel" class="form-control" id="d6" name="d6" required="" value="<?php echo $pday['friday']; ?>">
					</div>
					<div class="col-md-3 mb-3">
			            <label for="wallet_mutiple">วันเสาร์</label>
			            <input type="tel" class="form-control" id="d7" name="d7" required="" value="<?php echo $pday['saturday']; ?>">
			        </div>
			        <div class="col-md-3 mb-3">
			            <label for="wallet_reference">จำนวนการเติม Wallet</label>
			            <input type="text" class="form-control" id="wallet_reference" name="wallet_reference" required="" value="<?php echo $count['count']; ?>">
					</div>
			        <div class="col-md-12 mb-3">
			        	<button name="wallet_submit" type="submit" class="btn btn-primary btn-block">
			        		แก้ไขการตั้งค่าเติมเงิน
			        	</button>
			        </div>
			    </div>
			</form>
                                <hr>
		<?php
		$sql_truemoney = 'SELECT * FROM truemoney';
		$query_truemoney = $connect->query($sql_truemoney);
		echo '<div class="row">
				<div class="col-md-12 mb-2">
					<span class="is-divider" data-content="ตั้งค่า TrueMoney" style="margin: 1.5rem 0;"></span>
				</div>
			</div>';
		echo '<h4 class="mb-3 text-center">
				ตั้งค่า <small>#TrueMoney</small>
			</h4>';

		if(isset($_POST['truemoney_submit']))
		{
			$sql_edit_truemoney = 'UPDATE truemoney SET points = "'.$_POST['truemoney_points'].'" WHERE amount = "'.$_POST['truemoney_id'].'"';
			$query_edit_truemoney = $connect->query($sql_edit_truemoney);

			if($query_edit_truemoney)
			{
				$msg = 'แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' เสร็จเรียบร้อย';
				$alert = 'success';
				$msg_alert = 'สำเร็จ!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' เสร็จเรียบร้อย</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
			}
			else
			{
				$msg = 'แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' ไม่สำเร็จ';
				$alert = 'error';
				$msg_alert = 'เกิดข้อผิดพลาด!';
				//* ประกาศ
				echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไขการตั้งค่าบัตร '.$_POST['truemoney_id'].' ไม่สำเร็จ</strong></div>';

				//* REFRESH
				echo "<meta http-equiv='refresh' content='5 ;'>";
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
		while($w_truemoney = $query_truemoney->fetch_assoc())
		{
			?>
                                
				<form name="truemoney_settings" method="POST">
					<div class="row">
						<div class="col-md-3 mb-3">
				            <label for="truemoney_id">ราคาบัตร</label>
				            <input type="text" class="form-control" id="truemoney_id" name="truemoney_id" required="" value="<?php echo $w_truemoney['amount']; ?>" readonly="">
				        </div>
				        <div class="col-md-6 mb-3">
				            <label for="truemoney_points">พ้อยท์ที่ได้</label>
				            <input type="text" class="form-control" id="truemoney_points" name="truemoney_points" required="" value="<?php echo $w_truemoney['points']; ?>">
				        </div>
				        <div class="col-md-3 mb-3">
                                            <label for="truemoney_submit"><p></p></label>
				        	<button name="truemoney_submit" type="submit" class="btn btn-primary btn-block">
				        		แก้ไข #<?php echo $w_truemoney['amount']; ?>
				        	</button>
				        </div>
				    </div>
				</form>
			<?php
		}
?>