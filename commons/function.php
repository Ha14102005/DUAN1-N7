<?php

// Kết nối CSDL qua PDO

function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "duan1";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
//        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}

function checkLoginAdmin() {
    if(isset($_SESSION["usr_admin"])) {
        // header("location :" .BASE_URL_ADMIN . '?act=login-admin');
        // var_dump('abc');die;
        require_once './view/auth/formLogin.php';
        exit();
 }   
}
function pdo_query($sql, $sql_args = [])
{
    $conn = connectDB(); // Kết nối cơ sở dữ liệu
    $stmt = $conn->prepare($sql);
//    $stmt->execute($sql_args);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function pdo_query_value($sql, $sql_args = [])
{
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
//    $stmt->execute($sql_args);
    return $stmt->fetchColumn();
}

?>
