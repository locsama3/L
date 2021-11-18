<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thêm Slider</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/save-slide" method="post" autocomplete="off" 
                                enctype="multipart/form-data">
                                <div class="right__inputWrapper">
                                    <label for="slider_name">Tên Slide</label>
                                    <input type="text" value="" name="slider_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="slider_link">Hình tiêu đề</label>
                                    <input type="file" name="slider_link" id = "avt_file">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="slider_desc">Mô tả Slide</label>
                                    <textarea name="slider_desc" id="ckeditor1" cols="30" rows="10">
                                        
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
                                <input class="btn" type="submit" name="add_slide" value="Thêm Slide" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
