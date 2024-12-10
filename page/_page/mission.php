<?php
$missionsetcount = "SELECT * FROM missionset WHERE id  = 1";
$mission_query = $connect->query($missionsetcount);
$missioncount = $mission_query->fetch_assoc();

$missionsetcount2 = "SELECT * FROM missionset WHERE id  = 2";
$mission_query2 = $connect->query($missionsetcount2);
$missioncount2 = $mission_query2->fetch_assoc();
?>
<div class="card border-0 shadow mb-4">
<div class="card-body">
<h5 class="m-0">ภารกิจทั้งเซิฟเวอร์</h5>
<hr>
<?php
	if(!isset($_SESSION['uid']) || !isset($_SESSION['username']))
	{
  	  include_once '_page/alertLogin.php';
	}
		else
	{
?>
<div class="alert alert-danger" role="alert"><h4>1 IP จะสามารถรับได้เพียงแค่ 1 ครั้งเท่านั้น!</h4></div>

<form method="post" action="">
	<input type="hidden" name="submitmis" value="miss1">
		<div class="col-md-12 input-group">
			<div class="input-group-prepend">
				<span class="input-group-text lp-title-input"><i class="fa fa-barcode"></i>&nbsp;ภารรกิจ&nbsp;:&nbsp;</span>
			</div>
				<div class="form-control form-control-lg lp-input">ยอดเติมสะสมทั้งหมดในเซิฟครบ <?php echo $missioncount['count'];?> บาท</div>
<?php
	$checktopup = "SELECT money FROM wallet_account WHERE id = 1";
	$culetopup = $connect->query($checktopup);
	$topup = $culetopup->fetch_assoc();
	$r_topup = $topup['money'];
	$mc1 >= $missioncount['count'];

	if($r_topup >= $missioncount['count'])
	{
		echo '<button type="submit" class="btn btn-success">'.$topup['money'].'/'.$missioncount['count'].' สำเร็จ</button>';	
	}
	else
	{
		echo '<div class="btn btn-danger">'.$topup['money'].'/'.$missioncount['count'].' ไม่สำเร็จ</div>';
	}
?>
</form>

</div>
<div class="col-md-12">
<div class="card card-body">
    <h6><?php echo $missioncount['mess'];?></h6>
</div>
</div>
<br>
<form method="post" action="">
	<input type="hidden" name="submitmis2" value="miss2">
<div class="col-md-12 input-group">
<div class="input-group-prepend">
<span class="input-group-text lp-title-input"><i class="fa fa-barcode"></i>&nbsp;ภารรกิจ&nbsp;:&nbsp;</span>
</div>
<div class="form-control form-control-lg lp-input">ยอดเติมสะสมทั้งหมดในเซิฟครบ <?php echo $missioncount2['count'];?> บาท</div>
<?php
	$mc2 = $missioncount2['count'];

	if($r_topup >= $missioncount2['count'])
	{
		echo '<button type="submit" class="btn btn-success">'.$topup['money'].'/'.$missioncount2['count'].' สำเร็จ</button>';
		
	}
	else
	{
		echo '<div class="btn btn-danger">'.$topup['money'].'/'.$missioncount2['count'].' ไม่สำเร็จ</div>';
	}
?>
</div>
</form>
	<div class="col-md-12">
		<div class="card card-body">
    		<h6><?php echo $missioncount2['mess'];?></h6>
		</div>
	</div>

<?php
}
?>

</div>
</div>  
<?php
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$sql_buy = 'SELECT * FROM mission WHERE id = "'.$_GET['id'].'"';
	}
	else
	{
		$sql_buy = 'SELECT * FROM mission WHERE id = "0"';
	}

	$query_buy = $connect->query($sql_buy);
?>     