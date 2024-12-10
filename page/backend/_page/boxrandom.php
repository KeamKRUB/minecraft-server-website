<?php
    if(isset($_GET['id']) && $_GET['id'] != NULL && $_GET['id'] != "")
    {
      $boxrandom_id = $_GET['id'];
      $sql_f_edit_boxrandom = 'SELECT * FROM boxrandom WHERE id = "'.$boxrandom_id.'"';
      $query_f_edit_boxrandom = $connect->query($sql_f_edit_boxrandom);

      if($query_f_edit_boxrandom->num_rows != 0)
      {
        $boxrandom_f = $query_f_edit_boxrandom->fetch_assoc();

        if(isset($_POST['btn_edit_boxrandom']))
        {
          $bungee_edit = $_POST['edit_boxrandom_bungee'];
          $sql_edit_boxrandom = 'UPDATE boxrandom SET 
								name = "'.$_POST['boxrandom_name'].'", 
								price = "'.$_POST['boxrandom_price'].'",
								pic = "'.$_POST['boxrandom_pic'].'",
								it1 = "'.$_POST['product_category1'].'",
								it2 = "'.$_POST['product_category2'].'",
								it3 = "'.$_POST['product_category3'].'",
								it4 = "'.$_POST['product_category4'].'",
								it5 = "'.$_POST['product_category5'].'",
								it6 = "'.$_POST['product_category6'].'"';
          $sql_edit_boxrandom .= ' WHERE id = "'.$boxrandom_f['id'].'"';
          $query_edit_boxrandom = $connect->query($sql_edit_boxrandom);
          if($query_edit_boxrandom)
          {
            $msg = 'แก้ไข #'.$boxrandom_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>แก้ไข #'.$boxrandom_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการแก้ไข #'.$boxrandom_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการแก้ไข #'.$boxrandom_f['id'].'</strong></div>';

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
        if(isset($_POST['btn_rm_boxrandom']))
        {
          $sql_rm_boxrandom = 'DELETE FROM boxrandom';
          $sql_rm_boxrandom .= ' WHERE id = "'.$boxrandom_f['id'].'"';
          $query_rm_boxrandom = $connect->query($sql_rm_boxrandom);
          if($query_rm_boxrandom)
          {
            $msg = 'ลบ #'.$boxrandom_f['id'].' เรียบร้อยแล้ว';
            $alert = 'success';
            $msg_alert = 'สำเร็จ!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>ลบ #'.$boxrandom_f['id'].' เรียบร้อยแล้ว</strong></div>';

            //* REFRESH
            echo "<meta http-equiv='refresh' content='5 ;'>";
          }
          else
          {
            $msg = 'เกิดข้อผิดพลาดในการลบ #'.$boxrandom_f['id'];
            $alert = 'error';
            $msg_alert = 'เกิดข้อผิดพลาด!';
            //* ประกาศ
            echo '<div class="alert alert-info"><i class="fa fa-spinner fa-spin fa-lg"></i> <strong>เกิดข้อผิดพลาดในการลบ #'.$boxrandom_f['id'].'</strong></div>';

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
          <h4 class="mb-3 text-center">จัดการสินค้า <div class='text-muted'>#<?php echo $boxrandom_f['id']; ?></div></h4>
          <form name="edit_boxrandom" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                      <label for="boxrandom_name">boxrandom</label>
                      <input type="text" class="form-control" id="boxrandom_name" name="boxrandom_name" value="<?php echo $boxrandom_f['name']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="boxrandom_price">ราคา boxrandom</label>
                      <input type="text" class="form-control" id="boxrandom_price" name="boxrandom_price" required="" value="<?php echo $boxrandom_f['price']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="boxrandom_pic">รูปภาพ</label>
                      <input type="text" class="form-control" id="boxrandom_pic" name="boxrandom_pic" value="<?php echo $boxrandom_f['pic']; ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 1 (2%)</label>
                      <select name="product_category1" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $boxrandom_f['it1']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 2 (7%)</label>
                      <select name="product_category2" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $boxrandom_f['it2']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 3 (13%)</label>
                      <select name="product_category3" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $boxrandom_f['it3']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 4 (17%)</label>
                      <select name="product_category4" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $boxrandom_f['it4']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 5 (20%)</label>
                      <select name="product_category5" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $boxrandom_f['it5']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 6 (41%)</label>
                      <select name="product_category6" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $boxrandom_f['it6']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_edit_boxrandom" class="btn btn-primary btn-block">
                      แก้ไข #<?php echo $boxrandom_f['id']; ?>
                    </button>
                  </div>
                  <div class="col-md-3 my-4">
                    <button type="submit" name="btn_rm_boxrandom" class="btn btn-primary btn-block">
                      ลบ #<?php echo $boxrandom_f['id']; ?>
                    </button>
                  </div>
              </div>
          </form>
        <?php
      }
    }
    elseif(isset($_GET['action']) && $_GET['action'] != NULL && $_GET['action'] != "" && $_GET['action'] == 'add')
    {
      if(isset($_POST['btn_add_boxrandom']))
      {
        $bungee_add = $_POST['boxrandom_bungeecord'];
        $sql_add_boxrandom = 'INSERT INTO boxrandom (name,price,pic,it1,it2,it3,it4,it5,it6) VALUES ("'.$_POST['boxrandom_name'].'","'.$_POST['boxrandom_price'].'","'.$_POST['boxrandom_pic'].'","'.$_POST['product_category1'].'","'.$_POST['product_category2'].'","'.$_POST['product_category3'].'","'.$_POST['product_category4'].'","'.$_POST['product_category5'].'","'.$_POST['product_category6'].'")';
        $query_add_boxrandom = $connect->query($sql_add_boxrandom);

        if($query_add_boxrandom)
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
        <form name="add_boxrandom" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                      <label for="boxrandom_name">ชื่อ Box</label>
                      <input type="text" class="form-control" id="boxrandom_name" name="boxrandom_name" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="boxrandom_price">ราคา</label>
                      <input type="text" class="form-control" id="boxrandom_price" name="boxrandom_price" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                      <label for="boxrandom_pic">รูปภาพ</label>
                      <input type="text" class="form-control" id="boxrandom_pic" name="boxrandom_pic" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 1 (2%)</label>
                      <select name="product_category1" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $product_f['name']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 2 (7%)</label>
                      <select name="product_category2" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $product_f['name']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 3 (13%)</label>
                      <select name="product_category3" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $product_f['name']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 4 (17%)</label>
                      <select name="product_category4" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $product_f['name']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 5 (20%)</label>
                      <select name="product_category5" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $product_f['name']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="product_category">รางวัล 6 (41%)</label>
                      <select name="product_category6" class="form-control">
                        <option value="<?php echo $product_f['name']; ?>"> รางวัล: <?php echo $product_f['name']; ?></option>
                          <?php
                            $sql_category = "SELECT * FROM random";
                            $query_category = $connect->query($sql_category);
                            while($result = $query_category->fetch_assoc())
                            {
                                ?>
                                  <option value="<?php echo $result["id"];?>"><?php echo $result["id"]." - ".$result["name"];?></option>
                                <?php
                            }
                          ?>
                        </select>
                  </div>
                  <div class="col-md-6 my-4">
                    <button type="submit" name="btn_add_boxrandom" class="btn btn-primary btn-block">
                      เพิ่ม
                    </button>
                  </div>
              </div>
          </form>
      <?php
    }
    else
    {
      $sql_boxrandom = 'SELECT * FROM boxrandom';

      if(isset($_GET['category']) && is_numeric($_GET['category']))
      {
        $sql_boxrandom .= ' WHERE category = "'.$_GET['category'].'"';
      }

      $sql_boxrandom .= ' ORDER BY id DESC';

      $query_boxrandom = $connect->query($sql_boxrandom);

      if($query_boxrandom->num_rows <= 0)
      {
        echo "<h5 class='col-md-12 text-center'>ไม่พบสินค้า</h5>";
      }
      else
      {
        echo '<div class="row">';
        while($boxrandom = $query_boxrandom->fetch_assoc())
        {
          ?>
        <div class="col-md-4">
            <div class="item" style="margin-bottom: 20px;">
              <div class="item-image">
              <a class="item-image-price"><?php echo number_format($boxrandom['price'], 2); ?> บาท</a>
              <center><img src="<?php echo $boxrandom['pic']; ?>"></center>
              <a class="item-image-bottom"><?php echo $boxrandom['name']; ?></a>
            </div>
              <div class="item-info">
                <div class="item-text">
                  <a style="font-size: 18px;"><?php echo $boxrandom['name']; ?></a><br>ราคา : <?php echo number_format($boxrandom['price'], 2); ?> พ้อยท์<br><br>
                  <a href="?page=backend&menu=boxrandom&id=<?php echo $boxrandom['id']; ?>" class="btn btn-primary w-100 mb-1 border-0">แก้ไข</a>
                </div>
              </div>
            </div>
              </div> 
          <?php
        }
        echo "</div>";
      }
      echo '<br><a href="?page=backend&menu=boxrandom&action=add" class="btn btn-danger w-100 mb-1 border-0">เพิ่ม</a>';
    }    
?>