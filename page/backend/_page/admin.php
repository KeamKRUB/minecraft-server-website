<?php
    if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
    {
      $admin_id = $_GET['id'];
      $sql_f_edit_admin = 'SELECT * FROM admin WHERE id = "'.$admin_id.'"';
      $query_f_edit_admin = $connect->query($sql_f_edit_admin);

      if($query_f_edit_admin->num_rows != 0)
      {
        $admin_f = $query_f_edit_admin->fetch_assoc();

        if(isset($_POST['edit_admin']))
        {
          $bungee_edit = $_POST['edit_admin_bungee'];
          $sql_edit_admin = 'UPDATE admin SET 
								username = "'.$_POST['admin_name'].'", 
								rank = "'.$_POST['admin_rank'].'", 
								descript = "'.$_POST['admin_descript'].'"';
          $sql_edit_admin .= ' WHERE id = "'.$admin_f['id'].'"';
          $query_edit_admin = $connect->query($sql_edit_admin);
          if($query_edit_admin)
          {
            $msg = 'แก้ไข #'.$admin_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไข #'.$admin_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการแก้ไข #'.$admin_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการแก้ไข #'.$admin_f['id'].'</strong></div>';

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
        if(isset($_POST['btn_rm_admin']))
        {
          $sql_rm_admin = 'DELETE FROM admin';
          $sql_rm_admin .= ' WHERE id = "'.$admin_f['id'].'"';
          $query_rm_admin = $connect->query($sql_rm_admin);
          if($query_rm_admin)
          {
            $msg = 'ลบ #'.$admin_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ลบ #'.$admin_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการลบ #'.$admin_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการลบ #'.$admin_f['id'].'</strong></div>';

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
          <h4 class="mb-3 text-center">จัดการแอดมิน <div class='text-muted'>#<?php echo $admin_f['id']; ?></div></h4>
          <form name="edit_admin" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                      <label for="admin_name">ชื่อแอดมิน</label>
                      <input type="text" class="form-control" id="admin_name" name="admin_name" value="<?php echo $admin_f['username']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="admin_rank">ยศแอดมิน</label>
                      <input type="text" class="form-control" id="admin_rank" name="admin_rank" required="" value="<?php echo $admin_f['rank']; ?>">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label for="admin_rank">ข้อความ</label>
                      <input type="text" class="form-control" id="admin_descript" name="admin_descript" value="<?php echo $admin_f['description']; ?>">
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="edit_admin" class="btn btn-primary btn-block">
                      แก้ไข #<?php echo $admin_f['id']; ?>
                    </button>
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_rm_admin" class="btn btn-primary btn-block">
                      ลบ #<?php echo $admin_f['id']; ?>
                    </button>
                  </div>
              </div>
          </form>
        <?php
      }
    }
    elseif(isset($_GET['action']) && $_GET['action'] != NULL && $_GET['action'] != "" && $_GET['action'] == 'add')
    {
      if(isset($_POST['btn_add_admin']))
      {
        $sql_add_admin = 'INSERT INTO admin (username,rank,description) VALUES ("'.$_POST['admin_name'].'","'.$_POST['admin_rank'].'","'.$_POST['admin_descript'].'")';
        $query_add_admin = $connect->query($sql_add_admin);

        if($query_add_admin)
        {
          $msg = 'เพิ่มแอดมินสำเร็จ';
          $alert = 'success';
          $msg_alert = 'สำเร็จ!';
          //* ประกาศ
          echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เพิ่มแอดมินเรียบร้อยแล้ว</strong></div>';

          //* REFRESH
          echo "<meta http-equiv='refresh' content='5 ;'>";
        }
        else
        {
          $msg = 'ผิดพลาดในการเพิ่มแอดมิน';
          $alert = 'error';
          $msg_alert = 'เกิดข้อผิดพลาด!';
          //* ประกาศ
          echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการเพิ่มแอดมิน</strong></div>';

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
        <h4 class="mb-3 text-center">เพิ่มแอดมิน</h4>
        <form name="add_admin" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                      <label for="admin_name">ชื่อแอดมิน</label>
                      <input type="text" class="form-control" id="admin_name" name="admin_name" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="admin_rank">ยศแอดมิน</label>
                      <input type="text" class="form-control" id="admin_rank" name="admin_rank" required="" value="0">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label for="admin_command">ข้อความ</label>
                      <input type="text" class="form-control" id="admin_descript" name="admin_descript" required="">
                  </div>
                  <div class="col-md-6 my-4">
                    <button type="submit" name="btn_add_admin" class="btn btn-primary btn-block">
                      เพิ่ม
                    </button>
                  </div>
              </div>
          </form>
      <?php
    }
    else
    {
      $sql_admin = 'SELECT * FROM admin';

      if(isset($_GET['category']) && is_numeric($_GET['category']))
      {
        $sql_admin .= ' WHERE category = "'.$_GET['category'].'"';
      }

      $sql_admin .= ' ORDER BY id DESC';

      $query_admin = $connect->query($sql_admin);

      if($query_admin->num_rows <= 0)
      {
        echo "<h5 class='col-md-12 text-center'>ไม่พบแอดมิน</h5>";
        echo '<br><a href="?page=backend&menu=admin&action=add" class="btn btn-danger w-100 mb-1 border-0">เพิ่มแอดมิน</a>';
      }
      else
      {
        echo '<div class="row">';
        
        while($admin = $query_admin->fetch_assoc())
        {
          ?>

        <div class="col-md-4">
<div class="item" >
<div class="shadow-effect">
<img class="img-circle" src="https://minotar.net/armor/bust/<?php echo $admin['username'];?>/175" ><hr>
</div>
</div>            <div class="btn btn-info w-100 mb-1 border-0 disable"><?php echo $admin['rank'];?></div>
                  <a href="?page=backend&menu=admin&id=<?php echo $admin['id']; ?>" class="btn btn-primary w-100 mb-1 border-0">แก้ไข :<?php echo $admin['username'];?></a>
                </div>
          <?php
        }
        echo "</div>";
        echo '<br><a href="?page=backend&menu=admin&action=add" class="btn btn-danger w-100 mb-1 border-0">เพิ่มแอดมิน</a>';
      }
    }
?>