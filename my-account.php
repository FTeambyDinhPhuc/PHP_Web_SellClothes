<?php
include 'header.php';

$users = new User();
$user = $users->getUser($_SESSION['user_id']);
if ($_POST['submit']) {
    $users->updateUser($user['user_id'], getPOST('full_name'), $user['user_email'], getPOST('phone_number'), getPOST('address'));
    $users->updateSession($user['user_full_name'], $user['user_email']);
    $res = '<script>alert("Cập nhật thành công!");</script>';
    if (getPOST('pass')) {
        if ($user['user_password'] == $users->encryptedPassword(getPOST('pass'))) {
            if (getPOST('newpass'))
                if (getPOST('newpass') == getPOST('renewpass'))
                    $users->changePassword($user['user_id'], getPOST('newpass'));
                else $res = '<script>alert("Mật khẩu nhập lại không trùng khớp! Vui lòng thử lại!");</script>';
            else $res = '<script>alert("Mật khẩu mới không được trống! Vui lòng thử lại!");</script>';
        } else $res = '<script>alert("Mật khẩu cũ không chính xác! Vui lòng thử lại!");</script>';
    }
    echo $res;
    $user = $users->getUser($_SESSION['user_id']);
}
?>
<div class="bgAccountInformation py-4">
    <div class="container mx-auto shadow py-4 px-4">
        <div class="body-content">
            <h2 class="text-left">Account information</h2>
            <form method="post" action="">
                <div class="row mt-5">
                    <div class="col-md-6 pl-lg-5">
                        <div class="group-infor">
                            <h6>Họ tên</h6>
                            <input id="nameCustomer" type="text" class="" name="full_name" value="<?php echo $user['user_full_name']; ?>" required />
                        </div>
                        <div class="group-infor">
                            <h6>Mail</h6>
                            <input id="mailCustomer" type="email" class="" name="email" value="<?php echo $user['user_email']; ?>" disabled />
                        </div>
                        <div class="group-infor">
                            <h6>Số điện thoại</h6>
                            <input id="phonenumberCustomer" type="text" class="" name="phone_number" value="<?php echo $user['user_phone_number']; ?>" />
                        </div>
                        <div class="group-infor">
                            <h6>Địa chỉ</h6>
                            <input id="addresCustomer" type="text" class="" name="address" value="<?php echo $user['user_address']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 pl-lg-5">
                        <div class="group-infor">
                            <h6>Đổi mật khẩu</h6>
                            <div class="input-box">
                                <h6>Mật khẩu cũ</h6>
                                <input id="addresCustomer" type="password" class="" name="pass" />
                            </div>
                            <div class="input-box">
                                <h6>Mật khẩu mới</h6>
                                <input id="addresCustomer" type="password" class="" name="newpass" />
                            </div>
                            <div class="input-box">
                                <h6>Nhập lại mật khẩu mới</h6>
                                <input id="addresCustomer" type="password" class="" name="renewpass" />
                            </div>
                        </div>
                        <div class="group-button">
                            <input class="shadow-sm" type="submit" name="submit" value="Lưu" />
                            <input class="shadow-sm" type="reset" value="Huỷ" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>