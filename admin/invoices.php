<?php
include 'header.php';

$invoices = new Invoice();
?>
<div class="container-fluid px-4">
    <h1 class="my-4">Quản lý hóa đơn</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Hóa đơn
        </div>
        <div class="card-body">
            <table id="datatablesInvoice" class="table-responsive">
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày lập</th>
                        <th>Tổng hóa đơn</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices->getInvoices(0, 0) as $k => $v) { ?>
                        <tr>
                            <td><?php echo $v['invoice_id']; ?></td>
                            <td><?php echo $v['user_full_name']; ?></td>
                            <td><?php echo $v['invoice_created_at']; ?></td>
                            <td><?php echo formatPrice($v['invoice_total_payment']); ?><span>đ</span></td>
                            <td><a href="invoice.php?invoice_id=<?php echo $v['invoice_id']; ?>" class="btn btn-primary w-75 mb-1">Xem chi tiết</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'footer.php';
