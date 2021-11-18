<div class="right">
    <div class="right__content">
        <div class="right__title">Quản lý bình luận</div>
        <p class="right__desc">Danh sách sản phẩm và số lượt bình luận</p>
        <div class="right__table">
            <div class="right__tableWrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th width="35%">Tên sản phẩm</th>
                            <th width="20%">Hình ảnh</th>
                            <th>Số lượt bình luận</th>
                            <th>Xem chi tiết</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <?php 
                            $i = 0;
                            foreach ($list_product_comment as $key => $product) {
                                $i++;
                         ?>
                        <tr>
                            <td data-label="STT"><?php echo $i ?></td>
                            <td data-label="Tên sản phẩm"><?php echo $product['name']; ?>  </td>
                            <td data-label="Hình ảnh">
                                <img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $product['thumbnail'] ?>" alt="" style = "width: 100%;"/>
                            </td>
                            <td data-label="Số lượt bình luận">
                                <?php echo $product['soluotbl']; ?>
                            </td>
                            <td data-label="Chi tiết" class="right__confirm">
                                <a href="<?php echo _WEB_ROOT; ?>/view-comment/prodid-<?php echo $product['product_id'] ?>" 
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
        </div>
    </div>
</div>