*<div class="col-md-12">
	<div class="row"> 
		<div class="col-md-12">
			<div class="card border-0 shadow mb-4 col-md-12">
				<div class="card-body">
					<div class="card-header bg-dark" style="color: white;">&nbsp;บรรยากาศภายในเซิฟเวอร์</div>
					<img src="https://imgur.com/M4OYOvt.png" class="mr-3" width="100%" height="350">
				</div>
			<hr>
			<center>  
				<div class="row">
					<div class="col-md-9 mb-3">
						<form method="post" action="">
						</form>
					</div>
				</div>
				</center>
			</div>  
		</div>
	</div>
</div>
<div class="card border-0 shadow mb-4">
<div class="card-body">
<div class="card-header bg-success" style="color: white;"><i class="fa fa-trophy"></i>&nbsp;อันดับเติมเงินสูงสุด
</div>
<hr>

<?php
$sql_most = 'SELECT * FROM activities WHERE (action = "TOPUP Truewallet" || action = "TOPUP TrueMoney") ORDER BY id DESC LIMIT 5';
$query_most = $connect->query($sql_most);
?>
<table class="table table-striped ranking_tb" border="0" style="font-size:13px;">
  <thead>
    <tr>
      <th scope="col">ชื่อผู้เล่น</th>
      <th scope="col">จำนวน</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($query_most->num_rows > 0)
    {
      while($list_topup = $query_list->fetch_assoc())
      {
        ?>
        <tr>
          <td>
            <img src="https://minotar.net/avatar/<?php echo $list_topup['username']; ?>/28" class="mr-3" width="28"><?php echo $list_topup['realname']; ?>
          </td>
          <td>
            <?php echo number_format($list_topup['topup'],2); ?> <i class="fa fa-adjust"></i>
          </td>
        </tr>
        <?php
      }
    }
    else
    {
      ?>
      <tr>
        <td>
          <img src="https://minotar.net/avatar/steve/28" class="mr-3" width="28">ยังไม่มีใครเติมเงินเลย ;-;
        </td>
        <td>
          <?php echo number_format("0",2); ?> <i class="fas fa-coins text-dark"></i>
        </td>
      </tr>
      <?php
    }
    ?>
	 </tbody>
</table>
</div>
</div>

<?php
if(isset($_POST['btn_shop_count']))
{
    $a_scp = 20 * $_POST['shop_count'];
    $check_m = 'SELECT * from authme WHERE id = "'.$_SESSION['uid'].'"';
    $query_player = $connect->query($check_m);
    $mcp_c = $query_player ->fetch_assoc();

    if($mcp_c['rp'] >= $a_scp)
    {
      $sql_rem_rp = 'UPDATE authme SET rp = rp-"'.$a_scp.'" WHERE id = "'.$_SESSION['uid'].'"';
      $query_rem_rp = $connect->query($sql_rem_rp);
      $sql_rem_count = 'UPDATE authme SET count = count+"'.$_POST['shop_count'].'" WHERE id = "'.$_SESSION['uid'].'"';
		  $query_rem_count = $connect->query($sql_rem_count);
      $msg = 'ซื้อ '.$buy['name']. 'CountPoint';
		  $alert = 'success';
      $msg_alert = 'สำเร็จ!';
    }
    else
    {
		  $msg = 'RealPoint คุณไม่เพียงพอ ';
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
