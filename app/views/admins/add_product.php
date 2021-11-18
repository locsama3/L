                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thêm sản phẩm</p>
                        <div class="right__formWrapper">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <form action="<?php echo _WEB_ROOT; ?>/save-product" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="right__inputWrapper">
                                    <label for="title">Tên sản phẩm</label>
                                    <input type="text" placeholder="Tên sản phẩm" name="product_name">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="title">Mã sản phẩm</label>
                                    <input type="text" placeholder="Mã sản phẩm" name="product_slug">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="product_cate">Danh mục</label>
                                    <select name="product_cate">
                                        <option disabled selected>Chọn danh mục</option>
                                        <?php 
                                            if($cate_prod){
                                                foreach ($cate_prod as $key => $cate) {
                                         ?>
                                        <option value="<?php echo $cate['id'] ?>">
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
                                        <option disabled selected>Chọn thương hiệu</option>
                                        <?php 
                                            if($brand){
                                                foreach ($brand as $key => $value) {
                                         ?>
                                        <option value="<?php echo $value['id'] ?>">
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
                                    <input type="file" name="thumbnail" id = "avt_file">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="image">Hình mô tả</label>
                                    <input type="file" name="desc_image[]" id = "img_file" multiple
                                            onchange="previewImg();" accept="image/*">
                                    <div class="box-preview-img"> </div>
                                    <button type="reset" class="btn-reset">Làm mới</button>
                                    <div class="output"></div>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="label">Nhãn sản phẩm</label>
                                    <select name="type">
                                        <option disabled selected>Nhãn sản phẩm</option>
                                        <option value="0">Thường</option>
                                        <option value="1">Nổi bật</option>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="price">Giá sản phẩm</label>
                                    <input type="text" placeholder="Giá sản phẩm" name="price">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="sale_price">Giá giảm sản phẩm</label>
                                    <input type="text" placeholder="Giá giảm sản phẩm" name="sale_price">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="quantity">Số lượng nhập</label>
                                    <input type="text" placeholder="Giá giảm sản phẩm" name="quantity">
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="status">Trạng thái</label>
                                    <select name="status">
                                        <option disabled selected>Ẩn/Hiện</option>
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiện</option>
                                    </select>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="short_desc">Mô tả</label>
                                    <textarea name="short_desc" id="ckeditor1" cols="30" rows="10" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="right__inputWrapper">
                                    <label for="product_desc">Chi tiết sản phẩm</label>
                                    <textarea name="product_desc" id="ckeditor2" cols="30" rows="10" placeholder="Chi tiết sản phẩm"></textarea>
                                </div>
                                <button class="btn" type="submit" name="product_add">Thêm sản phẩm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


