<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Danh sách Mã giảm giá</p>
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
                                            <th width="30%">Tên giảm giá</th>
                                            <th width="20%">Mã giảm giá</th>
                                            <th width="20%">Trạng thái</th>
                                            <th width="15%">Mức giảm</th>
                                            <th width="15%">Số lượng</th>
                                            <th width="5%">Sửa</th>
                                            <th width="5%">Xoá</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            $i = 0;
                                            foreach ($list_coupon as $key => $coupon) {
                                                $i++;
                                         ?>
                                            <tr>
                                                <td data-label="STT"><?= $i ?></td>
                                                <td data-label="Tiêu đề">
                                                    <?= $coupon['name'] ?>
                                                </td>
                                                <td data-label="Mã">
                                                    <?php echo $coupon['code'] ?>
                                                </td>
                                                <td data-label="Trạng thái" class="right__iconTable">
                                                    <?php 
                                                        if($coupon['status'] == 1){
                                                        ?>  
                                                            <span>Đã kích hoạt</span>
                                                            <span class="success"> 
                                                                <a href="<?php echo _WEB_ROOT; ?>/unactive-coupon/unactid-<?php echo $coupon['id'] ?>">
                                                                    <i class='fas fa-check-circle' style="font-size: 12px; margin-top: 10px"></i>
                                                                </a>
                                                            </span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <span>Chưa kích hoạt</span>
                                                            <span class="error">
                                                                <a href="<?php echo _WEB_ROOT; ?>/active-coupon/actid-<?php echo $coupon['id'] ?>">
                                                                    <i class='far fa-check-circle' style="font-size: 12px; margin-top: 10px"></i>
                                                                </a>
                                                            </span>
                                                    <?php
                                                        }
                                                     ?>
                                                </td>
                                                <td data-label="Mức giảm">
                                                    <?php 
                                                        if($coupon['type'] == 0){
                                                    ?>  
                                                            <span><?php echo $coupon['value'] ?>%</span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <span>
                                                                <?php echo number_format($coupon['value'])?> đ 
                                                            </span>
                                                    <?php
                                                        }
                                                     ?>
                                                    
                                                </td>
                                                <td data-label="Số lượng">
                                                    <?php echo $coupon['amount'] ?>
                                                </td>
                                                <td data-label="Sửa" class="right__iconTable">
                                                    <a href="<?php echo _WEB_ROOT; ?>/edit-coupon/editid-<?php echo $coupon['id'] ?>">
                                                        <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-edit.svg" alt="">
                                                    </a>
                                                </td>
                                                <td data-label="Xoá" class="right__iconTable">
                                                    <a href="<?php echo _WEB_ROOT; ?>/delete-coupon/deleteid-<?php echo $coupon['id'] ?>"
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