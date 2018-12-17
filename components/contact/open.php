<?php
use Classes\Entities\Opening;
?>
<div class="opening-hours-container">
    <h2>Openingsuren</h2><hr>
    <table class="table bigger-text">
        <?php
        foreach ($openingHours as $open) {
            if ($open instanceof Opening) {
                ?>
                <tr>
                    <td class="text-right"><?= strtoupper($open->getDay()); ?></td>
                    <?php
                    if ($open->isClosed()) {
                        ?>
                        <td class="text-left" colspan="2">GESLOTEN</td>
                        <?php
                    } else {
                        ?>
                        <td class="text-left"><?= $open->getFrom(); ?></td>
                        <td class="text-left"><?= $open->getUntil(); ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
