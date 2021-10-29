
<?php
	include "layouts/header.php"
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Update'])) {
		$iduser = Session::get('customer_id');
		$update_info = $cs->update_info($iduser,$_POST);
	}
?>
<div class="main_title " >
        <ul>
            
            <li><a href="./index.php" style="background: none;padding-left: 0px;">Trang chủ</a></li>
            <li><a>/</a></li>
            <li><a href="pay.php" style="background: none;padding-left: 0px;">Thanh toán  </a></li>
        </ul>
</div>
<div class="content-info">
    <div class="form-info">
        <div class="info-left">
            <h1 style="font-size: 30px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Thông tin cá nhân</h1>
            <div class="information-info">
            <form action="" method = "POST"> 
                <?php
                    $iduser = Session::get('customer_id');
                    $info = $cs->get_info($iduser);
                    if($info) $result = $info->fetch_assoc();
                ?>
                <div class="input">
                    <label for="name">Username(*)</label>
                    <input type="text" name="name" id="name" value ="<?=$result['username']?>" readonly>
                    <span class="spin"><hr></span>
                </div>
                <div class="input">
                    <label for="name">Email(*)</label>
                    <input type="email" name="email" id="email " value ="<?=$result['email']?>"readonly>
                    <span class="spin"><hr></span>
                </div> 
                <div class="input">
                    <label for="number">Phone(*)</label>
                    <input type="text" name="phone" id="phone" value ="<?=$result['phone']?> "required>
                    <span class="spin"><hr></span>
                </div>  
                <div class="input">
                    <label for="number">Recriver(*)</label>
                    <?php
                        if($_SESSION['check']== true){
                            ?>
                            <input type="text" name="recriver" id="recriver" value ="<?=$_SESSION['customer_recriver']?> "required>
                            <?php
                        }
                        else{
                            ?>
                            <input type="text" name="recriver" id="recriver" value =" "required>
                            <?php
                        }
                    ?>
                    <span class="spin"><hr></span>
                </div> 
                <div class="input">
                    <label for="number">Full Name(*)</label>
                    <input type="text" name="name" id="name" value ="<?=$result['name']?> "required>
                    <span class="spin"><hr></span>
                </div> 
                <div class="input">
                    <label for="address">Address(*)</label>
                    <input type="text" name="address" id="address" value ="<?=$result['address']?> "required  >
                    <span class="spin"><hr></span>
                </div>   
                <input type="submit" name = "Update" value="Cập nhập">
                <input type="submit" name = "Cancel" value="Huỷ bỏ">                 
            </form>
            <div class="img-info"></div>
            </div>
        </div>
        <div class="infor-right"><img src="https://scontent.fhan5-10.fna.fbcdn.net/v/t1.6435-9/244230246_4952510141429085_4576615240632283395_n.jpg?_nc_cat=1&ccb=1-5&_nc_sid=730e14&_nc_ohc=lgVCPCUvh8YAX_Tkl_z&_nc_oc=AQme_MU9Mmz0G0BO4sPGG_CvYcCcYkzFWs8jugWUQZJnOuU3fz815Eoawb0wkSANz5ZcDqbIpapR6R6P_co2P5y2&_nc_ht=scontent.fhan5-10.fna&oh=2b34eeeeb45517fe3b606819ee3afb86&oe=61818629" alt=""></div>
    </div>
   
</div> 
<?php
	include "layouts/footer.php"
?>

