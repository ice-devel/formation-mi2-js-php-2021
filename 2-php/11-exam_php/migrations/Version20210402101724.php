<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402101724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_trainee (skill_id INT NOT NULL, trainee_id INT NOT NULL, INDEX IDX_5C3313CE5585C142 (skill_id), INDEX IDX_5C3313CE36C682D0 (trainee_id), PRIMARY KEY(skill_id, trainee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_trainee ADD CONSTRAINT FK_5C3313CE5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_trainee ADD CONSTRAINT FK_5C3313CE36C682D0 FOREIGN KEY (trainee_id) REFERENCES trainee (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE trainee_skill');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trainee_skill (trainee_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_B103175A36C682D0 (trainee_id), INDEX IDX_B103175A5585C142 (skill_id), PRIMARY KEY(trainee_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE trainee_skill ADD CONSTRAINT FK_B103175A36C682D0 FOREIGN KEY (trainee_id) REFERENCES trainee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trainee_skill ADD CONSTRAINT FK_B103175A5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE skill_trainee');
    }
}
