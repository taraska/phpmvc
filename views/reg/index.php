<h1><?php echo $this->message ?></h1>
<form method="post" action="<?php echo MAIN_URL; ?>reg/save">
    <label for="name">Логин</label><input type="text" id="name" name="login">
    <label for="pas">Пароль</label><input type="password" id="pas" name="password">
    <input type="submit" value="Зарегистрироваться">
</form>
