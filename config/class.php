<?php
class DB
{
    protected $conn;
    function __construct()
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Không thể kết nối tới database!');
        mysqli_set_charset($conn, "utf8");
        $this->conn = $conn;
    }
    public function getConnection()
    {
        return $this->conn;
    }
    function __destruct()
    {
        mysqli_close($this->conn);
    }
    public function Offset($page = 1, $limit = DATA_PER_PAGE)
    {
        $page = mysqli_escape_string($this->conn, $page);
        if ($page < 1 || !is_numeric($page)) $page = 1;
        $offset = ' LIMIT ' . (($page - 1) *  $limit) . ',' .  $limit;
        return $offset;
    }
}
class User extends DB
{
    // $this->conn = $conn;
    public function validUser($username)
    {
        $username = mysqli_escape_string($this->conn, $username);
        $a = mysqli_query($this->conn, "SELECT * FROM user WHERE `user_email`='$username'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function encryptedPassword($password)
    {
        return md5($password);
    }
    public function login($email, $password)
    {
        $email = mysqli_escape_string($this->conn, $email);
        $pass = $this->encryptedPassword($password);
        $a = mysqli_query($this->conn, "SELECT * FROM user WHERE `user_email`='$email' AND `user_password`='$pass'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function register($user_fullname, $user_email, $user_password)
    {
        $user_fullname = mysqli_escape_string($this->conn, $user_fullname);
        $a = $this->validUser($user_email);
        if ($a == false) {
            $user_password = $this->encryptedPassword($user_password);
            $user_created_at = time();
            $b = mysqli_query($this->conn, "INSERT INTO user (`user_fullname`, `user_email`, `user_password`, `user_created_at`) 
                                                        VALUES ('$user_fullname', '$user_email', '$user_password', '$user_created_at')");
            if ($b)
                return true;
            else
                return false;
        } else return false;
    }
    public function getUser($user_id)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $a = mysqli_query($this->conn, "SELECT * FROM user WHERE `user_id`='$user_id'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a))
                $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function updateUser($user_id, $user_fullname, $user_email, $user_phone_number, $user_address, $user_bank_account_number = '', $user_bank_name = '')
    {
        $a = $this->getUser($user_id);
        if ($a != false) {
            $user_id = mysqli_escape_string($this->conn, $user_id);
            $user_fullname = mysqli_escape_string($this->conn, $user_fullname);
            $user_email = mysqli_escape_string($this->conn, $user_email);
            $user_phone_number = mysqli_escape_string($this->conn, $user_phone_number);
            $user_address = mysqli_escape_string($this->conn, $user_address);
            $user_bank_account_number = mysqli_escape_string($this->conn, $user_bank_account_number);
            $user_bank_name = mysqli_escape_string($this->conn, $user_bank_name);
            $b = mysqli_query($this->conn, "UPDATE users SET `user_fullname` = '$user_fullname', `user_email` = '$user_email', `user_phone_number` = '$user_phone_number', `user_address` = '$user_address',
															`user_bank_account_number` = '$user_bank_account_number', `user_bank_name` = '$user_bank_name' WHERE user_id = $user_id");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function changePassword($user_id, $user_password)
    {
        $a = $this->getUser($user_id);
        if ($a != false) {
            $user_id = mysqli_escape_string($this->conn, $user_id);
            $user_password = $this->encryptedPassword($user_password);
            $b = mysqli_query($this->conn, "UPDATE users SET `user_password` = '$user_password' WHERE user_id = $user_id");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function startSession($user)
    {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_fullname'] = $user['user_fullname'];
        $_SESSION['user_email'] = $user['user_email'];
        return true;
    }
    public function updateSession($user_fullname = '', $user_email = '')
    {
        if ($user_fullname != '') $_SESSION['user_fullname'] = $user_fullname;
        if ($user_email != '') $_SESSION['user_email'] = $user_email;
        return true;
    }
    public static function endSession()
    {
        // session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_fullname']);
        unset($_SESSION['user_email']);
    }
}
class ProductTypes extends DB
{
    public function getProductTypes()
    {
        $a = mysqli_query($this->conn, "SELECT PT.product_type_id, product_type_name, COUNT(PT.product_type_id) AS product_type_quantity FROM product_type PT LEFT JOIN products P ON PT.product_type_id = P.product_type_id GROUP BY PT.product_type_id");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
}
class Products extends DB
{
    private $productWithProductType = 'SELECT P.*, PT.product_type_name FROM products P LEFT JOIN product_type PT ON P.product_type_id = PT.product_type_id';
    private function orderBy($order_by)
    {
        $order_by = mysqli_escape_string($this->conn, $order_by);
        switch ($order_by) {
            case 1:
                return 'product_id DESC';
                break;
            case 2:
                return 'product_rental_price ASC';
                break;
            case 3:
                return 'product_rental_price DESC';
                break;
            default:
                return 'product_id DESC';
                break;
        }
    }
    public function getCount()
    {
        $total = mysqli_query($this->conn, "SELECT COUNT(product_id) AS total FROM products");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function validProduct($product_id)
    {
        $product_id = mysqli_escape_string($this->conn, $product_id);
        $a = mysqli_query($this->conn,  "SELECT product_id WHERE `product_id` = '$product_id'");
        if (mysqli_num_rows($a)) $b = true;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function getProducts($order_by = 1, $page = 1, $limit = DATA_PER_PAGE)
    {
        $order_by = $this->orderBy($order_by);
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn, $this->productWithProductType . ' ORDER BY ' . $order_by . ' ' . $offset);
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
    public function getProductById($product_id)
    {
        $product_id = mysqli_escape_string($this->conn, $product_id);
        $a = mysqli_query($this->conn, $this->productWithProductType . " WHERE `product_id` = '$product_id'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function getProductsByProductTypeId($product_type_id, $order_by = 1, $page = 1, $limit = DATA_PER_PAGE)
    {
        $product_type_id = mysqli_escape_string($this->conn, $product_type_id);
        $order_by = $this->orderBy($order_by);
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn,  $this->productWithProductType . " WHERE P.product_type_id = '$product_type_id' ORDER BY $order_by " . $offset);
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
    public function getCountProductsByProductTypeId($product_type_id)
    {
        $product_type_id = mysqli_escape_string($this->conn, $product_type_id);
        $total = mysqli_query($this->conn, "SELECT COUNT(product_id) AS total FROM products WHERE product_type_id = '$product_type_id'");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function postProduct($product_name, $product_type_id, $product_price, $product_rental_price, $product_img, $product_quantity, $product_sizes, $product_weight, $product_description)
    {
        $product_name = mysqli_escape_string($this->conn, $product_name);
        $product_type_id = mysqli_escape_string($this->conn, $product_type_id);
        $product_price = mysqli_escape_string($this->conn, $product_price);
        $product_rental_price = mysqli_escape_string($this->conn, $product_rental_price);
        $product_img = mysqli_escape_string($this->conn, $product_img);
        $product_quantity = mysqli_escape_string($this->conn, $product_quantity);
        $product_sizes = mysqli_escape_string($this->conn, $product_sizes);
        $product_weight = mysqli_escape_string($this->conn, $product_weight);
        $product_description = mysqli_escape_string($this->conn, $product_description);

        $b = mysqli_query($this->conn, "INSERT INTO products (`product_name`, `product_type_id`, `product_price`, `product_rental_price`, `product_img`, `product_quantity`, `product_sizes`, `product_weight`, `product_description`) 
													VALUES ('$product_name', '$product_type_id', '$product_price', '$product_rental_price', '$product_img', '$product_quantity', '$product_sizes', '$product_weight', '$product_description')");
        // var_dump(mysqli_error($this->conn));
        if ($b) return true;
        else return false;
    }
    public function updateProduct($product_id, $product_name, $product_type_id, $product_price, $product_rental_price, $product_img, $product_quantity, $product_sizes, $product_weight, $product_description)
    {
        $a = $this->getProductById($product_id);
        if ($a != false) {
            $product_id = mysqli_escape_string($this->conn, $product_id);
            $product_name = mysqli_escape_string($this->conn, $product_name);
            $product_type_id = mysqli_escape_string($this->conn, $product_type_id);
            $product_price = mysqli_escape_string($this->conn, $product_price);
            $product_rental_price = mysqli_escape_string($this->conn, $product_rental_price);
            $product_img = mysqli_escape_string($this->conn, $product_img);
            $product_quantity = mysqli_escape_string($this->conn, $product_quantity);
            $product_sizes = mysqli_escape_string($this->conn, $product_sizes);
            $product_weight = mysqli_escape_string($this->conn, $product_weight);
            $product_description = mysqli_escape_string($this->conn, $product_description);

            $b = mysqli_query($this->conn, "UPDATE products SET `product_name` = '$product_name', `product_type_id` = '$product_type_id', `product_price` = '$product_price', `product_rental_price` = '$product_rental_price', `product_img` = '$product_img',
				`product_quantity` = '$product_quantity', `product_sizes` = '$product_sizes', `product_weight` = '$product_weight', `product_description` = '$product_description' WHERE product_id = $product_id");
            if ($b) return true;
            else return false;
        } else return false;
    }
    public function search($keyword, $order_by = 1, $page = 1, $limit = DATA_PER_PAGE)
    {
        $keyword = mysqli_escape_string($this->conn, $keyword);
        $order_by = $this->orderBy($order_by);
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn, $this->productWithProductType . " WHERE MATCH(product_name) AGAINST ('$keyword') ORDER BY $order_by " . $offset);
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function getCountSearch($keyword)
    {
        $keyword = mysqli_escape_string($this->conn, $keyword);
        $total = mysqli_query($this->conn, "SELECT COUNT(product_id) AS total FROM products WHERE MATCH(product_name) AGAINST ('$keyword')");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
}
class Product extends Products
{
}
class Cart extends DB
{
    public function getCount($user_id)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $total = mysqli_query($this->conn, "SELECT COUNT(user_id) AS total FROM carts WHERE `user_id` = $user_id");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function getCart($user_id)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $a = mysqli_query($this->conn, "SELECT C.product_id, P.product_name, P.product_rental_price, P.product_img, P.product_quantity, P.product_weight, cart_product_quantity FROM carts C LEFT JOIN products P ON C.product_id = P.product_id WHERE `user_id` = '$user_id'");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
    public function postCart($user_id, $product_id, $cart_product_quantity)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $product_id = mysqli_escape_string($this->conn, $product_id);
        $cart_product_quantity = mysqli_escape_string($this->conn, $cart_product_quantity);
        $b = mysqli_query($this->conn, "INSERT INTO carts VALUES ('$user_id', '$product_id', '$cart_product_quantity') ON DUPLICATE KEY UPDATE cart_product_quantity = cart_product_quantity + $cart_product_quantity");
        if ($b) return true;
        else return false;
    }
    public function updateCart($user_id, $product_id, $cart_product_quantity)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $product_id = mysqli_escape_string($this->conn, $product_id);
        $cart_product_quantity = mysqli_escape_string($this->conn, $cart_product_quantity);
        $b = mysqli_query($this->conn, "UPDATE carts SET `cart_product_quantity` = '$cart_product_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'");
        if ($b) return true;
        else return false;
    }
    public function deleteCart($user_id, $product_id)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $product_id = mysqli_escape_string($this->conn, $product_id);
        $b = mysqli_query($this->conn, "DELETE FROM carts WHERE user_id = $user_id AND product_id = $product_id");
        if ($b) return true;
        else return false;
    }
    public function deleteCartsByUserId($user_id)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $b = mysqli_query($this->conn, "DELETE FROM carts WHERE user_id = $user_id");
        if ($b) return true;
        else return false;
    }
}
class Invoice extends DB
{
    public function getCount()
    {
        $total = mysqli_query($this->conn, "SELECT COUNT(invoice_id) AS total FROM invoices");
        $total = mysqli_fetch_assoc($total)['total'];
        return $total;
    }
    public function getInvoices($page = 1, $limit = DATA_PER_PAGE)
    {
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn, "SELECT invoice_id, invoice_user_fullname, invoice_user_phone_number, invoice_user_email, invoice_subtotal, invoice_fee_transport, invoice_fee_bond, invoice_status, invoice_created_at FROM invoices ORDER BY invoice_id DESC " . $offset);
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
    public function getInvoice($invoice_id)
    {
        $invoice_id = mysqli_escape_string($this->conn, $invoice_id);
        $a = mysqli_query($this->conn, "SELECT * FROM invoices WHERE `invoice_id` = '$invoice_id'");
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = $row;
        else $b = false;
        mysqli_free_result($a);
        return $b;
    }
    public function getInvoicesByUserId($user_id, $page = 1, $limit = DATA_PER_PAGE)
    {
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $offset = $this->Offset($page, $limit);
        $a = mysqli_query($this->conn, "SELECT invoice_id, invoice_user_fullname, invoice_user_phone_number, invoice_user_email, invoice_subtotal, invoice_fee_transport, invoice_fee_bond, invoice_status, invoice_created_at FROM invoices WHERE user_id = '$user_id' ORDER BY invoice_id DESC " . $offset);
        // $a = mysqli_query($this->conn, "SELECT * FROM invoices WHERE `user_id` = '$user_id' ORDER BY invoice_id DESC");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
    public function getInvoiceDetails($invoice_id)
    {
        $invoice_id = mysqli_escape_string($this->conn, $invoice_id);
        $a = mysqli_query($this->conn, "SELECT ID.product_id, P.product_name, P.product_img, invd_product_quantity, invd_product_rental_price FROM invoice_details ID LEFT JOIN products P ON ID.product_id = P.product_id WHERE `invoice_id` = '$invoice_id'");
        $b = array();
        if (mysqli_num_rows($a))
            while ($row = mysqli_fetch_assoc($a)) $b = array_merge($b, array($row));
        mysqli_free_result($a);
        return $b;
    }
    public function postInvoice($user_id, $invoice_user_fullname, $invoice_user_phone_number, $invoice_user_email, $invoice_user_address, $invoice_note)
    {
        $cart_subtotal = 0;
        $cart_weight = 0;
        $carts = new Cart;
        $cart = $carts->getCart($user_id);
        foreach ($cart as $k => $v) {
            $product_id = $v['product_id'];
            if ($v['cart_product_quantity'] > $v['product_quantity']) {
                $cart_product_quantity = $v['product_quantity'];
                $carts->updateCart($user_id, $product_id, $cart_product_quantity);
            } else $cart_product_quantity = $v['cart_product_quantity'];
            $cart_subtotal += $cart_product_quantity * $v['product_rental_price'];
            $cart_weight += $cart_product_quantity * $v['product_weight'];
        }
        $user_id = mysqli_escape_string($this->conn, $user_id);
        $invoice_user_fullname = mysqli_escape_string($this->conn, $invoice_user_fullname);
        $invoice_user_phone_number = mysqli_escape_string($this->conn, $invoice_user_phone_number);
        $invoice_user_email = mysqli_escape_string($this->conn, $invoice_user_email);
        $invoice_user_address = mysqli_escape_string($this->conn, $invoice_user_address);
        $invoice_note = mysqli_escape_string($this->conn, $invoice_note);

        $invoice_created_at = time();
        $a = mysqli_query($this->conn, "INSERT INTO invoices (user_id, invoice_user_fullname, invoice_user_phone_number, invoice_user_email, invoice_user_address, invoice_note, invoice_subtotal, invoice_created_at)
												VALUES ('$user_id', '$invoice_user_fullname', '$invoice_user_phone_number', '$invoice_user_email', '$invoice_user_address', '$invoice_note', '$cart_subtotal', '$invoice_created_at')");
        if ($a) {
            $invoice_id = mysqli_insert_id($this->conn);
            foreach ($cart as $k => $v) {
                $product_id = $v['product_id'];
                $invd_product_quantity = $v['cart_product_quantity'];
                $invd_product_rental_price = $v['product_rental_price'];
                mysqli_query($this->conn, "INSERT INTO invoice_details (invoice_id, product_id, invd_product_quantity, invd_product_rental_price)
																VALUES ('$invoice_id', '$product_id', '$invd_product_quantity', '$invd_product_rental_price')");
                mysqli_query($this->conn, "UPDATE products SET product_quantity = CASE WHEN product_quantity-$invd_product_quantity < 0 THEN 0 ELSE product_quantity-$invd_product_quantity END WHERE product_id = $product_id");
            }
            $carts->deleteCartsByUserId($user_id);
            return true;
        } else return false;
    }
    public function updateStatus($invoice_id, $invoice_status)
    {
        $invoice_id = mysqli_escape_string($this->conn, $invoice_id);
        $invoice_status = mysqli_escape_string($this->conn, $invoice_status);
        mysqli_query($this->conn, "UPDATE invoices SET invoice_status = '$invoice_status' WHERE invoice_id = $invoice_id");
    }
}
