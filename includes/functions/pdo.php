<?php
function pdo() {
  static $pdo;

  return $pdo ?? $pdo = new PDO(
    'mysql:host=localhost;'.'dbname=project;charset=utf8',
    'root',
    '',
    array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_PERSISTENT => true));
}
