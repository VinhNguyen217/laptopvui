<?php
include '../libraries/session.php';
Session::checkLogin();
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class Admin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_admin($adminEmail, $adminPass)
    {
        $adminEmail = $this->fm->validation($adminEmail);
        $adminPass = $this->fm->validation($adminPass);

        $adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        $query = "SELECT * FROM admin WHERE email = '$adminEmail' AND password = '$adminPass' LIMIT 1";
        $result = $this->db->select($query);

        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set('adminlogin', true);
            Session::set('adminId', $value['id_admin']);
            Session::set('adminUser', $value['username']);
            Session::set('adminName', $value['name']);
            header('Location:index.php');
        } else {
            $alert = "Email hoặc mật khẩu không trùng khớp :D";
            return $alert;
        }
    }
}

?>