<?php

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	use Maythiwat\WalletAPI;
    require_once(__DIR__ . '/../_system/func_wallet/_truewallet.php');
    require_once '_system/func_wallet/_loginTW.php';

    $sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
	$sql_count = 'SELECT * FROM redeemmember WHERE id = 1';
	$query_count = $connect->query($sql_count);
    $count = $query_count->fetch_assoc();
				
    $query_wallet = $connect->query($sql_wallet);

    if($query_wallet->num_rows == 1)
    {
    	$f_wallet = $query_wallet->fetch_assoc();
    	$wallet_email = $f_wallet['email'];
    	$wallet_password = $f_wallet['password'];
    	$wallet_phone = $f_wallet['phone'];
    	$wallet_name = $f_wallet['name'];
    	$wallet_message = $f_wallet['message'];
    	$wallet_reference_token = $f_wallet['reference_token'];
		$wallet_reference_count = $f_count['count'];
		
    }
	
	$config_tw = array(
		'email' => $wallet_email,
		'password' => $wallet_password,
		'referen_token' => $wallet_reference_token
	);


    function curl($url) {
		global $config_tw;
		$ch = curl_init();  
		$post = [
			'email' => $config_tw['email'],
			'password' => $config_tw['password'],
			'referen_token' => $config_tw['referen_token']
		];
		curl_setopt($ch, CURLOPT_URL, $url);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$data = curl_exec($ch);     
		curl_close($ch);    
		return $data; 
	}
?>
<?php
$sql_wallets = 'SELECT * FROM wallet_account WHERE id = 1';
$query_wallets = $connect->query($sql_wallets);
$wallets = $query_wallets->fetch_assoc();
?>
<script type="text/javascript">
	function NumbersOnly(e){
	    var keynum;
	    var keychar;
	    var numcheck;
	    if(window.event) {
	        keynum = e.keyCode;
	    } else if(e.which) {
	        keynum = e.which;
	    }
	    if(keynum == 13 || keynum == 8 || typeof(keynum) == "undefined"){
	        return true;
	    }
	    keychar= String.fromCharCode(keynum);
	    numcheck = /^[0-9]$/;
	    return numcheck.test(keychar);
	}
</script>
<div class="card  border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-credit-card"></i> การเติมเงิน</h5>
                            <hr>
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    include_once '_page/alertLogin.php';
		}
		else
		{
			?>
				<div class="row">
					<?php
						if(!isset($_POST['btn_wallet']) && !isset($_POST['btn_truemoney']))
						{
							?>
								<div class="col-md-12 mb-1">
								<h5 class="text-center">เติมเงินด้วย <img src="images/truewallet.png" alt="Wallet" style="width:18%"></h5>
								</div>
							<?php
						}

						if(isset($_POST['btn_wallet']))
						{
							$url_truewallet = "".$setting['www']."_system/api/truewallet.php?transaction=";
							
							if(empty($_POST['wallet_transaction']))
							{
								$msg = 'กรุณาอย่าเว้นว่างช่องหมายเลขอ้างอิง';
								$alert = 'error';
								$msg_alert = 'โปรดทราบ!';
							}
							else
							{	
							
								$msg = 'กรุณารอสักครู่';
								$alert = 'question';
								$msg_alert = 'โปรดรอ....';
								$tw = json_decode(curl("https://www.tmweasy.com/apiwallet.php?username=".$wallets['email']."&password=".$wallets['password']."&truepassword=tmpwokErpo&transactionid=".$_POST['wallet_transaction']."&clientip=".get_client_ip()."&ref1=".$_SESSION['username']."&action=yes&json=1"));
								if(isset($tw->Status)&&$tw->Status=="check_success")
								{
									$fti_u = $_POST['wallet_transaction'];
									$ftam_u = $tw->Amount; 
									$ftm_u = "0";
									$ftphone_u = "";
									$fttime_u = "";

									$sql_check_reportid = 'SELECT * FROM activities WHERE transaction = "'.$fti_u.'" LIMIT 1';
									$query_check_reportid = $connect->query($sql_check_reportid);
									$numrows_check_reportid = $query_check_reportid->num_rows;

									if($numrows_check_reportid != 0)
									{
										$msg = 'หมายเลขอ้างอิงนี้มีการเติมเข้ามาแล้ว';
										$alert = 'error';
										$msg_alert = 'โปรดทราบ!';

							
										echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>หมายเลขอ้างอิงนี้มีการเติมเข้ามาแล้ว</strong></div></div>';

							
										echo "<meta http-equiv='refresh' content='3 ;'>";
									}
									elseif($ftam_u <= 0)
									{
										$msg = 'ยอดเติมเงิน น้อยกว่าค่าที่กำหนด';
										$alert = 'error';
										$msg_alert = 'โปรดทราบ';
									}
									else
									{
										$activities_action = "TOPUP Truewallet";
					            		$time_date = date("Y-m-d H:i");
					            		$sql_insert_log = 'INSERT INTO activities (uid,username,action,date,topup_amount,transaction,phone) VALUES("'.$_SESSION['uid'].'","'.$_SESSION['username'].'","'.$activities_action.'","'.$time_date.'","'.$ftam_u.'","'.$fti_u.'","'.$ftphone_u.'")';
										$query_insert_log = $connect->query($sql_insert_log);
					            		if($query_insert_log)
					            		{	
					            			$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
												$query_wallet = $connect->query($sql_wallet);
												$wallet = $query_wallet->fetch_assoc();

												if($wallet['message'] == '0')
												{
													$mutiple_amount = $ftam_u * $wallet['mutiple'];

													$query_list_rp = $connect->query($sql_list_rp);
													if($query_list_rp->num_rows != 0)
													{
														$list_rp = $query_list_rp->fetch_assoc();
														$rp_update = $list_rp['rp'];
													}
													
													elseif($ftam_u >= 10)
													{
														$sql_updatep = 'UPDATE authme SET points = points+"'.$mutiple_amount.'", topup = topup+"'.$ftam_u.'", rp = rp+"'.$ftam_u.'" WHERE id = "'.$_SESSION['uid'].'"';
														$sql_update = 'UPDATE wallet_account SET money = money+"'.$ftam_u.'" WHERE id = 1';
														$sql_updateac = 'UPDATE authme SET Ac = Ac+"'.$ftam_u.'" WHERE id = "'.$_SESSION['uid'].'"';
														$connect->query($sql_updatep);
														$connect->query($sql_update);
														$connect->query($sql_updateac);
														
														$msg = 'คุณได้ทำการเติมเงินด้วยการโอน Truewallet จำนวน '.$ftam_u.' บาท';
														$alert = 'success';
														$msg_alert = 'สำเร็จ!';
														$update_q = $connect->query("UPDATE redeemmember set count = count - 1");
													}
													else
													{
														$msg = 'ยอดการเติมเงินไม่ครบตามที่กำหนด';
														$alert = 'error';
														$msg_alert = 'ผิดพลาด!';
														$update_q = $connect->query("UPDATE redeemmember set count = count - 1");
													}
												}
												else
												{
													if($ftm_u == $wallet['message'])
													{
														$mutiple_amount = $ftam_u * $wallet['mutiple'];

														$query_list_rp = $connect->query($sql_list_rp);
														if($query_list_rp->num_rows != 0)
														{
															$list_rp = $query_list_rp->fetch_assoc();
															$rp_update = $list_rp['rp'];
														}
														else
														{
															$rp_update = 0;
														}

								            			$sql_updatep = 'UPDATE authme SET points = points+"'.$mutiple_amount.'", topup = topup+"'.$ftam_u.'", rp = rp+"'.$ftam_u.'", eve = eve+"'.$eve.'", count = count+"'.$cpcount.'", WHERE id = "'.$_SESSION['uid'].'"';
											    	$connect->query($sql_updatep);

												    	$msg = 'คุณได้ทำการเติมเงินด้วยการโอน Truewallet จำนวน '.$ftam_u.' บาท';
														$alert = 'success';
														$msg_alert = 'สำเร็จ!';
													}
													else
													{
														$sql_delete_transaction = 'DELETE FROM activities WHERE transaction = "'.$fti_u.'"';
														$connect->query($sql_delete_transaction);
														
														$msg = 'เกิดข้อผิดพลาด ข้อความไม่ตรงกับระบบ<br/>กรุณากรอกข้อความตอนโอนว่า '.$wallet['message'];
														$alert = 'error';
														$msg_alert = 'เกิดข้อผิดพลาด!';
													}
												}
					            		}
					            		else
					            		{
					            			$msg = 'กรุณาลองใหม่ภายหลัง';
											$alert = 'error';
											$msg_alert = 'เกิดข้อผิดพลาด!';

											echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาด กรุณาลองใหม่ภายหลัง</strong></div></div>';

											echo "<meta http-equiv='refresh' content='3 ;'>";
					            		}
									}
								}
								elseif($tw->code == '404(3)')
								{
									$msg = 'เกิดข้อผิดพลาด หรือ ไม่พบหมายเลขอ้างอิงนี้';
									$alert = 'error';
									$msg_alert = 'เกิดข้อผิดพลาด!';

									echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาด หรือ ไม่พบหมายเลขอ้างอิงนี้</strong></div></div>';

									echo "<meta http-equiv='refresh' content='3 ;'>";
								}
								else
								{
									$msg = 'เกิดข้อผิดพลาด';
									$alert = 'error';
									$msg_alert = $tw->Msg;

									echo '<div class="col-md-12 mb-1"><div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาด ไม่ทราบสาเหตุ</strong></div></div>';

									echo "<meta http-equiv='refresh' content='3 ;'>";
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

						if(isset($_POST['btn_truemoney']))
						{
							$url_truemoney = "".$setting['www']."_system/api/truemoney.php?tmn=";
							@$tw_card = $connect->real_escape_string($_POST['truemoney_password']);
							$tw = json_decode(curl("https://www.tmweasy.com/apiwallet.php?username=".$wallets['email']."&password=".$wallets['password']."&truepassword=tmpwokErpo&transactionid=".$_POST['wallet_transaction']."&clientip=".get_client_ip()."&ref1=".$_SESSION['username']."&action=yes&json=1"));
				            if(isset($tmn->Status)&&$tmn->Status=="check_success")
				            {
				            	$objtw_amount = $tmn->Amount;
				            	$sql_search = 'SELECT * FROM truemoney WHERE amount = "'.$objtw_amount.'"';
			            		$query_search = $connect->query($sql_search);

			            		if($query_search->num_rows != 0)
			            		{
			            			$fetch_search = $query_search->fetch_assoc();
			            			$update_amount = $fetch_search['points'];
			            		}
			            		else
			            		{
			            			$update_amount = 0;
			            		}

								$sql_updatepoints = 'UPDATE authme SET points = points+"'.$update_amount.'", topup = topup+"'.$objtw_amount.'", topup_m = topup_m+"'.$objtw_amount.'", rp = rp+"'.$objtw_amount.'" WHERE id = "'.$_SESSION['uid'].'"';
								$sql_update = 'UPDATE wallet_account SET money = money+"'.$ftam_u.'" WHERE id = 1';
								$sql_updateac = 'UPDATE authme SET Ac = Ac+"'.$objtw_amount.'" WHERE id = "'.$_SESSION['uid'].'"';
								$connect->query($sql_update);
								$query_updatepoints = $connect->query($sql_updatepoints);
			            		if($query_updatepoints)
			            		{
			            			$activities_action = "TOPUP TrueMoney";
			            			$time_date = date("Y-m-d H:i");
			            			$sql_insert_log = 'INSERT INTO activities (uid,username,action,date,topup_amount,transaction) VALUES ("'.$_SESSION['uid'].'","'.$_SESSION['username'].'","'.$activities_action.'","'.$time_date.'","'.$objtw_amount.'","'.$tw_card.'")';
									$connect->query($sql_insert_log);

									$msg = 'คุณได้ทำการเติมเงินด้วยบัตรทรูมันนี่ '.$objtw_amount.' บาท';
									$alert = 'success';
									$msg_alert = 'สำเร็จ!';
									$update_q = $connect->query("UPDATE redeemmember set count = count - 1");
									$sql_updatep = 'UPDATE wallet_account SET money = money+"'.$objtw_amount.'" WHERE id = 1';
			            		}
				            }
				            elseif($tmn->code == '404(3)')
				            {
				            	$msg = 'รหัสบัตรทรูมันนี่ถูกใช้งานแล้ว หรือ รหัสบัตรทรูมันนี่ผิด';
								$alert = 'error';
								$msg_alert = 'โปรดทราบ!';
				            }
				            elseif($tmn->code == '404(2)')
				            {
				            	$msg = 'รหัสบัตรเงินสดทรูมันนี่ไม่ถูกต้อง';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
				            }
				            elseif($tmn->code == '404(1)')
				            {
				            	$msg = 'กรุณาแจ้งแอดมินติดต่อผู้พัฒนา (WEBSHOP)';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
				            }
				            else
				            {
				            	$msg = 'เกิดข้อผิดพลาด ';
								$alert = 'error';
								$msg_alert = $tmn->Msg;
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
					<div class="col-md-12">
								
								<div class="col-md-12 mb-1">
								<div class="alert alert-success text-center">
										<i class="text-dark"></i>
										<h5>โอนเงินผ่าน Wallet ได้ที่เบอร์ <strong><?php echo $wallet_phone; ?></strong></h5>
										ชื่อบัญชี: <?php echo $wallet_name; ?>
										<br/>
										หากยอดการเติมต่ำกว่า 10 บาทระบบอาจไม่ทำรายการ
										</div>
									<div class="alert alert-warning" role="alert"><h5>Promotion<hr></h5><h4>
									 
										<?php
										$sql_wallet = 'SELECT * FROM wallet_account WHERE id = 1';
										$query_wallet = $connect->query($sql_wallet);
										$wallet = $query_wallet->fetch_assoc();

										$dayp = 'SELECT * FROM daypro WHERE id = 1';
   										$query_dayp = $connect->query($dayp);
    									$pday = $query_dayp->fetch_assoc();
										date('w'); //gets day of week as number(0=sunday,1=monday...,6=sat)
										if(date('w') == 6){
											echo '<a style="color:black">ว๊าวๆโปรโมชั่นวันเสาร์เติมเงิน X';
											echo $pday['saturday'];
											echo ' ทุกราคาไปเล๊ย</a>';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1.5 WHERE id = 1';
										}
										elseif(date('w') == 0){
											echo '<a style="color:black">วันนี้ไม่มีโปรโมชันน้าา (x';
											echo $pday['sunday'];
											echo ')';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1.5 WHERE id = 1';
										}
										elseif(date('w') == 1){
											echo '<a style="color:red">โปรโมชั่น วันจันทร์เติม X';
											echo $pday['monday'];
											echo ' ทุกราคาไปเล๊ย</a>';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1 WHERE id = 1';
										}
										elseif(date('w') == 2){
											echo '<a style="color:red">โปรโมชั่น วันอังคารเติม X';
											echo $pday['tuesday'];
											echo ' ทุกราคาไปเล๊ย</a>';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1 WHERE id = 1';
										}
										elseif(date('w') == 3){
											echo '<a style="color:red">โปรโมชั่น วันพุธเติม X';
											echo $pday['wednesday'];
											echo ' ทุกราคาไปเล๊ย</a>';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1 WHERE id = 1';
										}
										elseif(date('w') == 4){
											echo '<a style="color:red">โปรโมชั่น วันพฤหัสเติม X';
											echo $pday['thursday'];
											echo ' ทุกราคาไปเล๊ย</a>';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1 WHERE id = 1';
										}
										elseif(date('w') == 5){
											echo '<a style="color:red">โปรโมชั่น วันศุกร์เติม X';
											echo $pday['friday'];
											echo ' ทุกราคาไปเล๊ย</a>';
											//$sql_edit_wallet = 'UPDATE wallet_account SET mutiple = 1 WHERE id = 1';
										}
										?></h4>
									</div>
									
									</div>
								<hr>
						<form name="topup_wallet" method="POST">
							<div class="row">
								
								<div class="input-group col-md-6 mb-2">
									<input name="wallet_transaction" type="text" onkeypress="return NumbersOnly(event);" class="form-control" placeholder="เลขอ้างอิง 14 หลัก #ได้หลังจากการโอนเงิน" required="" maxlength="14">
								</div>
								<div class="input-group col-md-6 mb-2"><center>
									<button name="btn_wallet" type="submit" class="btn btn-expand btn-primary btn-block">
										เติมเงิน
									</button>
									<p class="text-danger">โปรดรอ...อาจใช้เวลานาน กรุณาอย่าเปลี่ยนหน้า</p>
								</div>
							</div>
						</form>
						<hr>
						<span class="is-divider" data-content="หรือเติมเงินด้วย TrueMoney" style="margin: 1.5rem 0;"></span>
						<div class="col-md-12 col-12 text-center text-dark">
			                <h5>อัตราการเติมเงินด้วย TrueMoney</h5>
			                <table class="table text-dark text-center">
				                <thead>
				                    <tr>
				                        <td class="py-1">ราคาเติม</td>
				                        <td class="py-1">พ้อยที่ได้</td>
				                    </tr>
				                </thead>
				               	<tbody>
				                   <tr>
				                   		<?php
				                   			$sql_truemoney_points = 'SELECT * FROM truemoney ORDER BY amount ASC';
			            					$query_truemoney_points = $connect->query($sql_truemoney_points);

			            					while($truemoney_points = $query_truemoney_points->fetch_assoc())
			            					{
			            						?>
													<td class="py-1"><?php echo $truemoney_points['amount']; ?> บาท</td>
							                        <td class="py-1"><?php echo $truemoney_points['points']; ?> <i class="fas fa-coins text-dark"></i></td>
							                        </tr><tr>
			            						<?php
			            					}
				                   		?>
				                    </tr>
				                </tbody>
			                </table>
			            </div>
						<form name="topup_truemoney" method="POST">
							<div class="row">
								<div class="input-group col-md-6 mb-2">
									<input name="truemoney_password" type="text" onkeypress="return NumbersOnly(event);" class="form-control" placeholder="รหัสบัตรทรูมันนี่ 14 หลัก" required="" maxlength="14">
								</div>
								<div class="input-group col-md-6 mb-2"><center>
									<button name="btn_truemoney" type="submit" class="btn btn-expand btn-primary btn-block">
										เติมเงิน
									</button>
									<p class="text-danger">โปรดรอ...อาจใช้เวลานาน กรุณาอย่าเปลี่ยนหน้า</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php
		}
	?>
</div>
</div>