<?php
header('Content-Type: text/html; charset=utf-8');
require_once('functions.php');
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <title>Orders</title>
</head>
<body>
<div class="wrapper">
  <header class='header'>
    <div class='header__container container'>
      <div class='header__logo'>
        <a href="index.php">
          <img src='img/logo.png' alt='cover'/>
        </a>
      </div>
      <div class="header__burger">
        <span></span>
      </div>
      <div class="header__menu--outer">
        <div class="header__menu--inner">
          <div class='header__menu--link create-order-button'>Create new order</div>
        </div>
      </div>
      <div class='header__menu menu'>
        <ul class='menu__list'>
          <li class='menu__item'>
            <div class='menu__link create-order-button'>Create new order</div>
          </li>
        </ul>
      </div>

    </div>
  </header>
  <div class="page">
    <div class="container">