<?php
require_once './layouts/header.php';
require_once '../classes/user.php';
?>
<?php
$user = new User();
?>
<style>
    #datatablesSimple th,
    td {
        text-align: center;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tài khoản khách hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active">Danh sách tài khoản </li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of accounts
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Kích hoạt</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Kích hoạt</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $showUser = $user->show_user();
                        if ($showUser) {
                            while ($result = $showUser->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $result['id_user']; ?></td>
                                    <td>
                                        <?php echo $result['username'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['password'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['address'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['phone'] ?>
                                    </td>
                                    <td>
                                        <input class="handle_account" type="checkbox" data-account_id="<?= $result['id_user'] ?>" value="<?= $result['active'] ?>" <?php echo ($result['active'] == 1 ? 'checked' : ''); ?> />
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('input.handle_account').click(function() {
            var id = $(this).data('account_id');
            var status = $(this).val();
            $.ajax({
                url: '../helpers/handle_account.php',
                type: 'GET',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    if (data == true)
                        alert("update success !!!");
                    else
                        alert("update fail !!!");
                }
            })
        })
    });
</script>
<?php
include('./layouts/footer.php');
?>