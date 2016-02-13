<h1>Редактирование записи</h1>
<form method="post" action="<?php echo MAIN_URL; ?>calendar/editSave/<?php echo $this->note[0]['noteid'];?>">
    <div class="edit">
        <label>Задание</label><input type="text" name="task" value="<?php echo $this->note[0]['task']?>">
        <label>Дата</label><input type="date" name="date" value="<?php echo $this->note[0]['date']?>">
        <input type="submit" value="Сохранить">
    </div>
</form>