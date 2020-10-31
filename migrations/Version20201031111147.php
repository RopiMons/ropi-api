<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031111147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, pays_id INT DEFAULT NULL, commerce_id INT DEFAULT NULL, rue VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, numero VARCHAR(10) NOT NULL, complement VARCHAR(255) DEFAULT NULL, type_adresse VARCHAR(100) NOT NULL, INDEX IDX_C35F0816A73F0036 (ville_id), INDEX IDX_C35F0816A6E44244 (pays_id), INDEX IDX_C35F0816B09114B7 (commerce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commerce (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, slogan VARCHAR(255) DEFAULT NULL, text_color VARCHAR(7) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, visible TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, lat DOUBLE PRECISION DEFAULT NULL, lon DOUBLE PRECISION DEFAULT NULL, bg_image VARCHAR(255) DEFAULT NULL, is_comptoire TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien (id INT AUTO_INCREMENT NOT NULL, commerce_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, is_suspicious TINYINT(1) NOT NULL, last_check DATETIME DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_A532B4B5B09114B7 (commerce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, regex_code_postal VARCHAR(255) NOT NULL, nom_court VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, code_postal VARCHAR(10) NOT NULL, ville VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816B09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id)');
        $this->addSql('ALTER TABLE lien ADD CONSTRAINT FK_A532B4B5B09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816B09114B7');
        $this->addSql('ALTER TABLE lien DROP FOREIGN KEY FK_A532B4B5B09114B7');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A6E44244');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A73F0036');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE commerce');
        $this->addSql('DROP TABLE lien');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE ville');
    }
}
