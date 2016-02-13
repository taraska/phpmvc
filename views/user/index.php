<div class="content">
    <h1>Пользователи</h1>
    <form action="<?php echo MAIN_URL; ?>user/create" method="post">
        <label>Логин</label><input type="text" name="login"><br/>
        <label>Пароль</label><input type="text" name="password"><br/>
        <label>Роль</label><select name="role">
            <option value="user">User</option>
            <option value="default">Guy</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" value="Создать">
    </form>
    <hr/>
    <?php foreach ($this->userList as $key => $value)  : ?>
        <table>
            <tr>
                <td><?php echo $value['userid']; ?></td>
                <td><?php echo $value['role']; ?></td>
                <td><?php echo $value['login']; ?></td>
                <td><a href="<?php MAIN_URL ?>user/edit/<?php echo $value['userid']; ?>">Редактировать</a>
                    <a href="<?php MAIN_URL ?>user/delete/<?php echo $value['userid']; ?>">Удалить</a></td>
            </tr>
        </table>
    <?php endforeach; ?>
</div>