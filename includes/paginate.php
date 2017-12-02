<?php

if (($mostrar_pag = get('pagina'))):
    if (($mostrar_pag > 0) && ($mostrar_pag <= $total_paginas)):
        $inicio = ($mostrar_pag - 1) * $por_pagina;
        $fim = $inicio + $por_pagina;
    else:
        $inicio = 0;
        $fim = $por_pagina;
    endif;
else:
    $inicio = 0;
    $fim = $por_pagina;
endif;

$page = intval(get('pagina'));
$tpages = $total_paginas;

if ($page <= 0):
    $page = 1;
endif;
