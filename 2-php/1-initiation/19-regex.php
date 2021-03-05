<?php
/*
 * RegExp : Regular Expression / Expression régulière
 *
 * Système permettant de chercher / de vérifier le format d'une chaine
 * grâce à un pattern
 */

/*
 * I - Construction
 * Une expression régulière est une chaine construire de cette manière :
 * [DELIMITEUR]expression[/DELIMITEUR]options
 */
// A - Délimiteur : / @ # % ~
// Si un caractère est utilisé en même temps comme délimiteur et comme caractère de la regex, il faut l'échapper
// dans la regex avec le backslash : this : \

// B - Recherche simple
/*
 * /salut/ : recherche exacte
 * /^salut/ : recherche commence par : salut doit être au début de la chaine
 * /salut$/ : recherche termine par : salut doit être en dernière position de la chaine
 * /^salut$/ : recherche exacte combiné à commence et termine par : salut une et une seule fois
 * /salut|bonjour|coucou/ : multichoix : soit salut soit bonjour soit coucou
 *
 */

// C - Recherche avancée : classe de caractères : choix unique parmi un ensemble
/*
 * [0-9] : de 0 à 9
 * [a-z] : de a à z
 * [A-Z] : de A à Z
 * [0-9a-z] de 0 à 9 ou a à Z
 * [0-3ai\-] : de 0 à 3 ou a ou i ou tiret (caractère à échapper, car c'est un caractère spécial en expression regulière)
 *
 * Inverser
 * [^0-3ai\-] : tout sauf de 0 à 3 ou a ou i ou tiret
 *
 * Classes abrégées :
 * \d : [0-9]
 * \w : [a-zA-Z0-9_]
 * \D : [^0-9]
 * \W : [^a-zA-Z0-9_]
 *
 * \n : retour ligne
 * \t : tabulation
 * \s : espace
 * \S : pas un espace
 *
 * . : n'importe quel caractère
 * .{5} : 5 caractères, n'importe lesquels
 */

// D - quantificateurs
/*
 * Préciser combien de fois on veut un caractère
 *
 * Quantificateurs simplifiés :
 *  * Le quantificateur s'applique pour le caractère, ou la classe, ou au groupe de choix entre parenthèse
 *
 * ? : 0 ou 1 fois
 * + : 1 ou plusieurs fois
 * * : 0, 1 ou plusieurs fois
 *
 * /a+b?/ : a au moins une fois suivi d'un b ou non
 *

 */
// /[0-9]*/  0, 1 ou plusieurs chiffres de 0 à 9
/*
 * Quantificateurs bornés :
 * {4} : 4 fois précisément
 * {4,7} : 4 fois minimum, 7 fois maximum
 * {4,} : 4 fois minimum
 * {,7} : 7 fois maximum
 *
 * /coucou (fab|tom){2}/ coucou suivi de soit : fabfab, ou tomtom, ou fabtom ou tomfab
 */

// E - caractères spéciaux / métacaractères
// tous les caractères spéciaux doivent être échappés (on échappe avec backslash) si on recherche textuellement ces caractères :
// ? * + [] () ^ $ .
// le tiret est un ùétacaractère uniquement au sein d'une classe, pas besoin de l'échapper en dehors d'une classe

// F - options
// Après le délimiteur de fin on peut ajotuer des options :
// /A/i : recherche insensible à la casse
// /regex/s : le point (.) peut être également un retour à la ligne \n

// G - Remarques spécifique au HTML dans l'attribut pattern
// pas de délimiteur (du coup pas d'option), et pas de commence par ou termine par

/*
 * II - Utilisation
 * preg_match : retourne le nb d'occurences correspondant au pattern dans la chaine
 * et ça s'arrête à la première
 *
 * preg_match_all :  retourne le nb d'occurences correspondant au pattern dans la chaine
 * jusqu'au bout
 *
 * preg_replace : rechercher les occurences et les remplacer
 */

$str = "J'apprend le dev informatique avec Fab, quel BG. Il connait le PHP, le Java, le JS, le HTML et autres";

// savoir si "Fab" se trouve dans la chaine $str
$result = preg_match("/Tom/", $str);
var_dump($result);

// savoir si PHP ou Java se trouve dans la chaine, et si oui savoir le(s)quel(s)
$matches = [];
$result = preg_match("(PHP|Java)", $str, $matches);
var_dump($result);
var_dump($matches);

$matches = [];
$result = preg_match_all("(PHP|Java)", $str, $matches);
var_dump($result);
var_dump($matches);

$text = "Salut je m'appelle biloute et mon adresse c'est jean@biloute.fr, tu peux aussi me contacter sur jean@mail.fr";

// replace les adresses email par des **
$newText = preg_replace("/[a-zA-Z0-9\-_]+@[a-zA-Z0-9\-_]+\.[a-z]{2,}/", "**", $text, -1, $count);
var_dump($newText);
var_dump($count);

// remplacer les valeurs par des valeurs qui utilisent la valeur d'origine
$text = "Va voir mon site www.monsite.fr, j'ai même fait ce site : supercoolsite.fr";
$newText = preg_replace('/(www\.)?[a-z\-]+\.[a-z]{2}/', "<a href='http://$0'>$0$1$2$</a>", $text);
echo $newText;


$matches = [];
$text = "Va voir mon site www.monsite.fr, j'ai même fait ce site : supercoolsite.fr";
$result = preg_match_all("/(www\.)?[a-z\-]+\.[a-z]{2}/", $text, $matches);
var_dump($matches);

/*
 * Les parenthèses capturantes servent à récupérer les valeurs qui matchent avec le pattern, et ainsi pouvoir
 * savoir pour chaque capture le texte qui s'y trouvait
 * On va utiliser dans preg_replace les variables :
 * $0 : pour l'occurence elle-même entier
 * $1 : pour la valeur dans la premiere parenthèse capturante pour cette occurence
 * $2 : idem pour la deuxieme parenthèse
 * ... et ainsi de suite
 */