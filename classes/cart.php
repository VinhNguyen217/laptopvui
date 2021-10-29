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
    public function add_to_cart($quantity,$id,$iduser)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link,$id);
        $query = "SELECT * FROM product WHERE id_product = $id";
        $result =  $this->db->select($query)->fetch_assoc();
        $check_cart = "SELECT * FROM carts WHERE id_product = '$id'  and  id_user = '$iduser' ";
        $check_cart = $this->db->select($check_cart);
        if($check_cart){
            $alert = '<script language="javascript">alert("Sản phẩm đã tồn tại trong giỏ hàng !!!"); </script>';
            echo $alert;
        }
        else {
            $query_insert = "INSERT INTO carts (id_product,quantity,id_user) VALUES('$id','$quantity','$iduser')";
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
    public function get_product_cart( $iduser)
    {
        
        $query = "SELECT * FROM carts   join product
                            ON carts.id_product = product.id_product
                            WHERE  carts.id_user = '$iduser ' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function num_product_cart( $id)
    {
        
        $query = "SELECT id_carts FROM carts
                            WHERE  id_user = $id  ";
        $result = $this->db->number($query);
        return $result;
    }
    public function update_quantity_cart($quantity,$cartid,$iduser)
    {
      
    }
    public function delete_product_cart($id,$iduser)
    {   
      
        $cartid = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM carts WHERE id_carts = $id  and  id_user = '$iduser'";
        $result = $this->db->delete($query);
        return $result;
       
    }
    public function update_qty_cart($productId,$qty)
    {
        $productId = $this->fm->validation($productId);
        $qty = $this->fm->validation($qty);

        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $qty = mysqli_real_escape_string($this->db->link,$qty);
        
        $query = "SELECT * FROM carts 
                            join product on carts.id_product = product.id_product        
                            WHERE carts.id_carts = $productId " ;
        $result =  $this->db->select($query);
        $result = $result->fetch_assoc();
        $_SESSION['total'] = $_SESSION['total'] - $result['price'] *$result['quantity'];

        $query = "UPDATE carts SET  quantity = '$qty' WHERE id_carts = $productId ";
        $result = $this->db->update($query);


        $query = "SELECT * FROM carts 
                            join product on carts.id_product = product.id_product        
                            WHERE carts.id_carts = $productId " ;
        $result =  $this->db->select($query); 
        $result_update = $result->fetch_assoc();
        $_SESSION['total'] = $_SESSION['total'] + $result_update['price'] * $result_update['quantity'];

        $query = "SELECT * FROM carts 
                            join product on carts.id_product = product.id_product        
                            WHERE carts.id_carts = $productId " ;
        $result =  $this->db->select($query); 
        
        return $result;
    }
    public function delete_prt_cart($item)
    {
        $query = "DELETE FROM carts WHERE id_carts = $item  ";
        $result = $this->db->delete($query);
        return $result;
    }
}

?>