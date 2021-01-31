<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131144930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE learn_app_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE learn_app (id INT NOT NULL, link VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, difficulty VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE riddle_learn_app (riddle_id INT NOT NULL, learn_app_id INT NOT NULL, PRIMARY KEY(riddle_id, learn_app_id))');
        $this->addSql('CREATE INDEX IDX_55FAB19ED25EE088 ON riddle_learn_app (riddle_id)');
        $this->addSql('CREATE INDEX IDX_55FAB19E4FC7F2D8 ON riddle_learn_app (learn_app_id)');
        $this->addSql('ALTER TABLE riddle_learn_app ADD CONSTRAINT FK_55FAB19ED25EE088 FOREIGN KEY (riddle_id) REFERENCES riddle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE riddle_learn_app ADD CONSTRAINT FK_55FAB19E4FC7F2D8 FOREIGN KEY (learn_app_id) REFERENCES learn_app (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE riddle DROP app_link');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE riddle_learn_app DROP CONSTRAINT FK_55FAB19E4FC7F2D8');
        $this->addSql('DROP SEQUENCE learn_app_id_seq CASCADE');
        $this->addSql('DROP TABLE learn_app');
        $this->addSql('DROP TABLE riddle_learn_app');
        $this->addSql('ALTER TABLE riddle ADD app_link VARCHAR(255) DEFAULT NULL');
    }
}
