<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/Head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/Aside.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/Main.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/components/Footer.php';

?>

<?php function DefaultLayout($content, $meta = [], $middleware = false)
{
    ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en">

    <?= HeadComponent(); ?>

    <body class="bg-slate-200">
        <div class="grid grid-cols-[auto_1fr] h-dvh p-3 gap-3">
            <?= AsideComponent(); ?>
            <div class="bg-neutral-100 p-5 rounded-md shadow">
                <?= MainComponent(); ?>
                <?= FooterComponent(); ?>
            </div>
        </div>
    </body>

    </html>
    <?php return ob_get_clean();
} ?>