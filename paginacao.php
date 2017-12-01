<?php


class paginacao{
	public function paginar($reload, $page, $tpages) {
		$adjacents = 2;
		$prevlabel = "&lsaquo; Voltar";
		$nextlabel = "Pr&oacute;ximo &rsaquo;";
		$out = "";
		// previous
		if ($page == 1) {
			$out.= "<li class=\"disabled\"><a  href=\"\">" . $prevlabel . "</a>\n</li>";
		}  else {
			$out.= "<li><a  href=\"" . $reload . "&amp;pagina=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li>";
		}
	  
		$pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
		$pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
		
		for ($i = $pmin; $i <= $pmax; $i++) {
			if ($i == $page) {
				$out.= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
			}elseif (($i == $pmin) && !isset($_GET['pagina'])) {
				$out.= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
			}else {
				$out.= "<li><a  href=\"" . $reload . "&amp;pagina=" . $i . "\">" . $i . "</a>\n</li>";
			}
		}
		
		if ($page < ($tpages - $adjacents)) {
			$out.= "<li><a href=\"" . $reload . "&amp;pagina=" . $tpages . "\">" . $tpages . "</a>\n</li>";
		}
		// next
		if ($page < $tpages) {
			$out.= "<li><a  href=\"" . $reload . "&amp;pagina=" . ($page + 1) . "\">" . $nextlabel . "</a>\n</li>";
		} else {
			$out.= "<li class=\"disabled\"><a  href=\"\">" . $nextlabel . "</a>\n</li>";
		}
		$out.= "";
		echo $out;
	}// end function paginar
}// end class
?>