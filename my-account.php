<?php
include 'header.php';
?>
<div class="bgAccountInformation py-4">
    <div class="container mx-auto shadow py-4 px-4">
        <div class="body-content">
            <h2 class="text-left">Account information</h2>
            <div class="row mt-5">
                <div class="col-md-6 pl-lg-5">
                    <div class="group-infor">
                        <h6>Tên người dùng</h6>
                        <input id="nameCustomer" type="text" class="" />
                    </div>
                    <div class="group-infor">
                        <h6>Mail</h6>
                        <input id="mailCustomer" type="email" class="" />
                    </div>
                    <div class="group-infor">
                        <h6>Số điện thoại</h6>
                        <input id="phonenumberCustomer" type="tel" class="" />
                    </div>
                    <div class="group-infor">
                        <h6>Địa chỉ</h6>
                        <div class="input-box">
                            <h6>Tỉnh/Thành phố</h6>
                            <select class="form-control" id="dob-province">
                                <option selected>Hồ Chí Minh</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <h6>Quận/Huyện</h6>
                            <select class="form-control" id="dob-district">
                                <option selected>Quận 9</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <h6>Xã/Phường/Thị trấn</h6>
                            <select class="form-control" id="dob-commune">
                                <option selected>Long thạnh mỹ</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <h6>Địa chỉ</h6>
                            <input id="addresCustomer" type="text" class="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-lg-5">
                    <div class="group-infor">
                        <h6>Đổi mật khẩu</h6>
                        <div class="input-box">
                            <h6>Mật khẩu cũ</h6>
                            <input id="addresCustomer" type="password" class="" />
                        </div>
                        <div class="input-box">
                            <h6>Mật khẩu mới</h6>
                            <input id="addresCustomer" type="password" class="" />
                        </div>
                        <div class="input-box">
                            <h6>Nhập lại mật khẩu mới</h6>
                            <input id="addresCustomer" type="password" class="" />
                        </div>
                    </div>
                    <div class="group-button">
                        <input class="shadow-sm" type="submit" value="Lưu" />
                        <a class=" shadow-sm" href="@Url.Action(" Index","Home")">Hủy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>