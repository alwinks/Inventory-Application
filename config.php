<?php
class dboperation
{
    var $dbhost = 'localhost';
    var $dbuser = 'root';
    var $dbpass = '';
    var $db = 'inventory';

    // Function to check connection
    function dbconn()
    {
        $this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->db);
        return $this->conn;
    }

    // Function to execute query
    function dbexecute()
    {
        return mysqli_query($this->conn, $this->sql);
    }

    // Function to login admin
    function admin_login($admin_username, $admin_password)
    {
        $this->admin_username = $admin_username;
        $this->admin_password = $admin_password;
        $this->sql = "SELECT admin_id FROM tbl_admin WHERE admin_username='$this->admin_username' AND admin_password='$this->admin_password'";
    }

    // Function to register new user
    function user_register($user_username, $user_password)
    {
        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->sql = "INSERT INTO tbl_user (user_username,user_password) VALUES ('$this->user_username','$this->user_password')";
    }

    // Function to login user
    function user_login($user_username, $user_password)
    {
        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->sql = "SELECT user_id FROM tbl_user WHERE user_username='$user_username' AND user_password='$user_password'";
    }

    // Function to display products where stock above 0
    function product_display()
    {
        $this->sql = "SELECT * FROM tbl_product WHERE product_stock>0";
    }

    // Function to display all products
    function product_display_all()
    {
        $this->sql = "SELECT * FROM tbl_product";
    }

    // Function to add new product
    function product_add($product_name, $product_img, $product_desc, $product_rate, $product_stock)
    {
        $this->product_name = $product_name;
        $this->product_img = $product_img;
        $this->product_desc = $product_desc;
        $this->product_rate = $product_rate;
        $this->product_stock = $product_stock;
        $this->sql = "INSERT INTO tbl_product (product_name,product_img,product_desc,product_rate,product_stock) VALUES ('$this->product_name','$this->product_img','$this->product_desc','$this->product_rate','$this->product_stock')";
    }

    // Function to update product
    function product_update($product_id, $product_name, $product_img, $product_desc, $product_rate, $product_stock)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_img = $product_img;
        $this->product_desc = $product_desc;
        $this->product_rate = $product_rate;
        $this->product_stock = $product_stock;
        $this->sql = "UPDATE tbl_product SET product_name='$this->product_name',product_img='$this->product_img',product_desc='$this->product_desc',product_rate='$this->product_rate',product_stock='$this->product_stock' WHERE product_id='$this->product_id'";
    }

    // Function to display product details to update
    function product_update_display($product_id)
    {
        $this->product_id = $product_id;
        $this->sql = "SELECT * FROM tbl_product WHERE product_id='$product_id'";
    }

    // Function to delete product
    function product_delete($product_id)
    {
        $this->product_id = $product_id;
        $this->sql = "DELETE FROM tbl_product WHERE product_id='$this->product_id'";
    }

    // Function to add product to cart
    function cart_add($product_id, $user_id)
    {
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->sql = "INSERT INTO tbl_order (product_id,user_id,order_quantity,order_status) VALUES ('$this->product_id','$this->user_id','1','Cart')";
    }

    // Function to refresh cart as amount=quantity*rate
    function cart_refresh($user_id)
    {
        $this->user_id = $user_id;
        $this->sql = "UPDATE tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id SET tbl_order.order_amount=tbl_order.order_quantity*tbl_product.product_rate WHERE user_id='$this->user_id'";
    }

    // Function to display cart
    function cart_display($user_id)
    {
        $this->user_id = $user_id;
        $this->sql = "SELECT * FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id INNER JOIN tbl_user ON tbl_order.user_id=tbl_user.user_id WHERE tbl_user.user_id='$this->user_id' AND order_status='Cart'";
    }

    // Function to select quantity of order
    function quantity($order_id)
    {
        $this->order_id = $order_id;
        $this->sql = "SELECT tbl_order.order_quantity,tbl_product.product_stock FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id WHERE order_id='$this->order_id'";
    }

    // Function to increase quantity of order
    function quantity_inc($order_id)
    {
        $this->order_id = $order_id;
        $this->sql = "UPDATE tbl_order SET order_quantity=order_quantity+1 WHERE order_id='$this->order_id'";
    }

    // Function to decrease quantity of order
    function quantity_dec($order_id)
    {
        $this->order_id = $order_id;
        $this->sql = "UPDATE tbl_order SET order_quantity=order_quantity-1 WHERE order_id='$this->order_id'";
    }

    // Function to remove product from cart
    function cart_remove($order_id)
    {
        $this->order_id = $order_id;
        $this->sql = "DELETE FROM tbl_order WHERE order_id='$this->order_id'";
    }

    // Function to display total amount of orders
    function cart_total($user_id)
    {
        $this->sql = "SELECT SUM(order_amount) AS total FROM tbl_order WHERE user_id='$user_id' AND order_status='Cart'";
    }

    // Function to check if product already exists in cart
    function cart_check($product_id, $user_id)
    {
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->sql = "SELECT * FROM tbl_order WHERE order_status='Cart' AND product_id='$this->product_id' AND user_id='$this->user_id'";
    }

    // Function to display orders
    function order_display($user_id)
    {
        $this->user_id = $user_id;
        $this->sql = "SELECT * FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id INNER JOIN tbl_user ON tbl_order.user_id=tbl_user.user_id WHERE tbl_user.user_id='$this->user_id' AND tbl_order.order_status='Success'";
    }

    // Function to display orders of all users
    function order_display_all()
    {
        $this->sql = "SELECT * FROM tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id INNER JOIN tbl_user ON tbl_order.user_id=tbl_user.user_id WHERE tbl_order.order_status='Success'";
    }

    // Function to change status of order as 'Success'
    function order_success($user_id)
    {
        $this->user_id = $user_id;
        $this->sql = "UPDATE tbl_order SET order_status='Success' WHERE user_id='$this->user_id'";
    }

    // Function to decrease product stock after placing order
    function stock_dec($user_id)
    {
        $this->user_id = $user_id;
        $this->sql = "UPDATE tbl_order INNER JOIN tbl_product ON tbl_order.product_id=tbl_product.product_id SET tbl_product.product_stock=tbl_product.product_stock-tbl_order.order_quantity WHERE user_id='$this->user_id' AND order_status='Cart'";
    }

    // Function to add new card
    function card_add($user_id, $card_number, $card_cvc)
    {
        $this->user_id = $user_id;
        $this->card_number = $card_number;
        $this->card_cvc = $card_cvc;
        $this->sql = "INSERT INTO tbl_card (user_id,card_number,card_cvc) VALUES ('$this->user_id','$this->card_number','$this->card_cvc')";
    }

    // Function to display cards
    function card_display($user_id)
    {
        $this->user_id = $user_id;
        $this->sql = "SELECT card_id,card_number FROM tbl_card WHERE user_id='$this->user_id'";
    }

    // Function to delete card
    function card_delete($card_id)
    {
        $this->card_id = $card_id;
        $this->sql = "DELETE FROM tbl_card WHERE card_id='$card_id'";
    }

    // Function to validate card while placing order
    function card_validate($card_number, $card_cvc, $user_id)
    {
        $this->card_number = $card_number;
        $this->card_cvc = $card_cvc;
        $this->user_id = $user_id;
        $this->sql = "SELECT * FROM tbl_card WHERE card_number='$this->card_number' AND card_cvc='$this->card_cvc' AND user_id='$this->user_id'";
    }
}
