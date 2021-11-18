<div class="right">
                    <div class="right__content">
                        <div class="right__title">Chi tiết đơn hàng
                            <a class="right__desc print_order" 
                               href="<?php echo _WEB_ROOT; ?>/print-order/orderid-<?php 
                                            if(!empty($order_byId)){echo $order_byId['id'];}
                                     ?>"
                               target = "_blank"
                            >
                                In đơn hàng
                            </a>
                        </div>
                        <!-- Trạng thái đơn hàng -->
                        <p class="right__desc right_order">Cập nhật trạng thái đơn hàng</p> <br>
                        <div class="right__table">
                            <div class="right__tableWrapper">
                                <table>
                                    <tr style="font-size: 16px;">
                                        <td>Trạng thái đơn hàng</td>
                                        <td>
                                        <form>
                                            <select name="order_status" class = "order_status" 
                                                data-order_id = "<?php echo $order_byId['id'] ?>">
                                                <option value="0"
                                                    <?php 
                                                        if($order_byId['status'] == 0){
                                                            echo "Selected";
                                                        }elseif($order_byId['status'] == 3 || $order_byId['status'] == 2){
                                                            echo "Disabled";
                                                        }
                                                    ?>
                                                >
                                                    Đang chờ xử lý
                                                </option>

                                                <option value="1"
                                                    <?php 
                                                        if($order_byId['status'] == 1){
                                                            echo "Selected";
                                                        }elseif($order_byId['status'] == 3 || $order_byId['status'] == 2){
                                                            echo "Disabled";
                                                        }
                                                    ?>
                                                >
                                                    Đang xử lý
                                                </option>

                                                <option value="2"
                                                    <?php 
                                                        if($order_byId['status'] == 2){
                                                            echo "Selected";
                                                        }elseif($order_byId['status'] == 3){
                                                            echo "Disabled";
                                                        }
                                                    ?>
                                                >
                                                    Đang giao
                                                </option>

                                                <option value="3"
                                                    <?php 
                                                        if($order_byId['status'] == 3){
                                                            echo "Selected";
                                                        }
                                                    ?>
                                                >
                                                    Đã thanh toán! Hoàn thành
                                                </option>

                                                <option value="4"
                                                    <?php 
                                                        if($order_byId['status'] == 4){
                                                            echo "Selected";
                                                        }elseif($order_byId['status'] == 3){
                                                            echo "Disabled";
                                                        }
                                                    ?>
                                                >
                                                    Đã hủy
                                                </option>
                                            </select>
                                        </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- thông tin khách hàng -->
                        <p class="right__desc right_order">Thông tin khách hàng</p>
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
                                            <th>Tên khách hàng</th>
                                            <th>Email khách hàng</th>
                                            <th>Số điện thoại</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            if(!empty($order_byId)){
                                         ?>
                                        <tr>
                                            <td data-label="Tên khách hàng"><?php echo $order_byId['fullname'] ?></td>
                                            <td data-label="Email"><?php echo $order_byId['email'] ?></td>
                                            <td data-label="Số điện thoại"><?php echo $order_byId['cus_phone'] ?></td>
                                        </tr>
                                        <?php 
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Thông tin vận chuyển -->
                        <p class="right__desc right_order">Thông tin vận chuyển</p>
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
                                            <th>Tên người nhận</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Ghi chú đơn hàng</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            if(!empty($order_byId)){
                                         ?>
                                        <tr>
                                            <td data-label="Tên người nhận"><?php echo $order_byId['name'] ?></td>
                                            <td data-label="Địa chỉ"><?php echo $order_byId['address'] ?></td>
                                            <td data-label="Số điện thoại"><?php echo $order_byId['phone'] ?></td>
                                            <td data-label="Phương thức thanh toán">
                                                <?php echo $order_byId['payment_method'] ?>
                                            </td>
                                            <td data-label="Ghi chú"><?php echo $order_byId['order_note'] ?></td>
                                        </tr>
                                        <?php 
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- chi tiết sản phẩm -->
                        <p class="right__desc right_order">Chi tiết sản phẩm</p>
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
                                            <th width="15%">Số lượng</th>
                                            <th width="15%">Số lượng trong kho</th>
                                            <th width="10%">Giá SP</th>
                                            <th width="10%">Tổng tiền</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            if(!empty($list_prod_order)){
                                                $i = 0;
                                                $sub_total = 0;
                                                foreach ($list_prod_order as $key => $product) {
                                                    $i++;
                                                    $sub_total += $product['total'];
                                         ?>
                                        <tr>
                                            <td data-label="STT"><?php echo $i ?></td>

                                            <td data-label="Tên sản phẩm">
                                                <?php echo $product['name']; ?>  
                                            </td>
                                            
                                            <td data-label="Số lượng" class="order_prod_qty" 
                                            data-prod_id = "<?php echo $product['product_id']; ?>"
                                            data-order_id = "<?php echo $order_byId['id']; ?>"
                                            <?php 
                                                if($order_byId['status'] == 0 || $order_byId['status'] == 1){
                                                    echo "contenteditable";
                                                }
                                            ?>
                                            >
                                                <?php echo $product['quantity']; ?>  
                                            </td>

                                            <td data-label="Số lượng trong kho" class="order_qty_storage">
                                                <?php echo $product['product_quantity']; ?>  
                                            </td>

                                            <td data-label="Giá SP">
                                                <?php 
                                                    echo $product['regular_price'];
                                                 ?>
                                                 đ
                                            </td>
                                            <td data-label="Thành tiền">
                                                <?php 
                                                    echo $product['total'];
                                                 ?>
                                                 đ
                                            </td>
                                        </tr>
                                        <?php 
                                                }
                                            }
                                         ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-size: 16px; font-weight: bold;">
                                            <td colspan="5">Tổng cộng</td>
                                            <td>
                                                <span class="subtotal_orderdetail"><?php echo $sub_total; ?></span> 
                                            đ</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <p class="right__desc right_order">Mã giảm giá và phí ship</p>
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
                                            <th>Mã giảm giá</th>
                                            <th>Giá trị mã giảm giá</th>
                                            <th>Phí ship</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            if(!empty($coupon_and_ship)){
                                         ?>
                                        <tr>
                                            <td data-label="Mã giảm giá">
                                                <?php echo $coupon_and_ship['coupon'] ?>      
                                            </td>
                                            <td data-label="Giá trị mã giảm giá">
                                                <?php echo $coupon_and_ship['coupon_value'] ?>
                                                <?php 
                                                    if(!empty($coupon_and_ship['coupon_type'])){
                                                        if($coupon_and_ship['coupon_type'] == 1){
                                                            echo ' đ';
                                                        }else{
                                                            echo '%';
                                                        }
                                                    }
                                                 ?>
                                            </td>
                                            <td data-label="Phí ship"><?php echo $coupon_and_ship['fee_ship'] ?></td>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('.order_status').change(function(){
            var order_status = $(this).val();
            var order_id = $(this).data('order_id');

            //lay ra so luong
            var order_product_qty = new Array();
            var order_product_id = new Array();

            $('.order_prod_qty').each(function(){
                order_product_qty.push(Number($(this).text()));
                order_product_id.push($(this).data('prod_id'));
            });

            // đang làm tới đây! so sánh nếu số lượng đặt nhiều hơn số lượng trog kho thì ko cho đặt
            var order_qty = Number($(this).text());
            var order_qty_storage = $('.order_qty_storage').text();

            console.log(order_qty);
            console.log(order_qty_storage);

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/update-product-qty',
                method: 'POST',
                data:{
                    order_status:order_status,
                    order_id:order_id,
                    order_product_qty:order_product_qty,
                    order_product_id:order_product_id
                },
                success:function(data){
                    alert('cập nhật trạng thái đơn hàng thành công!');
                }
            })
        })
    })
</script>

<!-- Xử lý thay đổi số lượng sản phẩm đặt hàng khi đơn hàng đang chờ xử lý hoặc đang xử lý. giao rồi thì cút -->
<script type="text/javascript">
    $(document).on('blur', '.order_prod_qty', function(){
        var prod_id = $(this).data('prod_id');
        var order_id = $(this).data('order_id');
        var prod_qty = Number($(this).text()); 

        var product_warehouse = Number($(this).next().text());
        var price = $(this).next().next().text();
        var this_subtotal = $(this).next().next().next().text();
        var this_total = Number($('.subtotal_orderdetail').text());

        price = price.replace('đ','');
        this_subtotal = this_subtotal.replace('đ','');

        price = Number(price);
        this_subtotal = Number(this_subtotal);

        this_total = this_total - this_subtotal + price*prod_qty;

        $.ajax({
            url: '<?php echo _WEB_ROOT; ?>/update-qty-order',
            method: 'POST',
            data:{
                prod_id:prod_id,
                order_id:order_id,
                prod_qty:prod_qty
            },
            success:function(data){
                alert('Cập nhật số lượng sản phẩm đặt hàng thành công!');
                $(this).next().next().next().text(price*prod_qty + ' đ');
                $('.subtotal_orderdetail').text(this_total);
            }
        })
    });

</script>