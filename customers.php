<?php
$host = 'localhost';
$db = 'curl';
$user = 'root';
$password = 'root';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false  ];

$pdo = new PDO($dsn, $user, $password, $options);

$id = $_GET['customer_id'];

$sql = "SELECT * FROM `customers` JOIN `address` ON `customers`.`id` = `address`.`customer_id` WHERE `customer_id` = $id";
$stm = $pdo->prepare($sql);
$stm->execute([]);
$customer = $stm-> fetch();

//header('Content-Type: application/json');
//echo json_encode($customer);

// http://localhost/wieg16-api/customers.php?customer_id=1

//http://wieg16-api.dev/customers.php?customer_id=1&address=true


$sql = "SELECT * FROM `address` WHERE `customer_id` = $id";
$stm = $pdo->prepare($sql);
$stm->execute([]);
$oneaddress = $stm-> fetch();

$address = isset($_GET['address']) ? $_GET['address'] : null;

header('Content-Type: application/json');

if ($customer != null && $address != null) {
    echo json_encode($oneaddress);
}

else if ($customer != null){
    echo json_encode($customer);

}
else {

    header("HTTP/1.0 404 Not Found");
    $messege = "Customer not found";
    if($address != null)
        $messege = "Address not found";
    echo json_encode(["message" => $messege]);



}

