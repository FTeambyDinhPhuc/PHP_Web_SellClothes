<!--End-body-->
<!--Footer-->
<footer>
    <div class="container-fluid padding">
        <div class="row">
            <div class="col-md-4 mx-auto text-center">
                <h1>FTeam</h1>
                <p>Fashion is like the breath of life every day and it always changes with the flow of events. You can even see a revolutionary approach in clothing. You can see and feel everything with fashion.</p>
                <strong>Contact info</strong>
                <p>+84-399-128-713<br />fteam@gmail.com</p>
                <a href="#" target="_blank"> <i class="fab fa-facebook-square"></i></a>
                <a href="#" target="_blank"> <i class="fab fa-twitter-square"></i></a>
                <a href="#" target="_blank"> <i class="fab fa-instagram-square"></i></a>
            </div>
            <div class="col-10 mx-auto text-center">
                <hr class="light" />
                <p>Copyright 2022. Design by FTeam.</p>
            </div>
        </div>

    </div>
</footer>
<!--End-footer-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
<script src="assets/js/main.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    function numberWithDot(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    }

    function update_cart(product_id, cart_product_size, cart_product_quantity) {
        $.ajax({
            type: "POST",
            url: "http://fteam-api.phatdev.xyz/updateCart",
            data: `user_id=<?php echo $_SESSION['user_id']; ?>&product_id=${product_id}&cart_product_size=` + cart_product_size + '&cart_product_quantity=' + cart_product_quantity,
            success: function(result) {
                // $.notify("Cập nhật giỏ hàng thành công!", "success");
                $('#product_subtotal_' + product_id + '_' + cart_product_size).text(numberWithDot(cart_product_quantity * $('#product_price_' + product_id + '_' + cart_product_size).data('price')) + 'đ');
                // Cập nhật tạm tính
                var cart_subtotal = 0;
                $('.product_price').each(function() {
                    cart_subtotal += $(this).data("price") * $('#product_quantity_' + $(this).attr("id").replace('product_price_', '')).val();
                });
                $('#cart_subtotal').text(numberWithDot(cart_subtotal) + 'đ');
            }
        });
    }

    function del_cart(product_id, cart_product_size) {
        if (confirm('Bạn có muốn xoá sản phẩm này khỏi giỏ hàng?'))
            $.ajax({
                type: "POST",
                url: "http://fteam-api.phatdev.xyz/delCart",
                data: `user_id=<?php echo $_SESSION['user_id']; ?>&product_id=${product_id}&cart_product_size=` + cart_product_size,
                success: function(result) {
                    // $.notify("Cập nhật giỏ hàng thành công!", "success");
                    $('#product_' + product_id + '_' + cart_product_size).remove();
                    // Cập nhật tạm tính
                    var cart_subtotal = 0;
                    $('.product_price').each(function() {
                        cart_subtotal += $(this).data("price") * $('#product_quantity_' + $(this).attr("id").replace('product_price_', '')).val();
                    });
                    $('#cart_subtotal').text(numberWithDot(cart_subtotal) + 'đ');
                }
            });
        $('#product_' + product_id).remove();
    }
</script>
</body>

</html>