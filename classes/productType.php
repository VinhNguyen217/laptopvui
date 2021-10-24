<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class ProductType
{
    private $db_productType;
    private $fm;
    public function __construct()
    {
        $this->db_productType = new Database();
        $this->fm = new Format();
    }

    /**
     * Thêm mới 1 loại sản phẩm
     */
    public function insert_productType($productType_name)
    {
        $productType_name = $this->fm->validation($productType_name);

        $productType_name = mysqli_real_escape_string($this->db_productType->link, $productType_name);
        if ($this->check_productType($productType_name)) {
            $alert = '<span style="color:red">Product type already exists</span>';
            return $alert;
        } else {
            $query = "INSERT INTO product_type(id_product_type,nameProductType) VALUES(null,'$productType_name') ";
            $result = $this->db_productType->insert($query);

            if ($result) {
                $alert = '<script language="javascript">alert("Save Successfully !!!"); window.location="productType_add.php";</script>';
                return $alert;
            } else {
                $alert = '<script language="javascript">alert("Save Failed !!!"); window.location="productType_add.php";</script>';
                return $alert;
            }
        }
    }

    /**
     * Kiểm tra loại sản phẩm có tồn tại hay không , nếu có => return true,nếu không => return false
     */
    public function check_productType($productType_name)
    {
        $productType_name = $this->fm->validation($productType_name);

        $productType_name = mysqli_real_escape_string($this->db_productType->link, $productType_name);

        $query = "SELECT * FROM product_type WHERE nameProductType = '$productType_name'";
        $result = $this->db_productType->select($query);

        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Hiển thị danh sách loại sản phẩm
     */
    public function show_productType()
    {
        $query = "SELECT * FROM product_type ORDER BY id_product_type ASC";
        $result = $this->db_productType->select($query);
        return $result;
    }

    /**
     * Trả về 1 loại sản phẩm khi biết id
     */
    public function getProductTypeById($id)
    {
        $query = "SELECT * FROM product join product_type 
                                        on product.id_product_type = product_type.id_product_type
                                        join producer
                                        on product.id_producer = producer.id_producer
                                        WHERE product.id_product_type = '$id'";
        $result = $this->db_productType->select($query);
        return $result;
    }

    /**
     * Cập nhật loại sản phẩm khi biết id
     */
    public function update_productType($productType_name, $id)
    {
        $productType_name = $this->fm->validation($productType_name);
        $productType_name = mysqli_real_escape_string($this->db_productType->link, $productType_name);

        if ($this->check_productType($productType_name)) {
            $alert = '<span style="color:red">Product Type already exists</span>';
            return $alert;
        } else {
            $query = "UPDATE product_type SET nameProductType = '$productType_name' WHERE id_product_type = $id";
            $result = $this->db_productType->update($query);

            if ($result) {
                $alert = '<span style="color:#157347">Product Type Updated Successfully</span>';
                return $alert;
            } else {
                $alert = '<span style="color:red">Product Type Updated Not Success</span>';
                return $alert;
            }
        }
    }

    /**
     * Xóa 1 loại sản phẩm khi biết id
     */
    public function delete_productType($id)
    {
        $query = "DELETE FROM product_type WHERE id_product_type = '$id'";
        $result = $this->db_productType->delete($query);
        if ($result) {
            $alert = '<script language="javascript">alert("Product Type Deleted Successfully !!!"); window.location="productType.php";</script>';
            return $alert;
        } else {
            $alert = '<script language="javascript">alert("Product Type Deleted Not Successfully !!!"); window.location="productType.php";</script>';
            return $alert;
        }
    }

    public function getProductTypeByIdd($id)
    {
        $query = "SELECT * FROM product_type WHERE id_product_type = '$id'";
        $result = $this->db_productType->select($query);
        return $result;
    }
}

?>