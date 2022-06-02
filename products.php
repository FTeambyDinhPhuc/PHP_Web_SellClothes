<?php
include 'header.php';
?>
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item ml-5"> <a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" > <a href="products.php">Product</a></li>
        </ol>
    </nav>
    <div class="narrow text-left">
        <div class="col-12">
            <h3 class="heading">Living room</h3>
            <div class="heading-underline mr-auto ml-5"></div>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <nav class="sidebar">
                    <div class="text">Category</div>
                    <ul>
                        <?php
                        $productType = new ProductTypes();
                        foreach ($productType->getProductTypes() as $k => $v) {
                            echo '<li><a href="products.php?product_type_id=' . $v['product_type_id'] . '">' . $v['product_type_name'] . ' (' . $v['product_type_quantity'] . ')</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php
                    $product = new Product();
                    if (getGET('product_type_id'))
                        $products = $product->getProductsByProductTypeId(getGET('product_type_id'));
                    else
                        $products = $product->getProducts();
                    foreach ($products as $k => $v) {
                    ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="thumbnail">
                                <a class="card" href="product-details.php?product_id=<?php echo $v['product_id']; ?>">
                                    <img src="<?php echo $v['product_img']; ?>" class="card-img-top">
                                    <div class="card-body">
                                        <p style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" title="<?php echo $v['product_name']; ?>" class="name-product card-title"><?php echo $v['product_name']; ?></p>
                                        <p class="price-product card-text"><?php echo $v['product_price']; ?><span class="currency-symbol">&#160;VND</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>