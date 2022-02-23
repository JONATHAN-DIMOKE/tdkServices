<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 26/08/2020
 * Time: 07:36
 */
    if(!defined('BD_SERVEUR')) define ('BD_SERVEUR','127.0.0.1');
    if(!defined('BD_UTILISATEUR')) define ('BD_UTILISATEUR','root');
    if(!defined('BD_PASSWORD')) define ('BD_PASSWORD','');
    if(!defined('BD_NOM')) define ('BD_NOM','bd_tdkservices');
    if(!defined('BD_DSN')) define ('BD_DSN','mysql:host='.BD_SERVEUR.';dbname='.BD_NOM);