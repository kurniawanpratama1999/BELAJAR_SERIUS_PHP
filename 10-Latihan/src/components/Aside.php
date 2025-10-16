<?php function AsideComponent()
{
    ob_start(); ?>
    <aside class="bg-neutral-100 col-start-1 w-[300px] rounded-md shadow p-5 overflow-x-hidden overflow-y-auto">
        <h1>Belajar PHP</h1>
        <nav>
            <ul>
                <li>
                </li>
            </ul>
        </nav>
    </aside>
    <?php return ob_get_clean();
} ?>