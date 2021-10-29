<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../libraries/Database.php');
    require_once ($filepath.'/../helpers/format.php');
?>

<?php
class bill  
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
//xu ly them vao gio hang 
    public function get_product_pay($item)
    {
        $query = "SELECT * FROM carts  join product
                            ON carts.id_product = product.id_product
                            WHERE  carts.id_carts = $item ";
        $result = $this->db->select($query);
        return $result;
    }
    //thêm bill vào csdl 
    public function add_bill()
    {   
        $query_insert = "INSERT INTO bill (id_user,name_customer,address,phone,total_money) 
                            VALUES({$_SESSION['customer_id']},'{$_SESSION['customer_recriver']}','{$_SESSION['customer_phone']}','{$_SESSION['customer_address']}',{$_SESSION['total_pay']})";
        $insert_result = $this->db->insert($query_insert);
        return $insert_result;
    }
    //lấy id của cái bill ấy 
    public function get_id_bill()
    {

        $query = "SELECT * FROM bill where id_user = {$_SESSION['customer_id']} ORDER BY id_bill DESC LIMIT 1 ";
        $result = $this->db->select($query);
        return $result;
    }
    //thêm sản phảm mua hàng vào bill_detail
    public function add_product_bill($id_cart,$id_bill)
    {
        $query = "SELECT * FROM carts where id_carts = $id_cart ";
        $result = $this->db->select($query);
        $result_bill = $result->fetch_assoc();

        $query_insert = "INSERT INTO bill_detail (id_bill,id_product,amount) VALUES($id_bill,{$result_bill['id_product']},{$result_bill['quantity']})";
        $insert_result = $this->db->insert($query_insert);
        return $insert_result;
    }
   
   
}

?>