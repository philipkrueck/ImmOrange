<?php
function pdo() {
  static $pdo;

  return $pdo ?? $pdo = new PDO(
    'mysql:host=mysql5.hsba-training.de;dbname=db587634_33;charset=utf8',
    'db587634_33',
    'XWbr8m61p:UC',
    array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_PERSISTENT => true));
}
