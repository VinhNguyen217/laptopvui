<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../libraries/Database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class Customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['firstname']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $repeat_password = mysqli_real_escape_string($this->db->link, md5($data['confirm-password']));
        $email = mysqli_real_escape_string($this->db->link, $data['email']);



        if ($name == "" || $password == "" || $repeat_password == "" || $email == "") {
            $alert = '<script language="javascript">alert("Điền đầy đủ thông tin có chứa (*) !!!"); </script>';
            echo $alert;
        } else {
            $check_email = "SELECT * FROM user where email = '$email' ";
            $result = $this->db->select($check_email);
            if ($result) {
                $alert = '<script language="javascript">alert("Email đã tồn tại !!!"); </script>';
                echo $alert;
            } else {
                $query = "INSERT INTO user (username,password,email) VALUES('$name','$password','$email')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = '<script language="javascript">alert("Đăng ký thành công !!!"); window.location="index.php";</script>';
                    echo $alert;
                } else {
                    $alert = '<script language="javascript">alert("Đăng ký thất bại !!!"); </script>';
                    echo $alert;
                }
            }
        }
    }
    public function login_customer($data)
    {
        $password = mysqli_real_escape_string($this->db->link, md5($data['Password']));
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($password == "" || $email == "") {
            $alert = '<script language="javascript">alert("Điền đầy đủ thông tin có chứa (*) !!!"); </script>';
            echo $alert;
        } else {
            $check_email = "SELECT * FROM user where email = '$email' AND password = '$password' LIMIT 1 ";
            $result = $this->db->select($check_email);

            if ($result != false) {
                $validate = $result->fetch_assoc();
                if ($validate['active'] == 1) {
                    Session::set('customer_login', true);
                    Session::set('customer_id', $validate['id_user']);
                    Session::set('customer_name', $validate['username']);
                    header('Location:index.php');
                } else {
                    $alert = '<script language="javascript">alert("Tài khoản của quý khách đang bị khóa do vi phạm 1 số nguyên tắc của cửa hàng");window.location="login.php"; </script>';
                    echo $alert;
                }
            } else {
                $alert = '<script language="javascript">alert("Email hoặc mật khẩu sai");window.location="login.php"; </script>';
                echo $alert;
            }
        }
    }
}

?>