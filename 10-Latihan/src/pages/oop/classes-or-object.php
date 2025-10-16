<?php
namespace oop1;
$br = fn() => "<br>";
$gap = fn() => "<span> | </span>" ?>

<?php ob_start(); ?>
<div>
    <section>
        <h2>CLASSES or OBJECT</h2>
        <?php
        class Fruit
        {
            public $name;
            public $color;

            function set_name($name)
            {
                $this->name = $name;
            }
            function get_name()
            {
                return $this->name;
            }

            function set_color($color)
            {
                $this->color = $color;
            }
            function get_color()
            {
                return $this->color;
            }
        }
        ?>
        <?php
        $apple = new Fruit();
        $apple->set_name("apple");
        $apple->set_color("red");
        echo $apple->get_name() . $gap();
        echo $apple->get_color() . $br();


        $banana = new Fruit();
        $banana->set_name("banana");
        $banana->set_color("yellow");
        echo $banana->get_name() . $gap();
        echo $banana->get_color() . $br();
        ?>
    </section>

    <section>

    </section>
</div>
<?php return ["content" => ob_get_clean()]; ?>