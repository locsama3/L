<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thêm Mã giảm giá</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/save-coupon" method="post" autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="coupon_code">Mã giảm giá</label>
                                    <input type="text" value="" name="coupon_code">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="coupon_name">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="coupon_amount">Số lượng mã giảm giá</label>
                                    <input type="text" name="coupon_amount">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="coupon_type">Loại mã</label>
                                    <select name="coupon_type">
                                        <option disabled selected>Phần trăm/Số tiền</option>
                                        <option value="0">Giảm theo phần trăm</option>
                                        <option value="1">Giảm theo số tiền</option>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="coupon_reduce">Nhập số phần trăm hoặc số tiền giảm</label>
                                    <input type="text" name="coupon_reduce">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="coupon_date">Ngày hết hạn</label>
                                    <input type="datetime-local" name="coupon_date">
                                </div>
                                <input class="btn" type="submit" name="add_coupon" value="Thêm mã giảm giá" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
