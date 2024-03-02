<?php
require_once "const.php";
$room = $_POST['username'];
echo hashroom('id'.$room.SECRET_KEY);
