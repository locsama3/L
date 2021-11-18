<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thêm danh mục sản phẩm</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/save-cate-prod" method="post" autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="cate_name">Tên danh mục</label>
                                    <input type="text" value="" name="cate_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="desc">Mô tả</label>
                                    <textarea name="cate_desc" id="ckeditor1" cols="30" rows="10">
                                        
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
                                <input class="btn" type="submit" name="add_cate" value="Thêm danh mục sản phẩm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
