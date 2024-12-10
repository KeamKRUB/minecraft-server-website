<?php
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$sql_buy = 'SELECT * FROM boxrandom WHERE id = "'.$_GET['id'].'"';
	}
	else
	{
		$sql_buy = 'SELECT * FROM boxrandom WHERE id = "0"';
	}

	$query_buy = $connect->query($sql_buy);
?>
    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-shopping-cart"></i> ยืนยันการซื้อ</h5>
                            <hr>
	<?php
		if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
		{
                    echo '<div class="col-md-12 mb-1">
                            <div class="alert alert-danger">
				<i class="fa fa-exclamation-triangle"></i> กรุณาเข้าสู่ระบบก่อนซื้อสินค้า !
			</div>
                    </div>';
		}
		else
		{
			?>
				<div class="row">
					<?php
						if($query_buy->num_rows <= 0)
						{
							?>
								<div class="col-md-12">
                                    <h5 class="col-md-12 text-center"><div class="alert alert-danger">ไม่พบสินค้านี้</div></h5>
								</div>
							<?php
						}
						else
						{
							$buy = $query_buy->fetch_assoc();
							$sql_category = 'SELECT * FROM category WHERE id = "'.$buy['category'].'"';
							$query_category = $connect->query($sql_category);
							$category_f = $query_category->fetch_assoc();

							// START BUY
							if(isset($_POST['btn_buy']))
							{
								$msg = '';
								$alert = 'error';
								$msg_alert = 'เกิดข้อผิดพลาด!';
								?>
									<div class="col-md-12 mb-3">
										<?php
											if($player['count'] < $buy['price'])
											{
												$msg = 'CountPoint คุณไม่เพียงพอ!';
												$alert = 'error';
												$msg_alert = 'เกิดข้อผิดพลาด!';
										?>
											<script>
											swal("<?php echo $msg_alert; ?>", "<?php echo $msg; ?>", "<?php echo $alert; ?>", {
											button: "Reload",
											})
											</script>
										<?php
											}
											else
											{
												$sql_rem_count = 'UPDATE authme SET count = count-"'.$buy['price'].'" WHERE id = "'.$_SESSION['uid'].'"';
												$query_rem_count = $connect->query($sql_rem_count);

												$sql_buy_it1 = "it1";
												$sql_buy_it2 = "it2";
												$sql_buy_it3 = "it3";
												$sql_buy_it4 = "it4";
												$sql_buy_it5 = "it5";
												$sql_buy_it6 = "it6";

												$giverd = array($sql_buy_it1 => '2',$sql_buy_it2 => '7',$sql_buy_it3 => '13',$sql_buy_it4 => '17',$sql_buy_it5 => '20',$sql_buy_it6  => '40');			
												$newgiverds = array();
												foreach ($giverd as $giverds=>$value)
												{
												$newgiverds = array_merge($newgiverds, array_fill(0, $value, $giverds));
												}
												$answer = $newgiverds[array_rand($newgiverds)];
												
												$querys = "SELECT $answer FROM boxrandom where id = '".$_GET['id']."'";
												$connection_query = $connect->query($querys);
												$box_random = $connection_query->fetch_assoc();
												
												$itemrandom = "SELECT * from random where id = '".$box_random[$answer]."' ";
												$itemrandom_query = $connect->query($itemrandom);
												$itemrandom_list = $itemrandom_query->fetch_assoc();

											
												if($box_random[$answer] >= 1)
												{
													?>
													<script>	
													Swal.fire({
														title: 'คุณได้รับรางวัล <?php echo $itemrandom_list['name'];?>',
														text: 'กรุณาตรวจสอบที่กล่องของขวัญ !',
														imageUrl: '<?php echo $itemrandom_list['pic'];?>',
														imageWidth: 250,
														imageHeight: 250,
														imageAlt: 'ตกลง',
													  })
													</script>
													<?php
													$gachaserver = 'ระบบ Gacha SuzaNetwork';
													$time_date = date("Y-m-d H:i");
													$sql_send_gift = 'INSERT INTO gift (uid_send,uid_receive,date,img,command,name,server_id) VALUES (999,"'.$_SESSION['uid'].'","'.$time_date.'","'.$itemrandom_list['pic'].'","'.$itemrandom_list['cmd'].'","'.$itemrandom_list['name'].'",6)';
													$query_send_gift = $connect->query($sql_send_gift);
												}
												else
												{
												?>
													<script>	
													Swal.fire({
														title: 'เสียใจด้วย !',
														text: 'คุณไม่ได้รับรางวัลอะไรเลย !',
														imageUrl: 'http://103.27.202.58/img/gachafalse.png',
														imageWidth: 250,
														imageHeight: 250,
														imageAlt: 'ตกลง',
													  })
													</script>
													<?php
												}
											}
										?>
									</div>
									<?php
							}
							else
							?>
							<div class="col-md-4">
								<img src="<?php echo $buy['pic']; ?>" class="w-100" style="border-radius: 4px 4px 4px 4px;">
							</div>
							<div class="col p-4 d-flex flex-column position-static">
					          	<h3 class="mb-0">
					          		<?php echo $buy['name']; ?>
									<br>
								<small>ราคา</small>

								<br>
								<h5>
								<div class="col-md-12">
								<br>
								 <?php 
								 if($buy['price'] >= 1)
								 {
								 echo '<div class="alert alert-primary">';
								 echo $buy['price']; 
								 echo ' CountPoint </div>';
								 }
								 ?>
								 </div></h5>
					          	</h3>
					          	<form name="buyrandom" method="POST">
					          		<input type="hidden" value="<?php echo $buy['id']; ?>"/>
						          	<button type="submit" name="btn_buy" class="btn btn-pulse btn-primary btn-block mt-3">
						          		<i class="fa fa-shopping-cart"></i> สุ่ม <?php echo $buy['name']; ?>
						          	</button>
                                                                
					          	</form>
					        </div>
							<?php
						}
					?>
				</div>
			<?php
		}
	?>
</div>
</div>
<?php
if(!isset($_POST['buyrandom']))
$randomstart

?>