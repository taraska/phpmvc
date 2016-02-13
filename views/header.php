<!DOCTYPE>
<html>
<head>
    <title><?php echo $this->title; ?></title>
    <meta charset="utf-8">
    <meta content="text/html" http-equiv="Content-Type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="HTML5, Календарь, Блог, Taras-Ivannikov"/>
    <meta name="author" content="Тарас Иванников"/>
    <meta name="description" content="Календарь дел и блог Иванникова Тараса"/>
    <!-- Через какое время обновиться сайт -->
    <meta http-equiv="refresh" content="50000000000000"/>
    <link rel="stylesheet" href="" type="text/css">
    <link rel="shorcut icon" href="" type="image/x-icon">
    <noscript>Ваш браузер не поддерживает JavaScript, включите его</noscript>
</head>
<body>
<div class="header">
    <a href="<?php echo MAIN_URL ?>index">Главная</a>
    <a href="<?php echo MAIN_URL ?>calendar">Календарь</a>
    <a href="<?php echo MAIN_URL ?>blog">Блок</a>
    <?php if (Session::get('loggedIn') == false): ?>
        <a href="<?php echo MAIN_URL ?>login">Логин</a>
    <?php endif; ?>
    <?php if (Session::get('loggedIn') == true): ?>
        <a href="<?php echo MAIN_URL ?>logout">Выйти</a>
    <?php endif; ?>
    <?php if (Session::get('loggedIn') == false): ?>
        <a href="<?php echo MAIN_URL ?>reg">Регистрация</a>
    <?php endif; ?>
    <?php if (Session::get('role') == 'admin'): ?>
        <a href="<?php echo MAIN_URL ?>user">Пользователи</a>
    <?php endif; ?>
</div>