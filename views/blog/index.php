<div class="content">
    <?php if (Session::get('role') == 'admin' || Session::get('role') == 'user') : ?>
        <h2><?php if (isset($this->message)) {
                echo $this->message;
            } else
                echo 'Введите текст'; ?></h2>
        <form class="randomInsert" action="<?php echo MAIN_URL; ?>blog/Insert/" method="post">
            Сообщение поста<textarea name="text" placeholder="Сообщение"></textarea><br/>
            Название поста<input type="text" name="title"><br/>
            <input type="submit" value="Запись"/>
        </form>
    <?php endif; ?>
    <br/>
    <div class="listInserts">
        <?php foreach ($this->result as $value): ?>
            <form class="post" action="<?php echo MAIN_URL; ?>blog/DeleteListings/" method="post">
                <input type="hidden" name="dataid" value="<?php echo $value['dataid']; ?>">
                <div name="text"><?php echo $value['text']; ?></div>
                <div name="title"><?php echo $value['title']; ?></div>
                <?php if (Session::get('role') == 'admin'): ?>
                    <input type="submit" value="Удалить">
                <?php endif; ?>
            </form>
        <?php endforeach; ?>
    </div>
</div>