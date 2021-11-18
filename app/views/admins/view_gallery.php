<div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thư viện ảnh</p>
                        <div class="right__table">
                            <span class="success" style="font-size: 18px">
                                <?php 
                                    $message = Session::flash('message');
                                    if($message){
                                        echo $message;
                                    }
                                ?>
                            </span>
                            <div class="right__inputWrapper gallery_add">
                                <form action="<?php echo _WEB_ROOT; ?>/save-gallery/prodid-<?php echo $prod_id ?>"
                                method = "POST" enctype = "multipart/form-data">
                                    <input type="hidden" value="<?php echo $prod_id ?>" name = "prod_id" class = "prod_id">
                                    <input type="hidden" name="token" value="<?php echo substr(md5(time()), 0, 5) ?>">
                                    <label for="image">Thêm ảnh mới</label>
                                    <input type="file" name="desc_image[]" id = "img_file" multiple
                                            onchange="previewImg();" accept="image/*">
                                    <div class="box-preview-img"> </div>
                                    <button type="reset" class="btn-reset">Làm mới</button>
                                    <div class="output"></div>
                                    <input type="submit" name="add_images" value="Tải ảnh" class="add_images">
                                </form>
                            </div>
                            <div class="right__tableWrapper"> 
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%">STT</th>
                                            <th width="20%">Tên Ảnh</th>
                                            <th width="30%">Hình ảnh</th>
                                            <th width="10%">Xoá</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="load_gallery">
                                        <?php 
                                            $i = 0;
                                            foreach ($list_gallery as $key => $gallery) {
                                                $i++;
                                         ?>
                                            <tr>
                                                <td data-label="STT"><?= $i ?></td>

                                                <td data-label="Tiêu đề" contenteditable class="edit-gallery-name"
                                                    data-gal_id = "<?php echo $gallery['gallery_id'] ?>">
                                                    <?= $gallery['gallery_name'] ?>
                                                </td>

                                                <td data-label="Hình ảnh">
                                                    <img style="width: 68%" class="img-gallery" src="<?php echo _WEB_ROOT; ?>/public/uploads/product_gallery/<?php echo $gallery['image_url'] ?>" alt=""/>
                                                    <input type="file" class="file_image" style="width: 30%;"
                                                    data-gal_id = "<?php echo $gallery['gallery_id'] ?>"
                                                    id = "file-<?php echo $gallery['gallery_id'] ?>" 
                                                    name = "file_image" accept = "image/*">
                                                </td>
                                                
                                                <td data-label="Xóa" class="right__iconTable">
                                                    <a onclick = "return confirm('Bạn có chắc chắn muốn xóa?')"
                                                       class = "delete_gallery" data-gal_id = "<?php echo $gallery['gallery_id'] ?>">
                                                        <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-trash-black.svg" alt="">
                                                    </a>
                                                    
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

<!-- Xử lý gallery -->
<script type="text/javascript">
    $(document).ready(function(){
        // load_gallery();

        function load_gallery() {
            var prod_id = $('.prod_id').val();

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/load-gallery',
                method: 'post',
                data:{
                    prod_id:prod_id
                },
                success:function(data){
                    $('#load_gallery').html(data);
                }
            });
        }

        $('.edit-gallery-name').blur(function(){
            var gal_id = $(this).data('gal_id');
            var gal_name = $(this).text().trim();

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/update-gallery-name',
                method: 'post',
                data:{
                    gal_id:gal_id,
                    gal_name:gal_name
                },
                success:function(data){
                    alert('Cập nhật mô tả hình ảnh thành công!');
                }
            });
        });

        // delete gallery
        $('.delete_gallery').click(function(){
            var gal_id = $(this).data('gal_id');

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/delete-gallery',
                method: 'post',
                data:{
                    gal_id:gal_id,
                },
                success:function(data){
                    alert('Xóa hình ảnh thành công!');
                    load_gallery();
                }
            });
        })

        // update gallery
        $('.file_image').change(function(){
            var gal_id = $(this).data('gal_id');
            var image = document.getElementById('file-'+gal_id).files[0];

            var form_data = new FormData();

            form_data.append('file_image', image);
            form_data.append('gal_id', gal_id);

            console.log(gal_id);

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/update-gallery',
                method: 'post',
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    alert('Cập nhật hình ảnh thành công!');
                    load_gallery();
                }
            });
        })
    })
</script>
