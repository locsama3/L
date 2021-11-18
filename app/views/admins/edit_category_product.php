<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Cập nhật danh mục sản phẩm</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/update-cate-prod/update-<?php echo $cate_by_id['id'] ?>" method="post" autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="cate_name">Tên danh mục</label>
                                    <input type="text" value="<?php echo $cate_by_id['cate_name'] ?>" name="cate_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="desc">Mô tả</label>
                                    <textarea name="cate_desc" id="ckeditor1" cols="30" rows="10">
                                        <?php echo $cate_by_id['cate_slug'] ?>
                                    </textarea>
                                </div>
                                <input class="btn" type="submit" name="update_cate" value="Cập nhật danh mục sản phẩm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    CKEDITOR.replace( 'cate_desc' );
</script>