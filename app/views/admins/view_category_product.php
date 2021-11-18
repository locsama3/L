<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Xem danh mục sản phẩm</p>
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
                                            <th width="30%">Tên danh mục</th>
                                            <th width="30%">Mô tả</th>
                                            <th width="15%">Hiển Thị</th>
                                            <th width="5%">Sửa</th>
                                            <th width="5%">Xoá</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            $i = 0;
                                            foreach ($list_cate as $key => $cate_prod) {
                                                $i++;
                                         ?>
                                            <tr>
                                                <td data-label="STT"><?= $i ?></td>
                                                <td data-label="Tiêu đề">
                                                    <?= $cate_prod['cate_name'] ?>
                                                </td>
                                                <td data-label="Mô tả">
                                                    <?php echo $cate_prod['cate_slug'] ?>
                                                </td>
                                                <td data-label="Trạng thái" class="right__iconTable">
                                                    <?php 
                                                        if($cate_prod['display'] == 1){
                                                        ?>  
                                                            <span>Đang hiện</span>
                                                            <span> 
                                                                <a href="<?php echo _WEB_ROOT; ?>/unactive-cate-prod/id-<?php echo $cate_prod['id'] ?>">
                                                                    <i class='far fa-eye-slash' style="font-size: 12px; margin-left: 10px; color:red"></i>
                                                                </a>
                                                            </span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <span>Đang ẩn</span>
                                                            <span>
                                                                <a href="<?php echo _WEB_ROOT; ?>/active-cate-prod/id-<?php echo $cate_prod['id'] ?>">
                                                                    <i class='far fa-eye' style="font-size: 12px; margin-left: 10px; color:green"></i>
                                                                </a>
                                                            </span>
                                                    <?php
                                                        }
                                                     ?>
                                                </td>
                                                <td data-label="Sửa" class="right__iconTable">
                                                    <a href="<?php echo _WEB_ROOT; ?>/edit-cate-prod/editid-<?php echo $cate_prod['id'] ?>">
                                                        <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-edit.svg" alt="">
                                                    </a>
                                                </td>
                                                <td data-label="Xoá" class="right__iconTable">
                                                    <a href="<?php echo _WEB_ROOT; ?>/delete-cate-prod/deleteid-<?php echo $cate_prod['id'] ?>"
                                                       onclick = "return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-trash-black.svg" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
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