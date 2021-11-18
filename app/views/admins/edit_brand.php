<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Cập nhật thương hiệu sản phẩm</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/update-brand/update-<?php echo $brand_by_id['id'] ?>" method="post" autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="brand_name">Tên thương hiệu</label>
                                    <input type="text" value="<?php echo $brand_by_id['brand_name'] ?>" name="brand_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="brand_desc">Mô tả</label>
                                    <textarea name="brand_desc" id="ckeditor1" cols="30" rows="10">
                                        <?php echo $brand_by_id['brand_desc'] ?>
                                    </textarea>
                                </div>
                                <input class="btn" type="submit" name="update_brand" value="Cập nhật thương hiệu sản phẩm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    CKEDITOR.replace( 'brand_desc' );
</script>