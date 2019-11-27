<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

<?php
$host = 'localhost';
$db = 'my_activities';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo $e->getMessage() ;
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<h1>All Users - activité 5</h1>
<!-- ajouter une fonction pour cherhcer l'utilisateur  -->


<?php 
function get($param) {
	return isset($param) ? $_GET[$param]: null;
}
?>

<form action="all_usersACT4.php" method="get">
    Start with letter:
    <input name="start_letter" type="text" value="<?php echo $start_letter  ?>">
    and status is:
    <select name="status_id">
        <option value="1" <?php if (get("status_id") == 1) echo 'selected' ?>>Waiting for account validation</option>
        <option value="2" <?php if (get("status_id") == 2) echo 'selected' ?>>Active account</option>
		<option value="3" <?php if (get("status_id") == 3) echo 'selected' ?>>Waiting for account deletion</option>
    </select>
    <input type="submit" value="OK">
</form>



<?php
try {
	$stmt = $pdo->prepare($sql);
	
?>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
    </tr>
    <?php while ($row = $stmt->fetch()) { ?>
    <tr>
        <td><?php echo $row['user_id']?></td>
        <td><?php echo $row['username']?></td>
        <td><?php echo $row['email']?></td>
        <td><?php echo $row['status']?></td>
    </tr>
    <?php } ?>
</table>

<?php
	
} catch (PDOException $e) {
	echo $e->getMessage() ;
}
?>


</body>
</html>