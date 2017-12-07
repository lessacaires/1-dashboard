<?php

session_start();

/** Inclusão do script das configurações do sistema. */
require('../config/config.php');

/** Inclusão do script das constantes, MACROS e variáveis globais. */
require('../config/variaveis.php');

/** Inclusão do script para trabalhar com SQL. */
require('../lib/sql.php');

/** Inclusão do script para trabalhar com sessões. */
require('../lib/sessao.php');

/** Inclusão do script com funções para manipulação do conteúdo. */
require('../lib/conteudo.php');
