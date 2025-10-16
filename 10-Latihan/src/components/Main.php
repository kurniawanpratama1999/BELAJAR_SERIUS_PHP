<?php function MainComponent($content)
{
    ob_start(); ?>
    <main><?= $content ?></main>
    <?php return ob_get_clean();
} ?>