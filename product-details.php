<?php
include 'header.php';

$product = new Products();
$p = $product->getProductById(getGET('product_id'));
if ($p == false) {
?>
    báo lỗi không thấy.
<?php
} else {
?>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ml-5"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="products.php">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $p['product_name']; ?></li>
            </ol>
        </nav>

        <div class="product-details">
            <div class="row">
                <div class="col-md-2 col-lg-1 col-4">
                    <ul class="list__img-small">
                        <li>
                            <img src="<?php echo $p['product_img']; ?>" />
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 col-lg-4 mx-auto">
                    <div class="imgBox">
                        <img src="<?php echo $p['product_img']; ?>" />
                    </div>
                </div>
                <div class="col-md-4 mx-auto">
                    <h1 class="tilte-category"><span class="name-product"><?php echo $p['product_name']; ?></span></h1>
                    <h1 class="price-product"><?php echo formatPrice($p['product_price']); ?> <span>&nbsp;VND</span></h1>
                    <hr class="light" />
                    <h5>Describe</h5>
                    <p><?php echo str_replace("\n", '<br/>', $p['product_detail']); ?></p>

                    <h5>Size</h5>
                    <div class="btn-group mr-2 btn-group-size" role="group" aria-label="Basic example">
                        <!-- <button type="button" class="btn btn-outline-secondary ">S</button> -->
                        <?php
                        foreach (explode('|', $p['product_size']) as $k => $v) {
                            echo '<button type="button" class="btn btn-outline-secondary ">' . $v . '</button>';
                        }
                        ?>
                    </div>
                    <h5>quantity</h5>
                    <div class="btn-quantity shadow-sm">
                        <span class="minus">-</span>
                        <span class="num">01</span>
                        <span class="plus">+</span>
                    </div>

                    <button class="btn btn-warning btn-addtocart shadow my-4">Add to cart</button>

                </div>
            </div>
        </div>
    </div>
<?php
}
include 'footer.php';
?>