<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $this->metaDescription; ?>">
    <meta name="author" content="<?php echo $this->metaAuthor; ?>">
    <meta name="keywords" content="<?php echo $this->metaKeywords; ?>">
    <title><?php echo $this->title; ?></title>
    <link href="" rel="icon">
    <noscript>Ваш браузер не поддерживает JS</noscript>
</head>
<body>
<header>
    <div class="breadCrumbs">
        <?php if (isset($this->breadCrumbs)) {
            foreach ($this->breadCrumbs as $key => $value): ?>
                <li><a href="<?php echo MAIN_URL . $value[0]; ?>"
                       class=""><?php echo $value[1]; ?></a></li>
            <?php endforeach;
        } ?>
    </div>
</header>
<div class="error">
    <h2>
        <?php echo $this->message; ?>
    </h2>
    <input type="hidden" value="<?php echo $this->errorMessage; ?>">
    <div class="variation">
        <a href="<?php echo MAIN_URL; ?>">На главную страницу сайта</a>
    </div>
</div>
</body>
</html>