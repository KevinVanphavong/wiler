<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513202029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wilfer_image (id INT AUTO_INCREMENT NOT NULL, wilfer_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F9073CC4263047FC (wilfer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wilfer_image ADD CONSTRAINT FK_F9073CC4263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id)');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('ALTER TABLE wilfer DROP picture, DROP updated_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, wilfer_id INT NOT NULL, artist VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, song VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_D782112D263047FC (wilfer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id)');
        $this->addSql('DROP TABLE wilfer_image');
        $this->addSql('ALTER TABLE wilfer ADD picture LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD updated_at DATETIME DEFAULT NULL');
    }
}
