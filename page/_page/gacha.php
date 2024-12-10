<div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><i class="fa fa-shopping-cart"></i> ร้านค้า</h5>
                            <hr>
                            <div class="row"><br>
                             <?php
                                if(isset($_GET['page']) && $_GET['page'] != 'shop')
                                {
                                  $sql_product = 'SELECT * FROM boxrandom ORDER BY id DESC';
                                }
                                else
                                {
                                  $sql_product = 'SELECT * FROM boxrandom';
                                }

                                if(isset($_GET['server']) && is_numeric($_GET['server']))
                                {
                                  $sql_product .= ' WHERE server_id = "'.$_GET['server'].'"';
                                }

                                if(isset($_GET['category']) && is_numeric($_GET['category']))
                                {
                                  if(isset($_GET['server']) && is_numeric($_GET['server']))
                                  {
                                    $sql_product .= ' AND category = "'.$_GET['category'].'"';
                                  }
                                  else
                                  {
                                    $sql_product .= ' WHERE category = "'.$_GET['category'].'"';
                                  }
                                }

                                if(isset($_GET['page']) && $_GET['page'] != 'shop')
                                {
                                  $sql_product .= ' LIMIT 6';
                                }
                                elseif(!isset($_GET['page']))
                                {
                                  $sql_product .= ' LIMIT 6';
                                }

                                $query_product = $connect->query($sql_product);

                                if($query_product->num_rows <= 0)
                                {
                                  echo "<h5 class='col-md-12 text-center'>ไม่พบสินค้า</h5>";
                                }
                                else
                                {
                                  while($product = $query_product->fetch_assoc())
                                  { ?>
                <div class="col-md-4">
            <div class="item" style="margin-bottom: 20px;">
              <div class="item-image">
			  <a class="item-image-price">
              <?php 
              if($product['price'] >= 1)
              {
              echo $product['price']; 
              echo 'CP ';
              }
              ?></a>
              <center><img src="<?php echo $product['pic']; ?>"></center>
              <a class="item-image-bottom"><?php echo $product['name'];?> 
              </a>
            </div>
              <div class="item-info">
                <div class="item-text">
				          <a style="font-size: 18px;"><?php echo $product['name']; ?></a>
                  <a href="?page=confirmgacha&id=<?php echo $product['id']; ?>" class="btn btn-primary w-100 mb-1 border-0">ซื้อสินค้า</a>
                </div>
              </div>
            </div>
              </div> 
                            
                                <?php } } ?>
                                </div>
                            </div>
                        </div>