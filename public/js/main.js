$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Phần này dùng đẻ call ajax
// Tạo 1 function DELETE

// function này sẽ có đối số là id và url, id là đối tượng được gọi và url là đường dẫn
// ajax sẽ gọi đến url này để nó truyền qua id
function Delete(id, url) {
    // Loại ajax này sẽ nguy hiểm nây sẽ nhắc lại người dùng chấc chắn hay chưa
    if(confirm("Bạn có thực sự muốn xóa danh mục này không?")){

        // Gọi ajax
        $.ajax({
            type: 'DELETE',
            datatype:JSON,
            data:{id},
            url:url,
            success:function (result){
                console.log(result);
                if(result.error == 'false'){
                    // Thông báo xóa thành công
                    alert(result.message);
                    location.reload();
                }
                else {
                    alert("Xóa danh mục không thành công");
                }
            }
        })
    }
}