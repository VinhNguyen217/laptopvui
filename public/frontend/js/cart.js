$('input.change-qty').change(function(){
    var productId = $(this).data('product_id');
    var qty = $(this).val(); 
    $.ajax({
        url: './classes/update_cart.php',
        method: 'GET',
        data: {productId: productId, qty: qty},
        success: function(data){
            var array = data.split("-"); 
            $(`td.price-${productId}`).html(array[0]);
            $(".cart-total-price").html(array[1]);
         
        }
    })
    
})
