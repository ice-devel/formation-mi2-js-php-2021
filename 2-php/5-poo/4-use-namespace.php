<?php
/*
 * namespace : espace de nom
 * Les espaces de nom vont permettre de séparer nos classes dans des "dossiers virtuels"
 * On pourra ainsi avoir plusieurs classes qui ont le même nom dans la même application
 */
require_once("3-namespace.php");
require_once("3-namespace.php");

// pour utiliser une classe qui se trouve dans un namespace :
use Fab\Entity\Message;

// pour utiliser deux classes qui ont le même nom dans le même fichier
// il faut lui donner un alias dans le use
use Fab\Forum\Message as ForumMessage;

$message = new Message();
var_dump($message);


$message = new ForumMessage();


