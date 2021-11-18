<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Xem sản phẩm</p>
                        <div class="right__table">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <div class="right__tableWrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%">STT</th>
                                            <th width="25%">Tên sản phẩm</th>
                                            <th width="15%">Hình ảnh</th>
                                            <th width="10%">Thư viện ảnh</th>
                                            <th width="15%">Danh mục</th>
                                            <th width="10%">Giá SP</th>
                                            <th width="10%">Số lượng</th>
                                            <th width="10%">Nhãn sản phẩm</th>
                                            <th width="12%">Trạng thái</th>
                                            <th width="5%"></th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            if($list_product){
                                                $i = 0;
                                                foreach ($list_product as $key => $product) {
                                                    $i++;
                                         ?>
                                        <tr>
                                            <td data-label="STT"><?php echo $i ?></td>
                                            <td data-label="Tên sản phẩm">
                                                <?php echo $product['name']; ?>  
                                            </td>
                                            <td data-label="Hình ảnh">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $product['thumbnail'] ?>" alt=""/>
                                            </td>
                                            <td data-label="Thư viện ảnh">
                                                <a href="<?php echo _WEB_ROOT; ?>/view-gallery/prodid-<?php echo $product['prod_id']; ?>">
                                                    Xem thư viện ảnh 
                                                </a>   
                                            </td>
                                            <td data-label="Danh mục">
                                                <?php echo $product['cate_name']; ?>  
                                            </td>
                                            <td data-label="Giá SP">
                                                <?php 
                                                    echo $product['regular_price'];
                                                 ?>
                                                 đ
                                            </td>
                                            <td data-label="Số lượng">
                                                <?php echo $product['product_quantity']; ?>  
                                            </td>
                                            <td data-label="Nhãn">
                                                <?php 
                                                    if($product['feature'] == 1){
                                                    ?>  
                                                        <span>Nổi bật</span>
                                                        <span class="success"> 
                                                            <a data-id = "<?php echo $product['prod_id'] ?>"
                                                            class = "non-featured">
                                                                <i class="far fa-check-circle" style="font-size: 12px; margin-left: 4px"></i>
                                                            </a>
                                                        </span>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <span>Thường</span>
                                                        <span class="error">
                                                            <a  data-id = "<?php echo $product['prod_id'] ?>"
                                                            class = "featured">
                                                                <i class="fas fa-check-circle" style="font-size: 12px; margin-left: 4px"></i>
                                                            </a>
                                                        </span>
                                                <?php
                                                    }
                                                 ?>
                                            </td>
                                            <td data-label="Trạng thái">
                                                <?php 
                                                    if($product['best_seller'] == 1){
                                                ?>
                                                    <span class="display-title">
                                                        Đang hiện
                                                    </span>
                                                    <span class="success"> 
                                                        <button class = "unactive" 
                                                        data-id = "<?php echo $product['prod_id'] ?>"
                                                        style = 'background: none;'>
                                                            <i class='far fa-eye-slash' style="font-size: 12px; margin-left: 10px;"></i>
                                                        </button>
                                                    </span>
                                                <?php 
                                                    }else{
                                                 ?>
                                                    <span class="display-title">Đang ẩn</span>
                                                    <span class="error">
                                                        <button style = 'background: none;'
                                                        class = "active"
                                                        data-id = "<?php echo $product['prod_id'] ?>">
                                                            <i class='far fa-eye' style="font-size: 12px; margin-left: 10px;"></i>
                                                        </button>
                                                    </span>
                                                <?php 
                                                    }
                                                 ?>
                                            </td>
                                            <td data-label="Xoá/Sửa" class="right__iconTable">
                                                <a href="<?php echo _WEB_ROOT; ?>/delete-product/delid-<?php echo $product['prod_id'] ?>"
                                                   onclick = "return confirm('Bạn có chắc chắn muốn xóa?')"
                                                   class = "delete" style = "background: none;">
                                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-trash-black.svg" alt="">
                                                </a>
                                                <a href="<?php echo _WEB_ROOT; ?>/edit-product/editid-<?php echo $product['prod_id'] ?>">
                                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-edit.svg" alt="">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                                }
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var unact_items = document.querySelectorAll('.unactive');

        unact_items.forEach(element => {
            element.addEventListener('click', function() {
                var unact_id = element.dataset.id;
                $.ajax({
                    url: '<?php echo _WEB_ROOT; ?>/unactive-product',
                    method: 'POST',
                    data:{
                        unact_id:unact_id
                    },
                    success:function(data){
                        if(data == null){
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại');
                        }else{
                            element.firstElementChild.className = 'far fa-eye';
                            element.className = 'active';
                            element.parentElement.className = 'error';
                            element.parentElement.previousElementSibling.innerHTML = "Đang ẩn";
                            unact_items = document.querySelectorAll('.unactive');
                            act_items = document.querySelectorAll('.active');
                            console.log(unact_items);
                            console.log(act_items);
                        }
                    }
                })
            });
        });

        var act_items = document.querySelectorAll('.active');
        act_items.forEach(element => {
            element.addEventListener('click', function() {
                var act_id = element.dataset.id;
                $.ajax({
                    url:'<?php echo _WEB_ROOT; ?>/active-product',
                    method: 'POST',
                    data:{
                        act_id:act_id
                    },
                    success:function(data){
                        if(data == null){
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại');
                        }else{
                            element.firstElementChild.className = 'far fa-eye-slash';
                            element.className = 'unactive';
                            element.parentElement.className = 'success';
                            element.parentElement.previousElementSibling.innerHTML = "Đang hiện";
                            unact_items = document.querySelectorAll('.unactive');
                            act_items = document.querySelectorAll('.active');
                            console.log(act_items);
                            console.log(unact_items);
                        }
                    }
                })
            });
        });

        var nofeat_items = document.querySelectorAll('.non-featured');
        nofeat_items.forEach(element => {
            element.addEventListener('click', function() {
                var nonfeat_id = element.dataset.id;
                $.ajax({
                    url: '<?php echo _WEB_ROOT; ?>/nonfeature-product',
                    method: 'POST',
                    data:{
                        nonfeat_id:nonfeat_id
                    },
                    success:function(data){
                        if(data == null){
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại');
                        }else{
                            element.firstElementChild.className = 'fas fa-check-circle';
                            element.className = 'featured';
                            element.parentElement.className = 'error';
                            element.parentElement.previousElementSibling.innerHTML = "Thường";
                        }
                    }
                })
            });
        });

        var feat_items = document.querySelectorAll('.featured');
        feat_items.forEach(element => {
            element.addEventListener('click', function() {
                var feat_id = element.dataset.id;
                $.ajax({
                    url: '<?php echo _WEB_ROOT; ?>/feature-product',
                    method: 'POST',
                    data:{
                        feat_id:feat_id
                    },
                    success:function(data){
                        if(data == null){
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại');
                        }else{
                            element.firstElementChild.className = 'far fa-check-circle';
                            element.className = 'non-featured';
                            element.parentElement.className = 'success';
                            element.parentElement.previousElementSibling.innerHTML = "Nổi bật";
                        }
                    }
                })
            });
        });
    </script>
