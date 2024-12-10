<?php
    if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
    {
      $random_id = $_GET['id'];
      $sql_f_edit_random = 'SELECT * FROM random WHERE id = "'.$random_id.'"';
      $query_f_edit_random = $connect->query($sql_f_edit_random);

      if($query_f_edit_random->num_rows != 0)
      {
        $random_f = $query_f_edit_random->fetch_assoc();

        if(isset($_POST['btn_edit_random']))
        {
          $bungee_edit = $_POST['edit_random_bungee'];
          $sql_edit_random = 'UPDATE random SET 
								name = "'.$_POST['random_name'].'", 
								cmd1 = "'.$_POST['random_command1'].'", 
								pic = "'.$_POST['random_pic'].'"';
          $sql_edit_random .= ' WHERE id = "'.$random_f['id'].'"';
          $query_edit_random = $connect->query($sql_edit_random);
          if($query_edit_random)
          {
            $msg = 'แก้ไข #'.$random_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไข #'.$random_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการแก้ไข #'.$random_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการแก้ไข #'.$random_f['id'].'</strong></div>';

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
        if(isset($_POST['btn_rm_random']))
        {
          $sql_rm_random = 'DELETE FROM random';
          $sql_rm_random .= ' WHERE id = "'.$random_f['id'].'"';
          $query_rm_random = $connect->query($sql_rm_random);
          if($query_rm_random)
          {
            $msg = 'ลบ #'.$random_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ลบ #'.$random_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการลบ #'.$random_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการลบ #'.$random_f['id'].'</strong></div>';

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
        ?>
          <h4 class="mb-3 text-center">จัดการสินค้า <div class='text-muted'>#<?php echo $random_f['id']; ?></div></h4>
          <form name="edit_random" method="POST">
            <div class="row">
              <div class="col-md-12 mb-3">
                      <label for="random_name">ชื่อไอเทม</label>
                      <input type="text" class="form-control" id="random_name" name="random_name" value="<?php echo $random_f['name']; ?>">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label for="random_randomcute">คำสั่ง1</label>
                      <input type="text" class="form-control" id="random_command1" name="random_command1" value="<?php echo $random_f['cmd1']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="random_pic">รูปภาพ</label>
                      <input type="text" class="form-control" id="random_pic" name="random_pic" value="<?php echo $random_f['pic']; ?>">
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_edit_random" class="btn btn-primary btn-block">
                      แก้ไข #<?php echo $random_f['id']; ?>
                    </button>
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_rm_random" class="btn btn-primary btn-block">
                      ลบ #<?php echo $random_f['id']; ?>
                    </button>
                  </div>
              </div>
          </form>
        <?php
      }
    }
    elseif(isset($_GET['action']) && $_GET['action'] != NULL && $_GET['action'] != "" && $_GET['action'] == 'add')
    {
      if(isset($_POST['btn_add_random']))
      {
        $bungee_add = $_POST['random_bungeecord'];
        $sql_add_random = 'INSERT INTO random (name,pic,cmd1) VALUES ("'.$_POST['random_name'].'","'.$_POST['random_pic'].'","'.$_POST['random_command1'].'")';
        $query_add_random = $connect->query($sql_add_random);

        if($query_add_random)
        {
          $msg = 'เพิ่มสินค้าใหม่เรียบร้อยแล้ว';
          $alert = 'success';
          $msg_alert = 'สำเร็จ!';
          //* ประกาศ
          echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เพิ่มสินค้าใหม่เรียบร้อยแล้ว</strong></div>';

          //* REFRESH
          echo "<meta http-equiv='refresh' content='5 ;'>";
        }
        else
        {
          $msg = 'เกิดข้อผิดพลาดในการเพิ่มสินค้า';
          $alert = 'error';
          $msg_alert = 'เกิดข้อผิดพลาด!';
          //* ประกาศ
          echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการเพิ่มสินค้า</strong></div>';

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
      ?>
        <h4 class="mb-3 text-center">เพิ่มสินค้า</h4>
        <form name="add_random" method="POST">
            <div class="row">
              <div class="col-md-12 mb-3">
                      <label for="random_name">ชื่อไอเทม</label>
                      <input type="text" class="form-control" id="random_name" name="random_name" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label for="random_command">คำสั่ง1</label>
                      <input type="text" class="form-control" id="random_command1" name="random_command1" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="random_pic">รูปภาพ</label>
                      <input type="text" class="form-control" id="random_pic" name="random_pic" required="">
                  </div>
                  <div class="col-md-6 my-4">
                    <button type="submit" name="btn_add_random" class="btn btn-primary btn-block">
                      เพิ่ม
                    </button>
                  </div>
              </div>
          </form>
      <?php
    }
    else
    {
      $sql_random = 'SELECT * FROM random';

      if(isset($_GET['category']) && is_numeric($_GET['category']))
      {
        $sql_random .= ' WHERE category = "'.$_GET['category'].'"';
      }

      $sql_random .= ' ORDER BY id DESC';

      $query_random = $connect->query($sql_random);

      if($query_random->num_rows <= 0)
      {
        echo "<h5 class='col-md-12 text-center'>ไม่พบสินค้า</h5>";
      }
      else
      {
        echo '<div class="row">';
        while($random = $query_random->fetch_assoc())
        {
          ?>
        <div class="col-md-4">
            <div class="item" style="margin-bottom: 20px;">
              <div class="item-image">
              <a class="item-image-randomcute"><?php echo number_format($random['randomcute'], 2); ?> บาท</a>
              <center><img src="<?php echo $random['pic']; ?>"></center>
              <a class="item-image-bottom"><?php echo $random['name']; ?></a>
            </div>
              <div class="item-info">
                <div class="item-text">
                  <a style="font-size: 18px;"><?php echo $random['name']; ?></a><br>ราคา : <?php echo number_format($random['randomcute'], 2); ?> พ้อยท์<br><br>
                  <a href="?page=backend&menu=random&id=<?php echo $random['id']; ?>" class="btn btn-primary w-100 mb-1 border-0">แก้ไข</a>
                </div>
              </div>
            </div>
              </div> 
          <?php
        }
        echo "</div>";
      }
      echo '<br><a href="?page=backend&menu=random&action=add" class="btn btn-danger w-100 mb-1 border-0">เพิ่ม</a>';
    }
?>