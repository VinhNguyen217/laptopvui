<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../libraries/Database.php');
    require_once ($filepath.'/../helpers/format.php');
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
        


        if($name ==""||$password ==""||$repeat_password ==""||$email =="")
        {
            $alert = '<script language="javascript">alert("Điền đầy đủ thông tin có chứa (*) !!!"); </script>';
            echo $alert;
        }
        else
        {
            $check_email = "SELECT * FROM user where email = '$email' ";
            $result = $this->db->select($check_email);
            if($result)
            {
                $alert = '<script language="javascript">alert("Email đã tồn tại !!!"); </script>';
                echo $alert;
            }
            else{
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
    
    if($password ==""||$email =="")
        {
            $alert = '<script language="javascript">alert("Điền đầy đủ thông tin có chứa (*) !!!"); </script>';
            echo $alert;
        }
        else
        {
            $check_email = "SELECT * FROM user where email = '$email' AND password = '$password' LIMIT 1 ";
            $result = $this->db->select($check_email);
            if($result != false)
            {
                $validate = $result->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$validate['id_user']);
                Session::set('customer_name',$validate['username']);
                $check = "SELECT id_bill FROM bill where id_user = {$_SESSION['customer_id']}   ";
                $result = $this->db->number($check);
                if($result > 0)
                {
                    Session::set('check',true); // check xem có tồn tại thông tin của hoá đơn trc không,nếu có thì sử dụng để hiện lên trên pay.php
                    $check = "SELECT * FROM bill where id_user = {$_SESSION['customer_id']} ORDER BY id_bill DESC limit 1 ";
                    $result = $this->db->select($check);
                    if($result)
                    {
                        $validate = $result->fetch_assoc();
                        Session::set('customer_recriver',$validate['name_customer']);
                        Session::set('customer_phone', $validate['phone']);
                        Session::set('customer_address',$validate['address']);
                    }
                    
                }
                else{
                    Session::set('check',false); // check xem có tồn tại thông tin của hoá đơn trc không,nếu có thì sử dụng để hiện lên trên pay.php
                }
                
                header('Location:index.php');
            }
            else{
                $alert = '<script language="javascript">alert("Email hoặc mật khẩu sai");window.location="login.php"; </script>';
                echo $alert;
            }
        }
        
    }
    public function get_info($iduser)
    {
        $query = "SELECT *  FROM user       
                        WHERE id_user = $iduser ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_info($iduser,$data)
    {
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $recriver  = mysqli_real_escape_string($this->db->link, $data['recriver']);
        $name  = mysqli_real_escape_string($this->db->link, $data['name']);
        $query = "UPDATE user SET phone = '$phone', address = '$address' ,name = '$name' WHERE id_user = $iduser";
        $result = $this->db->update($query);
        if ($result) {
            $check_email = "SELECT * FROM user where id_user = '$iduser' ";
            $result = $this->db->select($check_email);
            if($result)
            {
                $validate = $result->fetch_assoc();
                $_SESSION['customer_recriver'] = $recriver;
                $_SESSION['customer_phone'] = $phone;
                $_SESSION['customer_address'] = $address;
                
            }
            $_SESSION['check'] = true;
            $alert = '<script language="javascript">alert("Cập nhật thành công !!!"); window.location="pay.php";</script>';
            echo $alert;
        } else {
            $_SESSION['check'] = false;
            $alert = '<script language="javascript">alert("Cập nhật thất bại !!!"); </script>';
            echo $alert;
        }
    }
}

?>