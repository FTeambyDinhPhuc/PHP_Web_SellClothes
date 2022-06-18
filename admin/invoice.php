<?php
include 'header.php';

$invoices = new Invoice();
$inv = $invoices->getInvoice(getGET('invoice_id'));
?>
<div class="container-fluid px-4">
    <h1 class="my-4">Quản lý hóa đơn</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Chi tiết hóa đơn
        </div>
        <div class="card-body">
            <table id="datatablesInvoiceDetail" class="table-responsive">
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Tên sản phẩm</th>
                        <th>Kích thước</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices->getInvoiceDetails(getGET('invoice_id')) as $k => $v) { ?>
                        <tr>
                            <td><?php echo $v['invoice_id']; ?></td>
                            <td><?php echo $v['product_name']; ?></td>
                            <td><?php echo $v['detail_product_size']; ?></td>
                            <td><?php echo $v['detail_product_quantity']; ?></td>
                            <td><?php echo formatPrice($v['detail_product_quantity'] * $v['product_price']); ?><span>đ</span></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'footer.php';
