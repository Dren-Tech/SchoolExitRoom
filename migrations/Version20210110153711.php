<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110153711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add youtube_link to Room, Introduction and Riddle';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE escape_room ADD youtube_link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE introduction ADD youtube_link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE riddle ADD youtube_link VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE riddle DROP youtube_link');
        $this->addSql('ALTER TABLE escape_room DROP youtube_link');
        $this->addSql('ALTER TABLE introduction DROP youtube_link');
    }
}
