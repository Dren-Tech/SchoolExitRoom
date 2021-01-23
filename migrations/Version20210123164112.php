<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210123164112 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add nextRiddle property and relation to Riddle';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE riddle ADD next_riddle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE riddle ADD CONSTRAINT FK_6C00AA8195D435BB FOREIGN KEY (next_riddle_id) REFERENCES riddle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6C00AA8195D435BB ON riddle (next_riddle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE riddle DROP CONSTRAINT FK_6C00AA8195D435BB');
        $this->addSql('DROP INDEX IDX_6C00AA8195D435BB');
        $this->addSql('ALTER TABLE riddle DROP next_riddle_id');
    }
}
