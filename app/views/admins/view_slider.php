<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Xem Slide</p>
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
                                            <th width="20%">Tên Slide</th>
                                            <th width="30%">Hình ảnh</th>
                                            <th width="20%">Mô tả</th>
                                            <th width="15%">Hiển thị</th>
                                            <th width="15%">Sửa/Xoá</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            $i = 0;
                                            foreach ($list_slider as $key => $slider) {
                                                $i++;
                                         ?>
                                            <tr>
                                                <td data-label="STT"><?= $i ?></td>
                                                <td data-label="Tiêu đề">
                                                    <?= $slider['slider_name'] ?>
                                                </td>
                                                <td data-label="Hình ảnh">
                                                    <img class="slider_admin" src="<?php echo _WEB_ROOT; ?>/public/uploads/slider/<?php echo $slider['slider_link'] ?>" alt=""/>
                                                </td>
                                                <td data-label="Mô tả">
                                                    <?php echo $slider['slider_desc'] ?>
                                                </td>
                                                <td data-label="Trạng thái" class="right__iconTable">
                                                    <?php 
                                                        if($slider['slider_status'] == 1){
                                                        ?>  
                                                            <span>Đang hiện</span>
                                                            <span> 
                                                                <a href="<?php echo _WEB_ROOT; ?>/unactive-slide/unactid-<?php echo $slider['slider_id'] ?>">
                                                                    <i class='far fa-eye-slash' style="font-size: 12px; margin-left: 10px; color:red"></i>
                                                                </a>
                                                            </span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <span>Đang ẩn</span>
                                                            <span>
                                                                <a href="<?php echo _WEB_ROOT; ?>/active-slide/actid-<?php echo $slider['slider_id'] ?>">
                                                                    <i class='far fa-eye' style="font-size: 12px; margin-left: 10px; color:green"></i>
                                                                </a>
                                                            </span>
                                                    <?php
                                                        }
                                                     ?>
                                                </td>
                                                <td data-label="Sửa/Xóa" class="right__iconTable">
                                                    <a href="<?php echo _WEB_ROOT; ?>/edit-slide/editid-<?php echo $slider['slider_id'] ?>">
                                                        <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-edit.svg" alt="">
                                                    </a>
                                                    <a href="<?php echo _WEB_ROOT; ?>/delete-slide/deleteid-<?php echo $slider['slider_id'] ?>"
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