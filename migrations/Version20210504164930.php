<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504164930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birth_at DATETIME NOT NULL, email VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, other_reason LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entertainement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, subject LONGTEXT NOT NULL, feedback LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, wilfer_id INT NOT NULL, artist VARCHAR(255) NOT NULL, song VARCHAR(255) NOT NULL, INDEX IDX_D782112D263047FC (wilfer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, phone BIGINT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id)');
        $this->addSql('ALTER TABLE wilfer ADD owner_id INT DEFAULT NULL, ADD birth_at DATETIME NOT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP birth_date');
        $this->addSql('ALTER TABLE wilfer ADD CONSTRAINT FK_A8ECF93D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A8ECF93D7E3C61F9 ON wilfer (owner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wilfer DROP FOREIGN KEY FK_A8ECF93D7E3C61F9');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE entertainement');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_A8ECF93D7E3C61F9 ON wilfer');
        $this->addSql('ALTER TABLE wilfer ADD birth_date DATE NOT NULL, DROP owner_id, DROP birth_at, DROP updated_at');
    }
}
