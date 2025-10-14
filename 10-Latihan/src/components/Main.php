<?php function MainComponent() { ob_start(); ?>
    <main>ini main</main>
<?php return ob_get_clean(); } ?>