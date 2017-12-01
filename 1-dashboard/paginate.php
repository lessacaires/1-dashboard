
<?php
    if (isset($_GET['pagina'])) {
		$mostrar_pag = $_GET['pagina'];
		
		if ($mostrar_pag > 0 && $mostrar_pag <= $total_paginas) {
			$inicio = ($mostrar_pag - 1) * $por_pagina;
			$fim = $inicio + $por_pagina;
		} else {
			// error - show first set of results
			$inicio = 0;              
			$fim = $por_pagina;
		}
	} else {
		$inicio = 0;
		$fim    = $por_pagina;
	}
	
	// display pagination
	$page = intval(isset($_GET['pagina']));
	$tpages=$total_paginas;
	if ($page <= 0)
		$page = 1;
	
?>	