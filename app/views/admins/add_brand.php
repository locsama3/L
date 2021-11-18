<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thêm thương hiệu sản phẩm</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/save-brand" method="post" autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="brand_name">Tên thương hiệu</label>
                                    <input type="text" value="" name="brand_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="brand_desc">Mô tả thương hiệu</label>
                                    <textarea name="brand_desc" id="ckeditor1" cols="30" rows="10">
                                        
                                    </textarea>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="display">Hiển thị</label>
                                    <select name="display">
                                        <option disabled selected>Ẩn/Hiện</option>
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiện</option>
                                    </select>
                                </div>
                                <input class="btn" type="submit" name="add_brand" value="Thêm thương hiệu sản phẩm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
