<!DOCTYPE html>
<html>
<?php include 'shared/head.php'; ?>
<body>
<?php include 'shared/banner.php'; ?>
<?php include 'shared/menu.php'; ?>
<?php include 'components/'. $page .'/index.php'; ?>
<?= $jsHtml; ?>
<script>
    $(document).ready(function () {
        $("#cssmenu li").each(function() {
            $(this).removeClass('active');
        });
        $('#<?= $page ?>').addClass('active');

        var banner = $('#banner');

        banner.removeAttr('class');
        banner.addClass('<?= $picture ?>');
    });
</script>
</body>
</html>