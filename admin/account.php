<?php
require_once './layouts/header.php';
require_once '../classes/user.php';
?>
<?php
$user = new User();
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Account</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Accounts</li>
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
                            <th>Username</th>
                            <th>Password</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Active</th>
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
                                    <td style="text-align: center;">
                                        <?php
                                        if ($result['active'] == 1) {
                                            echo '<input type="checkbox" name="active" value="1" checked />';
                                        } else {
                                            echo '<input type="checkbox" name="active" value="0"/>';
                                        }
                                        ?>
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
<?php
include('./layouts/footer.php');
?>