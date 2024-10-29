<?php
session_start();
include("../includes/config.php");
include("../includes/header.php");
if (isset($_POST['submit'])) {
    echo $_GET['id'];

    $role = strip_tags($_POST['role']);
    $sql = "UPDATE users SET role = '$role' WHERE user_id = {$_GET['id']} ";
    echo $sql;
    $result = mysqli_query($conn, $sql);
   
    if (mysqli_affected_rows($conn) === 1 ) {
        $_SESSION['success'] = 'user role updated';
        
    }
}

$sql = "SELECT u.user_id AS id, concat(lname, ' ', fname) AS name, u.email as email, concat(addressline, ' ', town, ' ', zipcode) AS address, u.role AS role FROM users u INNER JOIN customer c ON (u.user_id = c.user_id)WHERE deleted_at IS NULL";
// echo $sql;
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

?>

<h2>number of items <?= $count ?> </h2>
<?php include("../includes/alert.php"); ?>
<div class="container-fluid">
   
    <table class="table table-striped table-bordered">
        <thead>
            <th>
                Id
            </th>
            <th>
                name
            </th>
            <th>
                email
            </th>
            <th>
                address
            </th>
            <th>
                role
            </th>
        </thead>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['address']}</td>";
            // echo "<td>{$row['role']}</td>";

            if ($row['role'] === 'admin') {
                echo <<<FORM
                <form action="{$_SERVER["PHP_SELF"]}?id={$row['id']}" method='POST' >
                <td><div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' id='adminCheck' name='role' value='admin' checked>
                <label class='form-check-label' for='adminCheck'>Admin</label>
                </div><div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' id='roleCheck' name='role' value='user' >
                <label class='form-check-label' for='roleCheck'>user</label>
                </div>
                <button type='submit' class='btn btn-primary btn-sm' name='submit' value='submit'>Update role</button>
                </form></td>
                FORM;
            } else {
                echo <<<FORM
                <form action="{$_SERVER["PHP_SELF"]}?id={$row['id']}" method='POST' >
                <td><div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' id='adminCheck' name='role' value='admin' >
                <label class='form-check-label' for='adminCheck'>Admin</label>
                </div><div class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' id='roleCheck' name='role' value='user' checked >
                <label class='form-check-label' for='roleCheck'>user</label>
                </div>
                <button type='submit' class='btn btn-primary btn-sm' name='submit'  value='submit'>Update role</button>
                </form></td>
                FORM;
            }
        }
        ?>
    </table>
</div>
<?php
include('../includes/footer.php');
?>