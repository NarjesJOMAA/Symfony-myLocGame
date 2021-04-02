<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215082314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biens (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, categories_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1F9004DD76C50E4A (proprietaire_id), INDEX IDX_1F9004DDA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prets (id INT AUTO_INCREMENT NOT NULL, emprunteur_id INT DEFAULT NULL, bien_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_3285EA7AF0840037 (emprunteur_id), INDEX IDX_3285EA7ABD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, points INT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DD76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DDA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE prets ADD CONSTRAINT FK_3285EA7AF0840037 FOREIGN KEY (emprunteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prets ADD CONSTRAINT FK_3285EA7ABD95B80F FOREIGN KEY (bien_id) REFERENCES biens (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prets DROP FOREIGN KEY FK_3285EA7ABD95B80F');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DDA21214B7');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DD76C50E4A');
        $this->addSql('ALTER TABLE prets DROP FOREIGN KEY FK_3285EA7AF0840037');
        $this->addSql('DROP TABLE biens');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE prets');
        $this->addSql('DROP TABLE user');
    }
}
