<?php
namespace oop2;
ob_start(); ?>

<main>
    <h2>Constructor</h2>
    <article>
        <?php
        class Fruit
        {
            private $name;
            private $color;

            function __construct($name, $color)
            {
                $this->name = $name;
                $this->color = $color;
            }

            function get_name()
            {
                return $this->name;
            }

            function get_color()
            {
                return $this->color;
            }
        }
        ?>

        <?php
        $apple = new Fruit("apple", 'red');
        $banana = new Fruit("banana", 'yellow');

        echo $apple->get_name() . " | " . $apple->get_color() . "<br>";
        echo $banana->get_name() . " | " . $banana->get_color() . "<br>";
        ?>
    </article>
</main>
<?php return ['content' => ob_get_clean()] ?>