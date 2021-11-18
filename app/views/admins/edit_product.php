                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Cập nhật sản phẩm</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/update-product/updt-<?php echo $product_by_id['id'] ?>" method="post" enctype="multipart/form-data">
                                <div class="right__inputWrapper">
                                    <label for="title">Tên sản phẩm</label>
                                    <input type="text" value="<?php echo $product_by_id['name'] ?>" name="product_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="title">Mã sản phẩm</label>
                                    <input type="text" value="<?php echo $product_by_id['slug'] ?>" name="product_slug">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="product_cate">Danh mục</label>
                                    <select name="product_cate">
                                        <option disabled="">Chọn danh mục</option>
                                        <?php 
                                            if($cate_prod){
                                                foreach ($cate_prod as $key => $cate) {
                                         ?>
                                        <option value="<?php echo $cate['id'] ?>"
                                                <?php 
                                                    if($cate['id'] == $product_by_id['id']){
                                                        echo "selected";
                                                    }
                                                 ?>
                                        >
                                            <?php echo $cate['cate_name'] ?>
                                        </option>
                                        <?php 
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="product_brand">Thương hiệu</label>
                                    <select name="product_brand">
                                        <option disabled>Chọn thương hiệu</option>
                                        <?php 
                                            if($brand){
                                                foreach ($brand as $key => $value) {
                                         ?>
                                            <option value="<?php echo $value['id'] ?>"
                                                <?php 
                                                    if($value['id'] == $product_by_id['id']){
                                                        echo "selected";
                                                    }
                                                 ?>
                                            >
                                                <?php echo $value['brand_name'] ?>
                                            </option>
                                        <?php 
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="thumbnail">Hình tiêu đề</label>
                                    <img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $product_by_id['thumbnail'] ?>" alt="" style="width: 100px;">
                                    <input type="file" name="thumbnail" id = "avt_file">
                                </div>
                                <!-- <div class="right__inputWrapper">
                                    <label for="image">Hình mô tả</label>
                                    <input type="file" name="desc_image[]" id = "img_file" multiple
                                            onchange="previewImg();" accept="image/*">
                                    <div class="box-preview-img"> </div>
                                    <button type="reset" class="btn-reset">Làm mới</button>
                                    <div class="output"></div>
                                </div> -->
                                <div class="right__inputWrapper">
                                    <label for="label">Nhãn sản phẩm</label>
                                    <select name="type">
                                        <option disabled>Nhãn sản phẩm</option>
                                        <?php 
                                            if($product_by_id['feature'] == 0){
                                         ?>
                                            <option value="0" selected>Thường</option>
                                            <option value="1">Nổi bật</option>
                                        <?php 
                                            }else{
                                         ?>
                                            <option value="0">Thường</option>
                                            <option value="1" selected>Nổi bật</option>
                                        <?php 
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="price">Giá sản phẩm</label>
                                    <input type="text" value="<?php echo $product_by_id['regular_price'] ?>" name="price">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="sale_price">Giá giảm sản phẩm</label>
                                    <input type="text" value="<?php echo $product_by_id['sale_price'] ?>" name="sale_price">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="quantity">Giá giảm sản phẩm</label>
                                    <input type="text" value="<?php echo $product_by_id['product_quantity'] ?>" name="quantity">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="status">Trạng thái</label>
                                    <select name="status">
                                        <option disabled>Ẩn/Hiện</option>
                                        <?php 
                                            if($product_by_id['best_seller'] == 0){
                                         ?>
                                            <option value="0" selected>Ẩn</option>
                                            <option value="1">Hiện</option>
                                        <?php 
                                            }else{
                                         ?>
                                            <option value="0">Ẩn</option>
                                            <option value="1" selected>Hiện</option>
                                        <?php 
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="short_desc">Mô tả</label>
                                    <textarea name="short_desc" id="ckeditor1" cols="30" rows="10">
                                        <?php echo $product_by_id['short_desc'] ?>
                                    </textarea>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="product_desc">Chi tiết sản phẩm</label>
                                    <textarea name="product_desc" id="ckeditor2" cols="30" rows="10" >
                                        <?php echo $product_by_id['description'] ?>
                                    </textarea>
                                </div>
                                <button class="btn" type="submit" name="product_add">Cập nhật sản phẩm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/load_image.js"></script>
