<html lang="fr">
<head>

	<body>
		<?php 
			$host='localhost'; // ajouter le port sur UWamp , il utilise le port par defaut mysql = 3306
			$port = '3306'; //par defaut 
			$db='my-activities';
			$user='root';
			$pass='root';
			$charset='utf8mb4';
			$dsn="mysql:host=$host;dbname=$db;charset=$charset";// ajouter port=$port
			$options=[
				PDO::ATTR_ERRMODE				=>PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE	=>PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES		=>false,];
			try{
				$pdo=new PDO($dsn,$user,$pass,$options);
			}catch(PDOException$e){
				throw new PDOException($e->getMessage(),(int)$e->getCode());
			}
		?>
<h2>ALL USERS</h2>	
		
		<?php
		if (isset($_POST['start_letter'])) { /* true si la variable est initialisée */
		$start_letter = htmlspecialchars($_POST["start_letter"]);
		$status_id = (int)$_POST["status_id"] ;
		$sql="  SELECT users.id as user_id, username, email, s.name as status 
				FROM users 
				JOIN status s 
				ON users.status_id = s.id
				WHERE status_id = $status_id
				AND username LIKE '$start_letter%'
				ORDER BY username ASC";
		} else {
			$start_letter = " ";
			$status_id = " ";
			$sql='   SELECT users.id as user_id, username, email, s.name as status 
					 FROM users 
					 JOIN status s 
					 ON users.status_id = s.id';   
		}
		?>
		
		<form action="all_usersACTIV3V2.php" method="post">
			Start with letter: <input name="start_letter" type="text" value="<?php echo $start_letter  ?>">
			and status is:
			<select name="status_id">
				<option value="1" <?php if ($status_id == 1) echo 'selected' ?>>Waiting for account validation</option>
				<option value="3" <?php if ($status_id == 2) echo 'selected' ?>>Active account</option>
			</select>
			<input type="submit" value="OK">
		</form>
<?php
try {
	$stmt = $pdo->query($sql);
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
</head>
</html>