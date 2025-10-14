<?php function Calculator()
{
    ob_start(); ?>
    <div>
        <section></section>
    </div>
    <?php return ob_get_clean();
} ?>