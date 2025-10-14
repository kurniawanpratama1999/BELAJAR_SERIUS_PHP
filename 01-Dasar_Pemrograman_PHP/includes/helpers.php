<?php
function rupiah($n)
{
    return 'Rp' . number_format($n, 0, ',', '.');
}
return true;