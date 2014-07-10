<?php

require_once 'lib/Wink/Account.php';

use Wink\Account;

$config = json_decode(file_get_contents('config.json'), true);

$account = new Account(
    $config['client_id'],
    $config['client_secret'],
    $config['username'],
    $config['password']
);

$account->login();

print_r($account->info());
print_r($account->devices());
print_r($account->services());