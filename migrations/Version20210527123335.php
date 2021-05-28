<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210527123335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, description LONGTEXT NOT NULL, allday TINYINT(1) DEFAULT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, wilfer_id INT NOT NULL, author_id INT NOT NULL, content VARCHAR(255) NOT NULL, note INT NOT NULL, date DATETIME NOT NULL, is_approuved TINYINT(1) DEFAULT NULL, INDEX IDX_9474526C263047FC (wilfer_id), INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birth_at DATETIME NOT NULL, email VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, other_reason LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entertainement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entertainement_image (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CFF992371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, subject LONGTEXT NOT NULL, feedback LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, phone BIGINT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_wilfer (user_id INT NOT NULL, wilfer_id INT NOT NULL, INDEX IDX_CDBEE200A76ED395 (user_id), INDEX IDX_CDBEE200263047FC (wilfer_id), PRIMARY KEY(user_id, wilfer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wilfer (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, birth_at DATETIME NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wilfer_image (id INT AUTO_INCREMENT NOT NULL, wilfer_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F9073CC4263047FC (wilfer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entertainement_image ADD CONSTRAINT FK_CFF992371F7E88B FOREIGN KEY (event_id) REFERENCES entertainement (id)');
        $this->addSql('ALTER TABLE user_wilfer ADD CONSTRAINT FK_CDBEE200A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_wilfer ADD CONSTRAINT FK_CDBEE200263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wilfer_image ADD CONSTRAINT FK_F9073CC4263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entertainement_image DROP FOREIGN KEY FK_CFF992371F7E88B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE user_wilfer DROP FOREIGN KEY FK_CDBEE200A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C263047FC');
        $this->addSql('ALTER TABLE user_wilfer DROP FOREIGN KEY FK_CDBEE200263047FC');
        $this->addSql('ALTER TABLE wilfer_image DROP FOREIGN KEY FK_F9073CC4263047FC');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE entertainement');
        $this->addSql('DROP TABLE entertainement_image');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_wilfer');
        $this->addSql('DROP TABLE wilfer');
        $this->addSql('DROP TABLE wilfer_image');
    }
}
