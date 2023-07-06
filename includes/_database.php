
<?php

try {
    $dbCo = new PDO(
        'mysql:host=localhost;dbname=booklub;charset=utf8',
        'lea',
        '123456'
    );
    $dbCo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (Exception $e) {
    die('Unable to connect to the database.
' . $e->getMessage());
}
