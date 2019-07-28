<?php
$host = 'localhost';
$login = 'root';
$password = '';
$db = 'burger';

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
    echo "<table><caption>АДМИН ПАНЕЛЬ</caption><tr><th>customer id</th><th>customer name</th><th>order id</th><th>address</th><th>comment</th><th>payment</th><th>callback</th><th>order date</th></tr>";
    do {
        $allOrders = $queryAllOrders->fetch(PDO::FETCH_ASSOC);
        echo "<tr>", "<td>$allOrders[id]</td><td>$allOrders[name]</td><td>$allOrders[order_number]</td><td>$allOrders[address]</td><td>$allOrders[comment]</td><td>$allOrders[payment]</td><td>$allOrders[callback]</td><td>$allOrders[date]</td>", "</tr>";
    } while (!empty($allOrders));

} catch (PDOException $e) {
    echo $e->getMessage();
}
