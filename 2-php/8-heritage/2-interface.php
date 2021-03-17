<?php
/*
 * Interface :
 * Une interface est un contrat avec une classe : on va forcer une classe à faire quelque-chose
 * Cela permet une méthode de travail où les développeurs ce qu'on leur a obligé d'implémenter
 * Et cela va permettre de typer des variables pour s'assurer qu'elles ont la possibilité d'avoir
 * le comportement attendu
 *
 * On peut implémenter autant d'interface qu'on l'on veut sur une classe
 * Une interface peut hériter d'une ou plusieurs interfaces : la classe qui implémente
 * l'interface mère doit définir les méthodes de chacune des interfaces en cascade
 *
 * On ne définit jamais le corps des fonctions dans les interfaces, uniquement les signatures.
 * Ce sont les classes qui implémentent les interfaces qui doivent définir le corps.
 *
 */
interface Recruiter extends ContractReader {
    public function hire(Salary $salary);
}

interface ContractReader {
    public function readContract($contract);
}

interface StaffRepresentative {
    public function represents(array $salaries);
}

class Salary {

}

class Developer extends Salary implements StaffRepresentative, ContractReader {
    public function represents(array $salaries) {}
    public function readContract($contract) {}
}

class Designer extends Salary implements StaffRepresentative {
    public function represents(array $salaries) {}
}

class CEO implements Recruiter {
    public function hire(Salary $salary) {
        echo "CEO hires";
    }
    public function readContract($contract) {}
}

class Chief extends Salary implements Recruiter, StaffRepresentative {
    public function hire(Salary $salary)
    {
        echo "Chief hires";
    }
    public function readContract($contract) {}

    public function represents(array $salaries) {}
}

class Service {
    public function startProcess(Salary $salary, Recruiter $recruiter) {
        echo "Le process d'embauche commence";
        $recruiter->hire($salary);
    }
}

$designer = new Designer();
$developer = new Developer();
$ceo = new CEO();

// on peut également tester soi une classe implémente une interface grâce à instanceof
if (!$ceo instanceof Recruiter) {
    throw new Exception('t\'es teubé ou quoi lis la doc');
}

$service = new Service();
$service->startProcess($designer, $ceo);