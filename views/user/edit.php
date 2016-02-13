<div class="edit_user">
    <form method="post" action="<?php echo MAIN_URL; ?>user/editSave/<?php echo $this->user[0]['userid']; ?>">
        <label>Login</label><input type="text" name="login" value="<?php echo $this->user[0]['login']; ?>"><br/>
        <label>Password</label><input type="password" name="password"/><br/>
        <label>Role</label>
        <select name="role">
            <option value="admin" <?php if ($this->user[0]['role'] == 'admin') echo 'selected'; ?>>admin</option>
            <option value="default" <?php if ($this->user[0]['role'] == 'default') echo 'selected'; ?>>taras</option>
            <option value="user" <?php if ($this->user[0]['role'] == 'user') echo 'selected'; ?>>user</option>
        </select><br/>
        <label>&nbsp;</label><input type="submit" value="Сохранить"/>
    </form>
</div>