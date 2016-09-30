<?php

require '/vendor/autoload.php';

use InternetBS\Api;

$domain = "buyadomainfortheapitest.com";

$conn = new Api("testapi", "testpass");

try {

    $params = array(
        'Domain' => $domain
    );

    $res = $conn->execute("/Domain/Check", $params);

    print_r($res);

} catch (Exception $ex) {
    print_r($ex->getMessage());
}