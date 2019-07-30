<?php
function    pdo_connect()
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
    $conn = pdo_connect();
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
    $conn = pdo_connect();
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
	$conn = pdo_connect();
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
?>
