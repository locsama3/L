// Xem hình ảnh trước khi upload
function previewImg() {
	$('.output').hide();
	// Gán giá trị các file vào biến files
	var files = document.getElementById('img_file').files; 

	$img_file = $('#img_file').val();
	// Cắt đuôi của file để kiểm tra
	$type_img_file = $('#img_file').val().split('.').pop().toLowerCase();

	var error = '';

	if(files.length > 5){
		error = 'Vui lòng chọn nhiều nhất năm ảnh.';

	}else if(files.length == null){
		error = 'Vui lòng chọn ít nhất một ảnh.';

	}else if(files.size > 2000000){
		error = 'Ảnh không được lớn hơn 2MB!';
	}else if($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1){
		error = 'File ảnh không hợp lệ với các đuôi .png, .jpeg, .jpg, .gif.';
	}

	if(error != ''){
		// Show khung kết quả
		$('.output').show();

		// Thông báo lỗi
		$('.output').html(error);

		$('#img_file').val('');
	}else{
		// Show khung chứa ảnh xem trước
		$('.box-preview-img').show();

		// Thêm chữ "Xem trước" vào khung
		$('.box-preview-img').html('<p>Xem trước</p>');

		// Hiện nút làm mới
		$('.btn-reset').show();

		// Dùng vòng lặp for để thêm các thẻ img vào khung chứa ảnh xem trước
		for (i = 0; i < files.length; i++){
			// Thêm thẻ img theo i
			$('.box-preview-img').append('<img class = "img_preview" src="" id="' + i +'">');

			// Thêm src vào mỗi thẻ img theo id = i
			$('.box-preview-img img:eq('+i+')').attr('src', URL.createObjectURL(event.target.files[i]));
		}
	}

}

// Nút reset form upload
$('.btn-reset').on('click', function() {
	$img_file = $('#img_file').val();
	$('#img_file').val('');
	// Làm trống khung chứa hình ảnh xem trước
	$('.box-preview-img').html('');

	// Hide khung chứa hình ảnh xem trước
	$('.box-preview-img').hide();

	// Hide khung hiển thị kết quả
	$('.output').hide();

		// Hide khung hiển thị kết quả
	$('.btn-reset').hide();
});

/*

//Xử lý ảnh và upload
$('.btn-submit').on('click', function() {
	// Gán giá trị của nút chọn tệp vào var img_file
	$img_file = $('#img_file').val();

	// Cắt đuôi của file để kiểm tra
	$type_img_file = $('#img_file').val().split('.').pop().toLowerCase();

	// Nếu không có ảnh nào
	if ($img_file == ''){
		// Show khung kết quả
		$('.output').show();

		// Thông báo lỗi
		$('.output').html('Vui lòng chọn ít nhất một file ảnh.');
	}else if ($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1){ 
		// Ngược lại nếu file ảnh không hợp lệ với các đuôi bên dưới
		// Show khung kết quả
		$('.output').show();

		// Thông báo lỗi
		$('.output').html('File ảnh không hợp lệ với các đuôi .png, .jpeg, .jpg, .gif.');
	}else{
		// Ngược lại
		// Tiến hành upload 
		$('').ajaxSubmit({ 
			// Trước khi upload
			beforeSubmit: function() {
				target:'.output',

				// Ẩn khung kết quả
				$('.output').hide();

				// Show thanh tiến trình
				$(".progress").show();

				// Đặt mặc định độ dài thanh tiến trình là 0
				$(".progress-bar").width('0');
			},

			// Trong quá trình upload
			uploadProgress: function(event, position, total, percentComplete){ 
				// Kéo dãn độ dài thanh tiến trình theo % tiến độ upload
				$(".progress-bar").css('width', percentComplete + '%');

				// Hiển thị con số % trên thanh tiến trình
				$(".progress-bar").html(percentComplete + '%');
			},

			// Sau khi upload xong
			success: function() {
				// Show khung kết quả 
				$('.output').show();

				// Thêm class success vào khung kết quả
				$('.output').addClass('success');

				// Thông báo thành công
				$('.output').html('Upload ảnh thành công.');
			},
			// Nếu xảy ra lỗi
			error : function() {
				// Show khung kết quả
				$('.output').show();

				// Thông báo lỗi
				$('.output').html('Không thể upload ảnh vào lúc này, hãy thử lại sau.');
			}
		}); 

		return false; 
	}
});

*/