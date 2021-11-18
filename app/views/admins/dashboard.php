<div class="right">
                <div class="right__content">
                    <div class="right__title">Bảng điều khiển</div>
                    <p class="right__desc">Bảng điều khiển</p>
                    <div class="right__cards">
                        <a class="right__card" href="<?php echo _WEB_ROOT; ?>/view-product">
                            <div class="right__cardTitle">Sản Phẩm</div>
                            <div class="right__cardNumber"><?php echo $total_product; ?></div>
                            <div class="right__cardDesc">Xem Chi Tiết <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-right.svg" alt=""></div>
                        </a>
                        <a class="right__card" href="#">
                            <div class="right__cardTitle">Khách Hàng</div>
                            <div class="right__cardNumber"><?php echo $total_customer; ?></div>
                            <div class="right__cardDesc">Xem Chi Tiết <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-right.svg" alt=""></div>
                        </a>
                        <a class="right__card" href="<?php echo _WEB_ROOT; ?>/view-cate-prod">
                            <div class="right__cardTitle">Danh Mục</div>
                            <div class="right__cardNumber">12</div>
                            <div class="right__cardDesc">Xem Chi Tiết <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-right.svg" alt=""></div>
                        </a>
                        <a class="right__card" href="<?php echo _WEB_ROOT; ?>/manage-order">
                            <div class="right__cardTitle">Đơn Hàng</div>
                            <div class="right__cardNumber"><?php echo $total_order; ?></div>
                            <div class="right__cardDesc">Xem Chi Tiết <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-right.svg" alt=""></div>
                        </a>
                    </div>
                    <div class="right__table">
                        <p class="right__tableTitle">Đơn hàng mới</p>
                        <div class="right__tableWrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Xem</th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                                    <?php 
                                        $i = 0;
                                        foreach ($lastest_order as $key => $order) {
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
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?php echo _WEB_ROOT; ?>/manage-order" class="right__tableMore"><p>Xem tất cả các đơn đặt hàng</p> 
                            <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-right-black.svg" alt="">
                        </a>
                    </div>
                </div>

                <!-- thống kê doanh số-->
                <div class="right__content">
                    <div class="right__title">Thống kê doanh số bán hàng</div>
                    <div class="right__formWrapper form-dashboard">
                        <form autocomplete="off">
                            <div class="right__inputWrapper">
                                <label for="fromday">Từ ngày</label>
                                <input type="text" id = "datepicker" value="" name="fromday">

                                <input class="btn" id="btn-dashboard-filter" type="button" name="filter" value="Lọc kết quả" />
                            </div>
                            <div class="right__inputWrapper">
                                <label for="today">Đến ngày</label>
                                <input type="text" id = "datepicker2" value="" name="today">                               
                            </div>
                            <div class="right__inputWrapper">
                                <label for="dashboard-filter">Lọc theo</label>
                                <select name="dashboard-filter" class="dashboard-filter">
                                    <option disable selected>--Chọn--</option>
                                    <option value="7ngay">7 ngày qua</option>
                                    <option value="thangtruoc">Tháng trước</option>
                                    <option value="thangnay">Tháng này</option>
                                    <option value="365ngayqua">365 ngày qua</option>
                                </select>
                            </div>
                            
                        </form>
                    </div>
                    <div class="right__table">
                        <div id="chart" style="height: 268px;"></div>
                    </div>
                </div>

                <!-- thống kê truy cập-->
                <div class="right__content">
                    <div class="right__title">Thống kê số lượt truy cập</div>
                    <div class="right__table">
                        <p class="right__tableTitle">Số lượt truy cập</p>
                        <div class="right__tableWrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Đang truy cập</th>
                                        <th>Tổng tháng trước</th>
                                        <th>Tổng tháng này</th>
                                        <th>Tổng một năm</th>
                                        <th>Tổng truy cập</th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                                    <tr>
                                        <td data-label="Đang truy cập">
                                            <?php echo $count_current; ?>
                                        </td>
                                        <td data-label="Tổng tháng trước">
                                            <?php echo $last_month_visitors; ?>
                                        </td>
                                        <td data-label="Tổng tháng này">
                                            <?php echo $this_month_visitors; ?>
                                        </td>
                                        <td data-label="Tổng một năm">
                                            <?php echo $oneyear_visitors; ?>
                                        </td>
                                        <td data-label="Tổng truy cập">
                                            <?php echo $total_visitors; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- thống kê sản phẩm, đơn hàng-->
                <div class="right__content">
                    <div class="right__title">Thống kê số lượng sản phẩm và đơn hàng</div>
                    <div class="right__statistic">
                        <div id="donutchart" class = "right__statistic--item" style="height: 268px;"></div>
                        <div class="right__table right__statistic--item">
                            <p class="right__tableTitle">Sản phẩm bán chạy</p>
                            <div class="right__tableWrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th style="text-align: left;">Tên sản phẩm</th>
                                            <th>Số lượng bán</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                        <?php 
                                            $i = 0;
                                            foreach ($product_selling as $key => $product) {
                                                $i++;
                                         ?>
                                        <tr>
                                            <td data-label="STT"><?php echo $i ?></td>
                                            <td data-label="Tên sản phẩm" style="text-align: left;">
                                                <?php echo $product['name']; ?>
                                            </td>
                                            <td data-label="Số lượt bán">
                                                <?php echo $product['product_sold']; ?>
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
</div>

<script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
          showOtherMonths: true,
          selectOtherMonths: true
        });

        $( "#datepicker2" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
          showOtherMonths: true,
          selectOtherMonths: true
        });

    });
</script>

<script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/backend/js/morris.min.js"></script>
<script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/backend/js/raphael-min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        chart30daysorder();

        var chart = new Morris.Bar({
          // id của biểu đồ
          element: 'chart',

          barColors:['#0E1731', '#CAA52A', '#79AF80', '#BD527B'],
          pointFillColors: ['#fff'],
          pointStrokeColors: ['black'],
          fillOpacity: 0.6,
          hideHover: 'auto',
          parseTime: false,

          // Tên của trục x. Giá trị gán với trục X
          xkey: 'period',
          // Những giá trị gắn với cột Y
          ykeys: ['order', 'sales', 'profit', 'quantity'],
          behaveLikeLine: true,
          // Labels for the ykeys -- will be displayed when you hover over the chart.
          labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
        });

        function chart30daysorder() {
            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/days-order',
                method: 'POST',
                dataType:'JSON',
                success:function(data){
                    chart.setData(data);
                }
            })
        }

        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/filter-by-select',
                method: 'POST',
                dataType:'JSON',
                data:{
                    dashboard_value:dashboard_value
                },
                success:function(data){
                    chart.setData(data);
                    console.log(data);
                }
            })
        })

        $('#btn-dashboard-filter').click(function(){
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/filter-by-date',
                method: 'POST',
                dataType:'JSON',
                data:{
                    from_date:from_date,
                    to_date:to_date
                },
                success:function(data){
                    chart.setData(data);
                }
            })
        })
    })
</script>

<!-- donut chart -->
<script type="text/javascript">
    $(document).ready(function(){
        var donut = Morris.Donut({
          element: 'donutchart',
          resize: true,
          colors: [
            '#CAA52A',
            '#BD527B',
            '#80DEEA'
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"Sản phẩm", value:<?php echo $total_product; ?>},
            {label:"Khách hàng", value:<?php echo $total_customer; ?>},
            {label:"Đơn hàng", value:<?php echo $total_order; ?>}
          ]
        });
    })
</script>