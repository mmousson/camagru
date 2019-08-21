<?php
	include_once ( "database.php" );
	
	try
	{
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$sql = "CREATE DATABASE IF NOT EXISTS __camagru_users";
		$conn->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS __camagru_users.account_infos
		(
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			login VARCHAR(32),
			full_name VARCHAR(64),
			phone VARCHAR(12),
			mail VARCHAR(128),
			signup_date DATETIME,
			verified BOOLEAN,
			like_notif BOOLEAN,
			comment_notif BOOLEAN,
			token VARCHAR(256),
			password_hash VARCHAR(1024)
		);";
		$conn->exec($sql);
	
		$sql = "CREATE DATABASE IF NOT EXISTS __camagru_posts";
		$conn->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS __camagru_posts.publications
		(
			id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			author VARCHAR(32),
			publication_date DATETIME,
			message VARCHAR(300),
			public BOOLEAN,
			likes INT NOT NULL DEFAULT '0'
		);";
		$conn->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS __camagru_posts.comments
		(
			comment_id INT NOT NULL AUTO_INCREMENT,
			image_id INT NOT NULL,
			author VARCHAR(32),
			publication_date DATETIME,
			message VARCHAR(300),
			PRIMARY KEY (comment_id)
		);";
		$conn->exec($sql);
		$sql = "CREATE TABLE IF NOT EXISTS __camagru_posts.likes
		(
			image_id INT NOT NULL,
			author VARCHAR(32),
			like_dir INT
		);";
		$conn->exec($sql);
	
		$user_name = "root";
		$full_name = "root";
		$mobile = "ROOT ACCOUNT";
		$mail = "ROOT ACCOUNT";
		$token = "ROOT ACCOUNT";
		$date = date("Y-m-d H:i:s");
		$pass_hash = hash("whirlpool", "bleu");
		$verfied = 1;
		$like_notif = 1;
		$comment_notif = 1;
		$pdo = $conn->prepare(" INSERT INTO __camagru_users.account_infos
								(
									login,
									full_name,
									phone,
									mail,
									signup_date,
									verified,
									like_notif,
									comment_notif,
									token,
									password_hash
								)
								VALUES
								(
									:login,
									:full_name,
									:phone,
									:mail,
									:signup_date,
									:verified,
									:like_notif,
									:comment_notif,
									:token,
									:password_hash
								)");
		$pdo->bindParam(':login', $user_name);
		$pdo->bindParam(':full_name', $full_name);
		$pdo->bindParam(':phone', $mobile);
		$pdo->bindParam(':mail', $mail);
		$pdo->bindParam(':signup_date', $date);
		$pdo->bindParam(':verified', $verfied);
		$pdo->bindParam(':like_notif', $like_notif);
		$pdo->bindParam(':comment_notif', $comment_notif);
		$pdo->bindParam(':token', $token);
		$pdo->bindParam(':password_hash', $pass_hash);
		$pdo->execute();
	
		echo "Database created successfully<br>";
	}
	catch(PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	
	$conn = null;
?>
