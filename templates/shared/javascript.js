$('.list-group-item').on('click', function(){
    var data = $(this).data('id');
    console.log(data);
    //simulate click
    window.location.href = "templates/book?book_id=" + data;
});