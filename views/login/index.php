<div class="content">
    <h2><?php echo $this->message; ?></h2>
    <h1>Login</h1>

    <form action="<?php echo MAIN_URL;?>login/run" method="post">
        <label>Ваш логин</label><input type="text" name="login"/><br/>
        <label>Ваш пароль</label><input type="password" name="password"/><br/>
        <label></label><input type="submit" value="Войти"/>
    </form>
</div>