<?php
require "vendor/autoload.php";

$host = 'localhost';
$login = 'root';
$password = '';
$db = 'burger';

$loader = new Twig\Loader\FilesystemLoader(['.']);
$twig = new Twig_Environment($loader);

try {
    $pdo = new PDO("mysql:host=$host; dbname=$db", $login, '');

    $queryAllOrders = $pdo->query(
        "SELECT customers.id, customers.name, orders.id as 'order_number',  CONCAT_WS(' ', orders.street,orders.home, orders.part) as address, orders.comment, orders.payment, orders.callback, orders.`date` FROM  orders JOIN customers ON orders.customerId = customers.id");
    echo "<style>
body {
margin: 0 auto;
padding: 0 auto;
width:  50%;
}
table {
background-color: wheat;
border: 2px groove #8ac03e;
}
td, th {
border-bottom: groove;
padding: 10px;
margin: 2px 5px;
text-align: center;
}</style>";
   // echo "<table><caption>АДМИН ПАНЕЛЬ</caption><tr><th>номер заказа</th><th>имя клиента</th><th>номер клиента</th><th>адресс доставки</th><th>коментарий</th><th>оплата</th><th>перезвонивать клиенту</th><th>дата заказа</th></tr>";

    $allOrders = $queryAllOrders->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($allOrders);

    $twig->render("table.twig", ['orders' => $allOrders]);
   /* foreach ($allOrders as $order) {
        echo "<tr>" . "<td>{$order['order_number']}</td><td>{$order['name']}</td><td>{$order['id']}</td><td>{$order['address']}</td><td>{$order['comment']}</td><td>{$order['payment']}</td><td>{$order['callback']}</td><td>{$order['date']}</td>" . "</tr>";
    }*/
} catch (PDOException $e) {
    echo $e->getMessage();
}
