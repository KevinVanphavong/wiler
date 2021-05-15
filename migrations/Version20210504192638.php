<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504192638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE wilfer_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wilfer_user (wilfer_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B44F9C6DA76ED395 (user_id), INDEX IDX_B44F9C6D263047FC (wilfer_id), PRIMARY KEY(wilfer_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE wilfer_user ADD CONSTRAINT FK_B44F9C6D263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wilfer_user ADD CONSTRAINT FK_B44F9C6DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
