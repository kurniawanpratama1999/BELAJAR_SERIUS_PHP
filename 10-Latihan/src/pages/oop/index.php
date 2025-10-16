<?php ob_start(); ?>
<div>
    <section>oop</section>
</div>
<?php return ["content" => ob_get_clean()]; ?>