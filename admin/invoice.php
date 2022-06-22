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

<!-- <div class="container-fluid px-4 mt-5 row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h1>FTeam</h1>
                    <div>
                        <h2>Hóa đơn #<span>1</span></h2>
                        <p>ngày lập: <span>12/12/2022</span></p>
                    </div>
                </div>
                <hr />
                <div class="formto d-flex justify-content-between">
                    <div>
                        <h4>Từ:</h4>
                        <p>FTeam store colthes</p>
                        <p>Long Thạnh Mỹ, Quận 9</p>
                        <p>Thành phố Hồ Chí Minh</p>
                    </div>
                    <div>
                        <h4>Đến:</h4>
                        <p>Nguyễn khuyết danh</p>
                        <p>0392301230</p>
                        <p>Long Thạnh Mỹ, Quận 9,Thành phố Hồ Chí Minh</p>
                    </div>
                </div>
                <div>
                    <h4>Ghi chú:</h4>
                    <p>hihihihihihihihidhskfbnsdkfn</p>
                </div>

                <hr />
                <table class="table table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th> Tên sản phẩm</th>
                            <th> Size </th>
                            <th> Số lượng</th>
                            <th> Giá </th>
                            <th>Tổng tiền</th>
                        </tr>

                    </thead>

                    <tbody>
                        <tr>
                            <td> Áo plo</td>
                            <td>x</td>
                            <td>2</td>
                            <td>30000<span>đ</span></td>
                            <td>60000<span>đ</span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" align="right"><b>Tổng tiền</b></td>
                            <td>60000<span>đ</span></td>
                        </tr>
                    </tfoot>
                </table>
                <hr />
                <p>Phương thức thanh toán: <span>COD</span></p>
            </div>
        </div>
     
    </div>

    <div class="col-xl-4" id="groupBtnStatus">
        <div class="card" >
            <div class="card-body d-xl-flex flex-column justify-content-between">
                <button class="btn btn-success mb-xl-2">Xác nhận đơn hàng</button>
                <button class="btn btn-warning mb-xl-2">Hủy đơn hàng</button>
                <button id="btnPrintBill" class="btn btn-info mb-xl-2">In hóa đơn</button>
                <button class="btn btn-outline-dark" onclick="history.back()">Trở về</button>
            </div>
        </div>
    </div>

</div> -->
<?php
include 'footer.php';
