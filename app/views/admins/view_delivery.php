<div class="right">
                    <div class="right__content">
                        <div class="right__title">Quản lý phí vận chuyển</div>
                        <p class="right__desc">Thêm phí vận chuyển</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="province">Chọn Tỉnh/Thành phố</label>
                                    <select name="province" id="province" class="choose province">
                                        <option disabled selected>---Chọn Tỉnh/Thành phố---</option>
                                        <?php 
                                            foreach ($list_province as $key => $province) {
                                        ?>
                                            <option value="<?php echo $province['id'] ?>">
                                                <?php echo $province['_name'] ?>
                                            </option>
                                        <?php 
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="district">Chọn Quận/Huyện</label>
                                    <select name="district" id="district" class="choose district">
                                        <option disabled selected>---Chọn Quận/Huyện---</option>

                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="ward">Chọn Xã/Phường</label>
                                    <select name="ward" id="ward" class="ward">
                                        <option disabled selected>---Chọn Xã/Phường---</option>

                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="fee_ship">Phí vận chuyển</label>
                                    <input type="text" value="" name="fee_ship" class="fee_ship">
                                </div>
                                <button class="btn add_delivery" type="button" name="add_delivery">
                                    Thêm phí vận chuyển
                                </button>
                            </form>
                        </div>

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
                                            <th width="30%">Tỉnh/Thành phố</th>
                                            <th width="30%">Quận/Huyện</th>
                                            <th width="25%">Xã/Phường/Thị trấn</th>
                                            <th width="15%">Phí ship</th>
                                            <th width="5%">Xoá</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody id="load_delivery">
                                            
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
        fetch_delivery();
        function fetch_delivery() {
            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/select-shipfee',
                method: 'POST',
                data: {
                },
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });
        }

        $(document).on('blur', '.fee_value', function(){
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text(); 
            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/update-delivery',
                method: 'POST',
                data:{
                    feeship_id:feeship_id,
                    fee_value:fee_value
                },
                success:function(data){
                    fetch_delivery();
                }
            })
        });

        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var id = $(this).val();
            var result = '';

            if(action == 'province'){
                result = 'district';
            }else{
                result = 'ward';
            }

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/select-delivery',
                method: 'POST',
                data: {
                    action:action,
                    id:id
                },
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });

        $('.add_delivery').click(function(){
            var province = $('.province').val();
            var district = $('.district').val();
            var ward = $('.ward').val();
            var fee_ship = $('.fee_ship').val();

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/insert-delivery',
                method: 'POST',
                data: {
                    province:province,
                    district:district,
                    ward:ward,
                    fee_ship:fee_ship
                },
                success:function(data){
                    alert('Thêm phí vận chuyển thành công');
                    fetch_delivery();
                }
            });
        });
    })
</script>

