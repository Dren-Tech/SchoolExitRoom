<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222132441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create entity to save results of riddles from students.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE student_riddle_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE student_riddle_result (id INT NOT NULL, student_id INT NOT NULL, riddle_id INT NOT NULL, result VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_58D3457BCB944F1A ON student_riddle_result (student_id)');
        $this->addSql('CREATE INDEX IDX_58D3457BD25EE088 ON student_riddle_result (riddle_id)');
        $this->addSql('ALTER TABLE student_riddle_result ADD CONSTRAINT FK_58D3457BCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student_riddle_result ADD CONSTRAINT FK_58D3457BD25EE088 FOREIGN KEY (riddle_id) REFERENCES riddle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE student_riddle_result_id_seq CASCADE');
        $this->addSql('DROP TABLE student_riddle_result');
    }
}
