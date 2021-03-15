<?php
/*
 * Opérateur de résolution de portée :
 * permet d'accéder à des constantes ainsi qu'à des membres statiques (propriété ou méthode)
 * Scope resolution operator
 *
 * Les membres statiques sont liés à la classe elle-même et non pas à une instance en particulier
 */

require 'entity/Player.php';

echo Player::EXPERIENCE;
echo "<br>";
echo Player::getNbPlayers();

