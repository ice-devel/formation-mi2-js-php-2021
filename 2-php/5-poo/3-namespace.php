<?php
/*
 * namespace : espace de nom
 * Les espaces de nom vont permettre de séparer nos classes dans des "dossiers virtuels"
 * On pourra ainsi avoir plusieurs classes qui ont le même nom dans la même application
 */

namespace Fab\Entity;

/*
 * Formulaire contact
 */
class Message {
    private $name;
    private $email;
}

/*
 * Message échangé sur le forum
 */
namespace Fab\Forum;

class Message {
    private $sender;
    private $topic;
}

$message = new Message();


