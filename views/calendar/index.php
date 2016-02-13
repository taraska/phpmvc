<div class="content">
    <?php if (Session::get('loggedIn') and Session::get('role') == 'admin'): ?>
        <form action="<?php echo MAIN_URL; ?>calendar/input/" method="post">
            <?php echo date('D:M:Y'); ?><br/>
            Задание <input type="text" name="task">
            Дата <input type="date" name="date">
            <input type="submit" value="Записать">
        </form>
    <?php endif; ?>
    <div class="calendar">
        <?php foreach ($this->allList as $value): ?>
            <tr>
                <td><?php echo $value['date'] ?></td><br/>
                <td><?php echo $value['task'] ?></td><br/>
                <td hidden><?php $value['noteid'] ?></td>
                <td><a href="<?php echo MAIN_URL ?>calendar/edit/<?php echo $value['noteid'] ?>">Редактировать</a></td>
                <td><a href="<?php echo MAIN_URL ?>calendar/delete/<?php echo $value['noteid'] ?>">Удалить</a></td><br/>
            </tr>
        <?php endforeach; ?>
    </div>
</div>