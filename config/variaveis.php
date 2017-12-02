<?php

/* Constantes para uso geral */
define('URI', filter_input(INPUT_SERVER, 'REQUEST_URI'));
define('DOCUMENT_ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/dashboard');
define('BASE', '//' . filter_input(INPUT_SERVER, 'HTTP_HOST') . '/dashboard');
