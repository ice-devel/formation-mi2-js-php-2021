<?php
/*
 * Les datetimes
 */

// par défaut la date actuelle
$now = new DateTime();

// afficher la date formattée
echo $now->format("d/m/Y H:i:s")."<br>";
echo $now->format("Y-m-d H:i:s")."<br>";

// choisir une date précise manuellement
$datetime = new DateTime('2019-06-04');
echo $datetime->format("d/m/Y H:i:s")."<br>";

// générer une date avec des mots-clés
$yesterday = new DateTime("yesterday");
$tomorrow = new DateTime("tomorrow");
echo $yesterday->format("d/m/Y H:i:s")."<br>";
echo $tomorrow->format("d/m/Y H:i:s")."<br>";

$lastDayPreviousMonth = new DateTime("last day of previous month");
echo $lastDayPreviousMonth->format("d/m/Y H:i:s")."<br>";

/* Insertion en bdd */
class User {
    private string $name;
    private DateTime $createdAt;

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}

$user = new User();
$user->setCreatedAt(new DateTime());

// bdd
$sql = "INSERT INTO user(name, created_at) VALUES (:name, :createdAt)";
/*
$stmt->exexute([
    ':name' => $user->getName(),
    ':createdAt' => $user->getCreatedAt()->format("Y-m-d H:i:s"),
]);
*/

$sql = "SELECT * FROM user";
$usersTab = [];
foreach ($usersTab as $u) {
    // $createdAt = new DateTime($u['created_at']);
    $user = new User($u['id'], $u['name'], new DateTime($u['created_at']));
}

$user->getCreatedAt()->format("d/m/Y H:i");

/*
 * Ajouter / soutraire des intervals
 */
$date = new DateTime("2021-08-31 15:00:00");
// il faut d'abord un interval
$dateInterval2Month = new DateInterval("P1M");
// puis utiliser cet interval pour l'ajouter à un datetime
$date->add($dateInterval2Month);
echo $date->format('d/m/Y H:i:s')."<br>";
// ou le soustraire d'un datetime
$date->sub($dateInterval2Month);
echo $date->format('d/m/Y H:i:s')."<br>";

$date = new DateTime();
$dateInterval2Month2Day = new DateInterval("P1M2D");
$date->add($dateInterval2Month2Day);
echo $date->format('d/m/Y H:i:s')."<br>";

// faire la différence entre deux date
$date = new DateTime();
$yesterday = new DateTime("yesterday");
$dateInterval = $date->diff($yesterday);
echo "<pre>";
echo $dateInterval->format("%y %m %d");

// pas de souc pour comparer des datetime
if ($date > $yesterday) {
    // oui aujourd'hui est plus grand qu'hier
}

