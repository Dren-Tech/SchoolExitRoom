<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210107154504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE escape_room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE introduction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE riddle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE riddle_hint_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE escape_room (id INT NOT NULL, code VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE introduction (id INT NOT NULL, escape_room_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, text TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5005424B5AD703D ON introduction (escape_room_id)');
        $this->addSql('CREATE TABLE riddle (id INT NOT NULL, escape_room_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, text TEXT DEFAULT NULL, entry_code VARCHAR(255) DEFAULT NULL, solution_code VARCHAR(255) NOT NULL, is_unlocked BOOLEAN NOT NULL, identifier VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6C00AA81B5AD703D ON riddle (escape_room_id)');
        $this->addSql('CREATE TABLE riddle_hint (id INT NOT NULL, title VARCHAR(255) NOT NULL, text TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE riddle_hint_riddle (riddle_hint_id INT NOT NULL, riddle_id INT NOT NULL, PRIMARY KEY(riddle_hint_id, riddle_id))');
        $this->addSql('CREATE INDEX IDX_14DCBF0655113FE ON riddle_hint_riddle (riddle_hint_id)');
        $this->addSql('CREATE INDEX IDX_14DCBF06D25EE088 ON riddle_hint_riddle (riddle_id)');
        $this->addSql('ALTER TABLE introduction ADD CONSTRAINT FK_F5005424B5AD703D FOREIGN KEY (escape_room_id) REFERENCES escape_room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE riddle ADD CONSTRAINT FK_6C00AA81B5AD703D FOREIGN KEY (escape_room_id) REFERENCES escape_room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE riddle_hint_riddle ADD CONSTRAINT FK_14DCBF0655113FE FOREIGN KEY (riddle_hint_id) REFERENCES riddle_hint (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE riddle_hint_riddle ADD CONSTRAINT FK_14DCBF06D25EE088 FOREIGN KEY (riddle_id) REFERENCES riddle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE introduction DROP CONSTRAINT FK_F5005424B5AD703D');
        $this->addSql('ALTER TABLE riddle DROP CONSTRAINT FK_6C00AA81B5AD703D');
        $this->addSql('ALTER TABLE riddle_hint_riddle DROP CONSTRAINT FK_14DCBF06D25EE088');
        $this->addSql('ALTER TABLE riddle_hint_riddle DROP CONSTRAINT FK_14DCBF0655113FE');
        $this->addSql('DROP SEQUENCE escape_room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE introduction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE riddle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE riddle_hint_id_seq CASCADE');
        $this->addSql('DROP TABLE escape_room');
        $this->addSql('DROP TABLE introduction');
        $this->addSql('DROP TABLE riddle');
        $this->addSql('DROP TABLE riddle_hint');
        $this->addSql('DROP TABLE riddle_hint_riddle');
    }
}
