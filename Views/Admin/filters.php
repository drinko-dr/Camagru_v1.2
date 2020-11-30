<div class="container">
    <div class="box">
    <h1 class="title center">Create a new filter</h1>
    <br />
    <?php if (!empty($error)) {
        echo '<p class="error-msg center">' . $error . '</p><br />' . PHP_EOL;
    }
    ?>
    <form id="form2" action="/index.php/admin/filters" method="post">
            <input type="text" name="filtername" class="input" placeholder="Filter name">
            <br />
            <input id="filter_upload" type="file" class="input" name="filter" accept="image/x-png, image/jpeg" placeholder="Upload an image" onchange="upload_filter()">
            <br />
            <input id="submit-btn" type="submit" class="button is-info" value="Add new filter" />
    <form>
</div>


<div class="gallery">

<?php if (count($filters > 0)) {
    foreach ($filters as $k) : ?>
        <div class="gallery-item item-padded">
            <img src="<?= $k['path'] ?>" class="gallery-image" alt="<?= $k['name'] ?>">
            <div class="gallery-item-info">

                <ul>
                    <li class="gallery-item-likes">
                        <?= $k['name'] ?>
                    </li><br /><br />
                    <li class="gallery-item-comments">
                        <form name="filter_delete" action="/index.php/admin/delete_filter" method="post">
                            <button type="submit" class="transparent"><i class="fas fa-3x fa-trash white"></i></button>
                            <input type="hidden" name="id" value="<?= $k['id']; ?>">
                        </form> 
                    </li>
                </ul>

            </div>

        </div>
<?php endforeach;
} ?>
</div>

</div>


<script src="/assets/js/filters.js"></script>