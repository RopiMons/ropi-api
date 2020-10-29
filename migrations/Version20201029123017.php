<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029123017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, position INT NOT NULL, titre_menu VARCHAR(255) NOT NULL, is_actif TINYINT(1) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_dynamique (id INT NOT NULL, route VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_statique (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paragraphe (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, position INT NOT NULL, last_update DATETIME NOT NULL, created_at DATETIME NOT NULL, publication_date DATETIME DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_4C1BA9B6C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_dynamique ADD CONSTRAINT FK_6A790B43BF396750 FOREIGN KEY (id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_statique ADD CONSTRAINT FK_6C328278BF396750 FOREIGN KEY (id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paragraphe ADD CONSTRAINT FK_4C1BA9B6C4663E4 FOREIGN KEY (page_id) REFERENCES page_statique (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_dynamique DROP FOREIGN KEY FK_6A790B43BF396750');
        $this->addSql('ALTER TABLE page_statique DROP FOREIGN KEY FK_6C328278BF396750');
        $this->addSql('ALTER TABLE paragraphe DROP FOREIGN KEY FK_4C1BA9B6C4663E4');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_dynamique');
        $this->addSql('DROP TABLE page_statique');
        $this->addSql('DROP TABLE paragraphe');
    }
}
