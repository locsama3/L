<div class="right">
    <div class="right__content">
        <div class="right__title">Bảng điều khiển</div>
        <p class="right__desc">Xem đơn hàng</p>
        <div class="right__table">
            <div class="right__tableWrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt hàng</th>
                            <th>Xem/Xoá</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <?php 
                            $i = 0;
                            foreach ($list_order as $key => $order) {
                                $i++;
                         ?>
                        <tr>
                            <td data-label="STT"><?php echo $i ?></td>
                            <td data-label="Số hoá đơn"><?php echo $order['order_code'] ?></td>
                            <td data-label="Tổng"><?php echo $order['total'] ?></td>
                            <td data-label="Trạng thái">
                                <?php 
                                    if($order['status'] == 0){
                                        echo "Đang chờ xử lý";
                                    }elseif($order['status'] == 1){
                                        echo "Đang xử lý";
                                    }elseif($order['status'] == 2){
                                        echo "Đang giao";
                                    }elseif($order['status'] == 3){
                                        echo "Đã thanh toán! Hoàn thành!";
                                    }elseif($order['status'] == 4){
                                        echo "Đã hủy";
                                    }
                                 ?>
                            </td>
                            <td data-label="Ngày"><?php echo $order['create_at'] ?></td>
                            <td data-label="Xem/Xoá" class="right__confirm">
                                <a href="<?php echo _WEB_ROOT; ?>/view-order/order-<?php echo $order['id'] ?>" 
                                    class="right__iconTable">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-book.svg" alt="">
                                </a>
                                <a href="<?php echo _WEB_ROOT; ?>/delete-order/order-<?php echo $order['id'] ?>" 
                                    class="right__iconTable"
                                    onclick = "return alert('Bạn có chắc chắn muốn xóa đơn hàng?');">
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