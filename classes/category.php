<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class Category
{
    private $db_category;
    private $fm;
    public function __construct()
    {
        $this->db_category = new Database();
        $this->fm = new Format();
    }

    /**
     * Thêm nha sản xuất
     */
    public function insert_category($category_name)
    {
        $category_name = $this->fm->validation($category_name);

        $category_name = mysqli_real_escape_string($this->db_category->link, $category_name);
        if ($this->check_category($category_name)) {
            $alert = '<span style="color:red">Category name already exists</span>';
            return $alert;
        } else {
            $query = "INSERT INTO producer(id_producer,nameProducer) VALUES(null,'$category_name') ";
            $result = $this->db_category->insert($query);

            if ($result) {
                $alert = '<script language="javascript">alert("Save Successfully !!!"); window.location="category_add.php";</script>';
                return $alert;
            } else {
                $alert = '<script language="javascript">alert("Save Failed !!!"); window.location="category_add.php";</script>';
                return $alert;
            }
        }
    }

    /**
     * Kiểm tra tên nhà sản xuất có tồn tại hay không , nếu có => return true,nếu không => return false
     */
    public function check_category($category_name)
    {
        $category_name = $this->fm->validation($category_name);

        $category_name = mysqli_real_escape_string($this->db_category->link, $category_name);

        $query = "SELECT * FROM producer WHERE nameProducer = '$category_name'";
        $result = $this->db_category->select($query);

        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Hiển thị danh sách nhà sản xuất
     */
    public function show_category()
    {
        $query = "SELECT * FROM producer ORDER BY id_producer ASC";
        $result = $this->db_category->select($query);
        return $result;
    }

    /**
     * Trả về nhà sản xuất khi biết id
     */
    public function getCatById($id)
    {
        $query = "SELECT * FROM producer WHERE id_producer = '$id'";
        $result = $this->db_category->select($query);
        return $result;
    }

    /**
     * Cập nhật nhà sản xuất khi biết id
     */
    public function update_category($category_name, $id)
    {
        $category_name = $this->fm->validation($category_name);
        $category_name = mysqli_real_escape_string($this->db_category->link, $category_name);

        if ($this->check_category($category_name)) {
            $alert = '<span style="color:red">Category name already exists</span>';
            return $alert;
        } else {
            $query = "UPDATE producer SET nameProducer = '$category_name' WHERE id_producer = $id";
            $result = $this->db_category->update($query);

            if ($result) {
                $alert = '<span style="color:#157347">Category Updated Successfully</span>';
                return $alert;
            } else {
                $alert = '<span style="color:red">Category Updated Not Success</span>';
                return $alert;
            }
        }
    }

    /**
     * Xóa 1 nhà sản xuất khi biết id
     */
    public function delete_category($id)
    {
        $query1 = "SELECT COUNT(*) AS count  FROM product WHERE product.id_producer = $id ";
        $rs = $this->db_category->select($query1);
        $val = $rs->fetch_assoc();
        $count = $val['count'];
        if ($count > 0) {
            $alert = '<script language="javascript">alert("Không thể xóa vì liên quan đến những trường dữ liệu khác"); window.location="category.php";</script>';
            return $alert;
        } else {
            $query = "DELETE FROM producer WHERE id_producer = '$id'";
            $result = $this->db_category->delete($query);
            if ($result) {
                $alert = '<script language="javascript">alert("Category Deleted Successfully !!!"); window.location="category.php";</script>';
                return $alert;
            } else {
                $alert = '<script language="javascript">alert("Category Deleted Not Successfully !!!"); window.location="category.php";</script>';
                return $alert;
            }
        }
    }
}

?>