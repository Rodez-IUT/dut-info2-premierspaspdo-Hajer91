<html lang="fr">
<head>
	<body>
		<?php 
			$host='localhost';
			$db='my-activities';
			$user='root';
			$pass='root';
			$charset='utf8mb4';
			$dsn="mysql:host=$host;dbname=$db;charset=$charset";
			$options=[
				PDO::ATTR_ERRMODE				=>PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE	=>PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES		=>false,];
			try{
				$pdo=new PDO($dsn,$user,$pass,$options);
			}catch(PDOException$e){
				throw new PDOException($e->getMessage(),(int)$e->getCode());
			}
			$stmt = $pdo->query('SELECT * 
								 FROM users 
								 JOIN status s
								 ON users.status_id = s.id
								 WHERE s.name = \'Active account\'
								 AND username LIKE \'e%\' 
								 ORDER BY username ASC');
			echo "<table border=\"1px\">";
			echo "<tr>";
				echo "<td>"."Id"."</td>";
				echo "<td>"."Username"."</td>";
				echo "<td>"."Email"."</td>";
				echo "<td>"."Status"."</td>";
			echo "</tr>";
			while($row = $stmt->fetch()){
				echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['username']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		?>
	</body>
</head>
</html>