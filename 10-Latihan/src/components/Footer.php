<?php function FooterComponent()
{
    ob_start(); ?>
    <footer>
        <p>dibuat oleh Kurniawan Pratama</p>
    </footer>
    <?php return ob_get_clean();
} ?>