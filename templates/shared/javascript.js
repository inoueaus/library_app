$('.list-group-item').on('click', function(){
    var data = $(this).data('id');
    console.log(data);
    //simulate click
    window.location.href = "book.php?book_id=" + data;
});