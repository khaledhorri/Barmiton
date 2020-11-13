<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201113184339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recette ADD username_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390ED766068 ON recette (username_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639012469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390ED766068');
        $this->addSql('DROP INDEX IDX_49BB6390ED766068 ON recette');
        $this->addSql('ALTER TABLE recette DROP username_id');
    }
}
