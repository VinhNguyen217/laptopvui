<?php
 $filepath = realpath(dirname(__FILE__));
 require_once ($filepath.'/../libraries/Database.php');
 require_once ($filepath.'/../helpers/format.php');
?>

<?php
class Product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_product($data, $files)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['productName']);
        $id_producer = mysqli_real_escape_string($this->db->link, $data['category']);
        $id_product_type = mysqli_real_escape_string($this->db->link, $data['productType']);
        $detail = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $amount = mysqli_real_escape_string($this->db->link, $data['amount']);
        $top = mysqli_real_escape_string($this->db->link, $data['top']);
        $new = mysqli_real_escape_string($this->db->link, $data['new']);

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $files['image']['name'];
        $file_temp = $files['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../uploads/" . $unique_image;

        if ($id_producer == "----------Select Category----------" || $id_product_type == "--------Select Product Type--------" || $detail == "") {
            $alert = '<span style="color:red">Fields must be not empty</span>';
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO product(id_product,id_producer,id_product_type,name,price,amount,detail,image,top,new,status) VALUES(null,$id_producer,$id_product_type,'$name',$price,$amount,'$detail','$unique_image',$top,$new,1)";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = '<script language="javascript">alert("Save Successfully !!!"); window.location="product_add.php";</script>';
                return $alert;
            } else {
                $alert = '<script language="javascript">alert("Save Failed !!!"); window.location="product_add.php";</script>';
                return $alert;
            }
        }
    }

    // /**
    //  * Kiểm tra tên danh mục có tồn tại hay không , nếu có => return true,nếu không => return false
    //  */
    // public function check_category($category_name)
    // {
    //     $category_name = $this->fm->validation($category_name);

    //     $category_name = mysqli_real_escape_string($this->db_category->link, $category_name);

    //     $query = "SELECT * FROM producer WHERE name = '$category_name'";
    //     $result = $this->db_category->select($query);

    //     if ($result == false) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    /**
     * Hiển thị danh sách sản phẩm
     */
    public function show_product()
    {
        $query = "
        SELECT product.* , producer.name as producer_name , product_type.name as product_type_name
        FROM product INNER JOIN producer ON product.id_producer = producer.id_producer
        INNER JOIN product_type ON product.id_product_type = product_type.id_product_type
        ORDER BY product.id_product DESC";

        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Trả về 1 sản phẩm khi biết id
     */
    public function getProductById($id)
    {
        $query = "SELECT * FROM product WHERE id_product = $id";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['productName']);
        $id_producer = mysqli_real_escape_string($this->db->link, $data['category']);
        $id_product_type = mysqli_real_escape_string($this->db->link, $data['productType']);
        $detail = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $amount = mysqli_real_escape_string($this->db->link, $data['amount']);
        $top = mysqli_real_escape_string($this->db->link, $data['top']);
        $new = mysqli_real_escape_string($this->db->link, $data['new']);

        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $files['image']['name'];
        $file_temp = $files['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../uploads/" . $unique_image;

        if ($id_producer == "----------Select Category----------" || $id_product_type == "--------Select Product Type--------" || $detail == "") {
            $alert = '<span style="color:red">Fields must be not empty</span>';
            return $alert;
        } else {
            if (!empty($file_name)) {
                //Nếu người dùng muốn chọn ảnh
                if (in_array($file_ext, $permited) === false) {
                    $alert = '<span style="color:red">You can upload only:' . implode(', ', $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE product SET 
                id_producer = '$id_producer',
                id_product_type = '$id_product_type',
                name = '$name',
                price = $price,
                amount = $amount,
                detail = '$detail',
                image = '$unique_image',
                top = $top,
                new = $new
                WHERE id_product = $id";
            } else {
                // Nếu người dùng ko chọn
                $query = "UPDATE product SET 
                id_producer = '$id_producer',
                id_product_type = '$id_product_type',
                name = '$name',
                price = $price,
                amount = $amount,
                detail = '$detail',
                top = $top,
                new = $new
                WHERE id_product = $id";
            }

            $result = $this->db->update($query);
            if ($result) {
                $alert = '<script language="javascript">alert("Update Successfully !!!"); window.location="product_edit.php";</script>';
                return $alert;
            } else {
                $alert = '<script language="javascript">alert("Update Failed !!!"); window.location="product_edit.php";</script>';
                return $alert;
            }
        }
    }

    public function delete_product($id)
    {
        $query = "DELETE FROM product WHERE id_product = $id";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<script language="javascript">alert("Product Deleted Successfully !!!"); window.location="product.php";</script>';
            return $alert;
        } else {
            $alert = '<script language="javascript">alert("Product Deleted Not Successfully !!!"); window.location="product.php";</script>';
            return $alert;
        }
    }
    //lây sản phâm hot
    public function get_product($adr,$id,$name,$nums)
    {
        $query = "SELECT *  FROM $adr WHERE $name = $id ORDER BY id_product DESC LIMIT $nums ";
        $result = $this->db->select($query);
        return $result;
    }

    // lây sản phâm theo danh muc 
    public function get_products($adr,$id,$name,$item_per_page,$offset)
    {
        $query = "SELECT *  FROM $adr WHERE $name = $id ORDER BY id_product DESC LIMIT $item_per_page OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }
    //lây sản pam theo nhu cau cua danh muc
    public function get_productss($adr,$id,$name,$item_per_page,$offset)
    {
        $query = "SELECT *  FROM $adr WHERE $name = $id ORDER BY id_product DESC LIMIT $item_per_page OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }
    // lay chi tiet san pham theo id
    public function  get_product_preview ($id) {
        $query = "SELECT *  FROM product 
                        join producer on product.id_producer = producer.id_producer 
                        join product_type on product.id_product_type = product_type.id_product_type 
                         WHERE id_product = $id";
        $result = $this->db->delete($query);
        return $result;
    }
    // lay danh muc
    public function  get_category ($adr) {
        $query = "SELECT *  FROM $adr ";
        $result = $this->db->select($query);
        return $result;
    }
    // lay nhu cau theo danh muc
    public function  get_demand ($id) {
        $query = "SELECT  DISTINCT product.id_product_type,product.id_producer,product_type.nameProductType FROM product 
                    join product_type on product.id_product_type = product_type.id_product_type 
                    WHERE id_producer= $id";
        $result = $this->db->select($query);
        return $result;
    }
    //Lay sản pham theo danh muc
    public function  get_products_cat ($adr,$id,$name) {
        $query = "SELECT *  FROM $adr where $name = $id ";
        $result = $this->db->number($query);
        return $result;
    }

}
   
   

?>