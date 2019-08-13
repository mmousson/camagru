<?php
function    pdo_connect_user()
{
    $servername = "localhost";
    $username = "root";
    $password = "bleu";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=__camagru_users", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ( $conn );
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        return ( NULL );
    }
}

function	check_if_exists($data, $row)
{
    $conn = pdo_connect_user();
    if ( $conn !== NULL )
    {
        $sql = "SELECT * FROM account_infos WHERE $row='$data'";

        $rows = $conn->prepare($sql);
        $rows->execute();
        if ($rows->rowCount() > 0)
            return TRUE;
        else
            return FALSE;
    }
    $conn = NULL;
}

function    generate_token()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 128; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function	remove_user($login)
{
	$conn = pdo_connect_user();
	if ( $conn !== NULL )
	{
		$query = $conn->prepare("DELETE FROM account_infos WHERE login = :login");
		$query->bindParam(':login', $login);
		$query->execute();

		$conn = NULL;
	}
}

function    add_user($mobile, $mail, $full_name, $user_name, $pass)
{
    $servername = "localhost";
    $username = "root";
    $password = "bleu";

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=__camagru_users", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $token = generate_token();
        $date = date("Y-m-d H:i:s");
        $pass_hash = hash("whirlpool", $pass);
        $verfied = 0;
        $pdo = $conn->prepare(" INSERT INTO account_infos
                                (
                                    login,
                                    full_name,
                                    phone,
                                    mail,
                                    signup_date,
                                    verified,
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
                                    :token,
                                    :password_hash
                                )");
        $pdo->bindParam(':login', $user_name);
        $pdo->bindParam(':full_name', $full_name);
        $pdo->bindParam(':phone', $mobile);
        $pdo->bindParam(':mail', $mail);
        $pdo->bindParam(':signup_date', $date);
        $pdo->bindParam(':verified', $verfied);
        $pdo->bindParam(':token', $token);
        $pdo->bindParam(':password_hash', $pass_hash);
        $pdo->execute();

        return ( $token );
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        return ( NULL );
    }
    $conn = NULL;
}


//0 -> Incorrect password
//1 -> Account not yet verified
//2 -> OK
function    auth_user($user, $pass)
{
    $servername = "localhost";
    $username = "root";
    $password = "bleu";

    $ret = 0;
    
    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=__camagru_users", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pass_hash = hash("whirlpool", $pass);
        $rows = $conn->prepare( "SELECT * FROM account_infos WHERE (login='$user' AND password_hash='$pass_hash')" );
        $rows->execute();
        if ( $rows->rowCount() === 1 )
        {
            $ret = 1;
            $rows = $conn->prepare( "SELECT * FROM account_infos WHERE (login='$user' AND verified='1')" );
            $rows->execute();
            if ( $rows->rowCount() === 1 )
                $ret = 2;
        }
    }
    catch ( PDOException $e )
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = NULL;
    return ( $ret );
}

function    get_user_mail($user)
{
    $conn = pdo_connect_user();
    if ( $conn !== NULL )
    {
        $query = $conn->prepare("SELECT mail FROM account_infos WHERE login='" . $user . "'");
        $query->execute();

        $results = $query->fetchAll();
        $conn = NULL;
        return ( $results[0][0] );
    }
    return ( "" );
}

function	get_user_preference($login, $preference_id)
{
	$conn = pdo_connect_user();
	if ( $conn !== NULL )
	{
		$query = $conn->prepare("SELECT $preference_id FROM account_infos WHERE login='" . $login . "'");
		$query->execute();
		
		$results = $query->fetch();
		$conn = NULL;
		if ($results[0] === "1")
			return ( "checked" );
	}
	return ( "" );
}

function	update_user_settings($login, $like, $comment)
{
	$conn = pdo_connect_user();
	$like_val = ($like === "true" ? "1" : "0");
	$comment_val = ($comment === "true" ? "1" : "0");
	if ( $conn !== NULL )
	{
		$query = $conn->prepare("UPDATE account_infos SET
			like_notif='$like_val', comment_notif='$comment_val'
			WHERE login='$login'");
		$query->execute();

		$conn = NULL;
		return ( TRUE );
	}
	else
		return ( FALSE );
}

function	update_user_infos($login, $new_login, $mail, $oldpass, $newpass, $repass)
{
	$conn = pdo_connect_user();
	if (strcmp($newpass, $repass) !== 0)
		return ( 2 );
	$old_pass_hash = hash("whirlpool", $oldpass);
	$new_pass_hash = hash("whirlpool", $newpass);
	if ( $conn !== NULL )
	{
		//Check if old password is the same as the one stored in the Database
		$query = $conn->prepare("	SELECT password_hash
									FROM account_infos
									WHERE login='$login'");
		$query->execute();
		$result = $query->fetch();

		//Check if the user asked for a new passsword, and if so, check that he spelled it
		//right
		if ( strcmp($result[0], $old_pass_hash) !== 0 )
			return ( 1 );
		
		//Check if the user asked for a new username, and if so, check its avaibility
		if ( strcmp($login, $new_login) !== 0
			&& check_if_exists( $new_login, "login" ) === TRUE )
			return ( 3 );
		if ( strcmp( get_user_mail( $login ), $mail ) !== 0
			&& check_if_exists( $mail, "mail" ) === TRUE )
			return ( 4 );


		$query_str = "UPDATE account_infos SET
					login='$new_login',
					mail='$mail'";
		if ( !empty( $newpass ) )
			$query_str .= ", password_hash='$new_pass_hash'";
		$query_str .= " WHERE login='$login'";

		$query = $conn->prepare($query_str);
		$query->execute();

		$conn = NULL;
		return ( 0 );
	}
	else
		return ( 5 );
}
?>
