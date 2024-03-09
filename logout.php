<?php

session_start();
unset($_SESSION['account_id']);

header('location: index.php');