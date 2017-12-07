<?php

##
# APAGAR ESSA LINHA APÓS A DEFINIÇÃO DA SENHA
##
#trigger_error('EXECUTAR NOVO BANCO OU ALTERE O TIPO DO CAMPO "promo_cpf" DE int(11) PARA char(15)', E_USER_WARNING);
#trigger_error('Definir a senha do banco de dados', E_USER_ERROR);

/** Define o fuso horário */
date_default_timezone_set('America/Recife');

/* Constantes para uso em banco de dados */
define('DBUSER', 'root');
define('DBPASS', '211190');
define('DBHOST', 'localhost');
define('DBNAME', 'teste');
