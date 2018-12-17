<!DOCTYPE html>
<html>
<?php include 'shared/head.php'; ?>
<body>

<?php include 'shared/banner.php'; ?>
<?php include 'shared/menu.php'; ?>

<div class="top"></div>
<?php include $pagePath; ?>

<?= $jsHtml; ?>
<script>
    $(document).ready(function () {
        $("#cssmenu li").each(function() {
            $(this).removeClass('active');
        });
        $('#<?= $page ?>').addClass('active');
    });
</script>
</body>
</html>