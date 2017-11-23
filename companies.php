<?php
$host = 'localhost';
$db = 'curl';
$user = 'root';
$password = 'root';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false];

$pdo = new PDO($dsn, $user, $password, $options);
$sql = "SELECT * FROM `customers`";
$stm = $pdo->prepare($sql);
$stm->execute([]);
$customers = $stm->fetchAll();

//var_dump($customers);
$companies = [];

foreach ($customers as $customer) {
    $companies[] = $customer['customer_company'];
}

//die();
//var_dump($companies);

$unique = array_unique($companies);
//  var_dump($unique);
/* 

  foreach ($unique as $company) {
    $sql = "INSERT INTO `companies` (`company_name`) VALUES (:company_name)";
    $stm_insert = $pdo->prepare($sql);
    $stm_insert->execute([
    ':company_name' => $company
    ]);
    }
   */
$sql = "SELECT * FROM `companies`";
$stm = $pdo->prepare($sql);
$stm->execute([]);
$companies = $stm->fetchAll();

//var_dump($companies);


foreach ($companies as $company) {
    $sql = "UPDATE `customers` SET `company_id` = :id  WHERE `customer_company` = :company_name";
    $stm = $pdo->prepare($sql);
    $result = $stm->execute([
        ':id' => $company['id'],
        ':company_name' => $company['company_name'],
    ]);
    var_dump($result);
    echo "Id: " . $company['id'] . " " . "Företag: " . $company['company_name'] . "<br>";
}