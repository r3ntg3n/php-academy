# ООП

```php
$db = new PDO($dsn, $user, $password);
$st = $db->query($query);
$st->rowCount();

$mysql = new MySQLi($host, $user, $password, $dbName);
$st = $mysql->prepare($query);
$result = $st->execute();
$result->rowCount;
```