<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../libraries/Database.php');
    require_once ($filepath.'/../helpers/format.php');
?>

<?php
class Cart  
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
//xu ly them vao gio hang 
    public function add_to_cart($quantity,$id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link,$id);
        $sId = session_id();
        $query = "SELECT * FROM product WHERE id_product = $id";
        $result =  $this->db->select($query)->fetch_assoc();
        $check_cart = "SELECT * FROM carts WHERE id_product = '$id' and sid = '$sId' ";
        $check_cart = $this->db->select($check_cart);
        if($check_cart){
            $alert = '<script language="javascript">alert("Sản phẩm đã tồn tại trong giỏ hàng !!!"); </script>';
            echo $alert;
        }
        else {
            $query_insert = "INSERT INTO carts (id_product,sid,quantity,id_user) VALUES('$id,','$sId','$quantity',1)";
            $insert_result = $this->db->insert($query_insert);
            if ($result) {
                $alert = '<script language="javascript">alert("Thêm  thành công !!!"); </script>';
                echo $alert;
            } else {
                $alert = '<script language="javascript">alert("thêm thất bại  Failed !!!"); </script>';
                echo $alert;
            }
        }
        
    }
    public function get_product_cart( $sId)
    {
        
        $query = "SELECT * FROM carts   join product
                            ON carts.id_product = product.id_product
                            WHERE carts.sid = '$sId'  ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($quantity,$cartid)
    {
        $sId = session_id();
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartid = mysqli_real_escape_string($this->db->link,$cartid);
        $query = "UPDATE carts SET 
        quantity = '$quantity'
        WHERE id_carts = $cartid and sid = '$sId'";
        $result = $this->db->update($query);
    }
    public function delete_product_cart($id)
    {   
        $sId = session_id();
        $cartid = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM carts WHERE id_carts = $id ";
        $result = $this->db->delete($query);
       
    }
}

?>