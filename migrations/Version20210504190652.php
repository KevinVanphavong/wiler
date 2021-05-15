<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504190652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_wilfer (user_id INT NOT NULL, wilfer_id INT NOT NULL, INDEX IDX_CDBEE200A76ED395 (user_id), INDEX IDX_CDBEE200263047FC (wilfer_id), PRIMARY KEY(user_id, wilfer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wilfer_user (wilfer_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B44F9C6D263047FC (wilfer_id), INDEX IDX_B44F9C6DA76ED395 (user_id), PRIMARY KEY(wilfer_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_wilfer ADD CONSTRAINT FK_CDBEE200A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_wilfer ADD CONSTRAINT FK_CDBEE200263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wilfer_user ADD CONSTRAINT FK_B44F9C6D263047FC FOREIGN KEY (wilfer_id) REFERENCES wilfer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wilfer_user ADD CONSTRAINT FK_B44F9C6DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wilfer DROP FOREIGN KEY FK_A8ECF93D7E3C61F9');
        $this->addSql('DROP INDEX IDX_A8ECF93D7E3C61F9 ON wilfer');
        $this->addSql('ALTER TABLE wilfer DROP owner_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_wilfer');
        $this->addSql('DROP TABLE wilfer_user');
        $this->addSql('ALTER TABLE wilfer ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wilfer ADD CONSTRAINT FK_A8ECF93D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A8ECF93D7E3C61F9 ON wilfer (owner_id)');
    }
}
