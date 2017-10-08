<?php

$input = isset($_GET['name']) ? $_GET['name'] : 'World';

header('Content-type: text/html; charset=utf-8');

printf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'utf-8'));