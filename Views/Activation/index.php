<div class="wrapper-box">
    <div class="box">
        <h1 class="title center">Mail activation</h1>
        <br />
        <?php if (isset($error)) : ?>
            <p class="error"><?= $error ?></p>
            <br />
            <p>Ссылка для активации не получена? <a href="index.php/activation/resend">Отправить новое письмо с подтверждением.</a></p>
        <?php endif; if (isset($success)) :?>
            <p><?= $success ?></p>
        <?php endif; if (isset($already_confirmed)) : ?>
            <p><?= $already_confirmed ?></p>
        <?php endif; ?>
    </div>
</div>