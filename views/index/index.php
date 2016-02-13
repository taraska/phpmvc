<div class="content">
    <div>Information</div>
</div>
<?php if (Session::get('loggedIn') == true): ?>
    <div class="files">
        <h2>Файлы</h2>
        <form enctype="multipart/form-data" action="<?php MAIN_URL ?>index/loadFile" method="post">
            <input type="file" name="files[]">
            <input type="file" name="files[]">
            <input type="file" name="files[]">
            <input type="submit" value="Отправить">
        </form>
    </div>
    <?php if (empty($_GET['url'])) : ?>
        <div>
            <a href="<?php MAIN_URL ?>index"><h2>Показать файлы</h2></a>
        </div>
    <?php endif; ?>
    <?php if (!empty($_GET['url'])) : ?>
        <?php foreach ($this->result_view as $value): ?>
            <div>
                <a href="<?php MAIN_URL ?>index/download/?action=view&amp;id=<?php echo $value; ?>"><?php echo $value; ?></a>
            </div>
            <form action="<?php MAIN_URL ?>index/download" method="get">
                <div>
                    <input type="hidden" name="action" value="download"/>
                    <input type="hidden" name="id" value="<?php echo $value; ?>"/>
                    <input type="submit" value="Скачать">
                </div>
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
