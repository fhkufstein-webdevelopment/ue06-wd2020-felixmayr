<?php

require_once('includes/classes/Database.php');

define('DB_HOST', 'localhost');
define('DB_NAME', 'ue6_db');
define('DB_USER', 'ue6_user');
define('DB_PASS', 'Hello123');

$db = new Database();
$cryptedPassword = password_hash('testpassword', PASSWORD_BCRYPT);
$username = "peter";

$cryptedPassword = $db->escapeString($cryptedPassword);
$username = $db->escapeString($username);

// $sql = "INSERT INTO user(name,`password`) VALUES('" . $username . "','" . $cryptedPassword . "')";
// $db->query($sql);

$sql = "SELECT * FROM user WHERE name='" . $username . "'";
$result = $db->query($sql);
if ($db->numRows($result) > 0)
{
    $row = $db->fetchAssoc($result);
    if (password_verify("testpassword", $row['password'])) {
        echo "User: " . $username . ", ID: " . $row['id'] . ", Passwort: testpassword";
    } else {
        echo "User found but wrong PW!";
    }
} else {
    echo "No User found.";
}
