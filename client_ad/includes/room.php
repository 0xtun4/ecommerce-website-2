<?php
require_once "./const.php";
$room = "adm12";
echo hashroom('id'.$room.SECRET_KEY);
