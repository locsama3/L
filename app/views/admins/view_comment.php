<div class="right">
    <div class="right__content">
        <div class="right__title"><?php echo $title ?></div>
        <p class="right__desc"><?php echo $subtitle ?></p>
        <div class="right__table">
            <div class="right__tableWrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th width="20%">Tên người gửi</th>
                            <th width="35%">Bình luận</th>
                            <th width="20%">Ngày bình luận</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <?php 
                            $i = 0;
                            foreach ($list_comment as $key => $comment) {
                                $i++;
                         ?>
                        <tr>
                            <td data-label="STT"><?php echo $i ?></td>
                            <td data-label="Tên người gửi"><?php echo $comment['fullname']; ?>  </td>
                            <td data-label="Bình luận" class="admin_comment">
                                <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-sp/prodid-<?php echo $comment['product_id']; ?>"
                                class = "admin_comment_content">
                                    <?php echo $comment['content']; ?>
                                </a>
                                <span class="custom_reply">
                                    <button type="button" class="show_reply" data-comment_id = "<?php echo $comment['id_bl'] ?>"
                                        id = "show_<?php echo $comment['id_bl'] ?>"
                                    >
                                        <i class="fas fa-angle-down"></i>
                                    </button>
                                    <button type="button" class="hide_reply" data-comment_id = "<?php echo $comment['id_bl'] ?>" style = "display: none;"
                                        id = "hide_<?php echo $comment['id_bl'] ?>"
                                    >
                                        <i class="fas fa-angle-up"></i>
                                    </button>
                                </span>
                                <p class="admin_reply" id = "reply_<?php echo $comment['id_bl'] ?>">
                                    <textarea name="reply_content" id="reply_content_<?php echo $comment['id_bl'] ?>" rows="4" class="reply_content" placeholder = "Reply..."></textarea>
                                    <span class="reply_comment">
                                        <button type="button" class="btn-reply-comment" data-comment_id = "<?php echo $comment['id_bl'] ?>" data-prod_id = "<?php echo $comment['product_id'] ?>">Trả lời</button>
                                    </span>                               
                                </p>
                            </td>
                            <td data-label="Ngày bình luận">
                                <?php echo $comment['comment_day']; ?>
                            </td>
                            <td data-label="Trạng thái" id="status_<?php echo $comment['id_bl'] ?>">
                                <?php 
                                    if($comment['comment_status'] == 1){
                                ?>  
                                     <input type="button" value = "Đang hiện" class = "status_element_1 btn-status" 
                                     data-comment_id = "<?php echo $comment['id_bl'] ?>"
                                     data-comment_status = "0"
                                     id = "allow_<?php echo $comment['id_bl'] ?>">   
                                <?php
                                    }else{
                                ?>
                                    <input type="button" value = "Đang ẩn" class = "status_element_2 btn-status" 
                                     data-comment_id = "<?php echo $comment['id_bl'] ?>"
                                     data-comment_status = "1"
                                     id = "allow_<?php echo $comment['id_bl'] ?>"> 
                                <?php
                                    }
                                 ?>
                            </td>
                            <td data-label="Quản lý" class="right__confirm">
                                <a href="<?php echo _WEB_ROOT; ?>/view-child-comment/commentid-<?php echo $comment['id_bl'] ?>" 
                                    class="right__iconTable">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-book.svg" alt="">
                                </a>
                                <a href="<?php echo _WEB_ROOT; ?>/delete-comment/delid-<?php echo $comment['id_bl'] ?>"
                                   onclick = "return confirm('Bạn có chắc chắn muốn xóa?')"
                                class="right__iconTable">
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

<script type="text/javascript">
    $(document).ready(function(){
        // hiện reply comment
        $('.show_reply').click(function(){
            var comment_id = $(this).data('comment_id');
            $('#show_' + comment_id).hide();
            $('#hide_' + comment_id).show();

            $('#reply_' + comment_id).css('display','flex');
        });

        // ẩn reply comment
        $('.hide_reply').click(function(){
            var comment_id = $(this).data('comment_id');
            $('#hide_' + comment_id).hide();
            $('#show_' + comment_id).show();

            $('#reply_' + comment_id).css('display','none');
        });

        // ẩn hiện comment
        $('.btn-status').click(function(){
            var comment_id = $(this).data('comment_id');
            var status = $(this).data('comment_status');

            if(status == 0){
                $.ajax({
                    url: '<?php echo _WEB_ROOT; ?>/allow-comment',
                    method: 'POST',
                    data:{
                        comment_id:comment_id,
                        status:status
                    },
                    success:function(data){
                        $('#allow_'+comment_id).val('Đang ẩn');
                        $('#allow_'+comment_id).data('comment_status', '1');
                        $('#allow_'+comment_id).css('background','#ff343bd9');
                        alert('msg');
                    }
                })
            }else if(status == 1){
                $.ajax({
                    url: '<?php echo _WEB_ROOT; ?>/allow-comment',
                    method: 'POST',
                    data:{
                        comment_id:comment_id,
                        status:status
                    },
                    success:function(data){
                        $('#allow_'+comment_id).val('Đang hiện');
                        $('#allow_'+comment_id).data('comment_status', '0');
                        $('#allow_'+comment_id).css('background','#0eff85');
                        alert('msg');
                    }
                })
            }
            
        }) 

        // reply comment
        $('.btn-reply-comment').click(function(){
            var comment_id = $(this).data('comment_id');
            var prod_id = $(this).data('prod_id');
            var content = $('#reply_content_' + comment_id).val();

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/reply-comment',
                method: 'POST',
                data:{
                    comment_id:comment_id,
                    prod_id:prod_id,
                    content:content
                },
                success:function(data){
                    alert('Trả lời bình luận thành công!');
                    $('#reply_content_' + comment_id).val('');
                }
            })
        }) 
    })
</script>