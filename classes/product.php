<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
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

    /**
     * Thêm sản phẩm 
     */
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
            $query = "INSERT INTO product(id_product,id_producer,id_product_type,nameProduct,price,amount,detail,image,top,new,status) VALUES(null,$id_producer,$id_product_type,'$name',$price,$amount,'$detail','$unique_image',$top,$new,1)";
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

    public function show_product()
    {
        $query = "SELECT * FROM product";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Hiển thị danh sách sản phẩm để phân trang
     */
    public function show_product_pagination()
    {
        $query = "
        SELECT product.* , nameProducer , nameProductType
        FROM product JOIN producer ON product.id_producer = producer.id_producer
        JOIN product_type ON product.id_product_type = product_type.id_product_type
        ORDER BY id_product ASC";

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

    /**
     * Cập nhật sản phẩm khi biết id
     */
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
                nameProduct = '$name',
                price = $price,
                amount = $amount,
                detail = '$detail',
                image = '$unique_image',
                top = $top,
                new = $new
                WHERE id_product = $id";
            } else {
                // Nếu người dùng ko chọn ảnh
                $query = "UPDATE product SET 
                id_producer = '$id_producer',
                id_product_type = '$id_product_type',
                nameProduct = '$name',
                price = $price,
                amount = $amount,
                detail = '$detail',
                top = $top,
                new = $new
                WHERE id_product = $id";
            }

            $result = $this->db->update($query);
            if ($result) {
                $alert = '<script language="javascript">alert("Update Successfully !!!"); window.location="product.php";</script>';
                return $alert;
            } else {
                $alert = '<script language="javascript">alert("Update Failed !!!"); window.location="product.php";</script>';
                return $alert;
            }
        }
    }

    /**
     * Xóa sản phẩm khi biết id
     */
    public function delete_product($id)
    {
        $query1 = "SELECT COUNT(*) AS count  FROM bill_detail WHERE bill_detail.id_product = $id ";
        $rs = $this->db->select($query1);
        $val = $rs->fetch_assoc();
        $count = $val['count'];
        if ($count > 0) {
            $alert = '<script language="javascript">alert("Không thể xóa vì liên quan đến những trường dữ liệu khác"); window.location="product.php";</script>';
            return $alert;
        } else {
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
    }

    public function get_product($adr, $id, $name, $nums)
    {
        $query = "SELECT *  FROM $adr WHERE $name = $id and status = 1  ORDER BY id_product DESC LIMIT $nums ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_products($adr, $id, $name, $item_per_page, $offset)
    {
        $query = "SELECT *  FROM $adr WHERE $name = $id and status = 1 ORDER BY id_product ASC LIMIT $item_per_page OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }
    public function  get_product_preview($id)
    {
        $query = "SELECT *  FROM product 
                        join producer on product.id_producer = producer.id_producer 
                        join product_type on product.id_product_type = product_type.id_product_type 
                         WHERE id_product = $id ";
        $result = $this->db->select($query);
        return $result;
    }
    public function  get_category($adr)
    {
        $query = "SELECT *  FROM $adr ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_products_cat($adr, $id, $name)
    {
        $query = "SELECT *  FROM $adr where $name = $id and status =1 ";
        $result = $this->db->number($query);
        return $result;
    }

    //lây sản pam theo nhu cau cua danh muc
    public function get_productss($id, $catid, $item_per_page, $offset)
    {
        $query = "SELECT *  FROM product                            
                WHERE id_product_type = $id and status = 1 and id_producer = $catid ORDER BY id_product DESC LIMIT $item_per_page OFFSET $offset";
        $result = $this->db->select($query);
        return $result;
    }

    // lay nhu cau theo danh muc
    public function  get_demand($id)
    {
        $query = "SELECT  DISTINCT product.id_product_type,product.id_producer,product_type.nameProductType FROM product 
                    join product_type on product.id_product_type = product_type.id_product_type 
                    WHERE id_producer= $id";
        $result = $this->db->select($query);
        return $result;
    }
    public function  search($search)
    {
        $query = "select * from product where nameProduct like '%$search%'";
        $result = $this->db->select($query);
        return $result;
    }
    public function updateStatus($id_product, $status)
    {
        $query = "Update product Set status = $status Where id_product = $id_product";
        $result = $this->db->update($query);
        return $result;
    }

    /**
     * Cập nhật số lượng 
     */
    public function updateAmount($id_product, $amount)
    {
        $query = "Update product Set amount = (amount - $amount) Where id_product = $id_product";
        $result = $this->db->update($query);
        return $result;
    }

    /**
     * Truy vấn sản phẩm liên quan
     */
    public function getProductRelated($idProduct, $idProducer, $idProductType)
    {
        $query = "SELECT * from product WHERE id_product != (SELECT id_product from product WHERE id_product = $idProduct) and id_producer = $idProducer and id_product_type = $idProductType LIMIT 4;";
        $result = $this->db->select($query);
        return $result;
    }
}



?>