<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class User
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * Hiển thị tài khoản người dùng
     */
    public function show_user()
    {
        $query = "SELECT * FROM user ORDER BY id_user ASC";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Cập nhật trạng thái tài khoản
     */
    public function update_status($accountId, $status)
    {
        $query = "UPDATE user SET active = $status WHERE id_user = $accountId";
        $result = $this->db->update($query);
        return $result;
    }
}

?>