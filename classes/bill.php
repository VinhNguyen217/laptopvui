<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class Bill
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * Hiển thị danh sách hóa đơn
     */
    public function showBill()
    {
        $query = "Select * from bill";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Tìm hóa đơn khi biết id
     */
    public function getBillById($id)
    {
        $query = "Select * FROM bill WHERE id_bill = $id LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Lấy chi tiết hóa đơn khi biết id 
     */
    public function getDetailBillById($id)
    {
        $query = "SELECT bill.id_bill,nameProduct,image,bill_detail.amount,product.price FROM (`bill` join bill_detail on bill.id_bill = bill_detail.id_bill ) join product on bill_detail.id_product = product.id_product WHERE bill.id_bill = $id";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Cập nhật trạng thái hóa đơn
     */
    public function updateStatus($id, $status)
    {
        $query = "Update bill set status = $status where id_bill = $id";
        $result = $this->db->update($query);
        return $result;
    }

    public function deleteBill($id)
    {
        $query1 = "Delete from bill_detail where id_bill = $id";
        $result1 = $this->db->delete($query1);
        $query = "Delete from bill where id_bill = $id";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '<script language="javascript">alert("Xóa thành công !!!"); window.location="invoice.php";</script>';
            return $alert;
        } else {
            $alert = '<script language="javascript">alert("Xóa thất bại !!!"); window.location="invoice.php";</script>';
            return $alert;
        }
    }
}
?>