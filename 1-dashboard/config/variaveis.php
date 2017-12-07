<?php

/* Constantes para uso geral */
define('DOCUMENT_ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/1-dashboard');
define('BASE', '//' . filter_input(INPUT_SERVER, 'HTTP_HOST') . '/1-dashboard');

/* Controle de LOG */
define('LOG_INSERIR', 0);
define('LOG_ATUALIZAR', 1);
define('LOG_EXCLUIR', 2);
define('LOG_LOGIN', 3);
define('LOG_LOGOUT', 4);
define('LOG_BOQUEIO', 5);
define('LOG_IN_PROMOTOR', 6);
define('LOG_OUT_PROMOTOR', 7);
