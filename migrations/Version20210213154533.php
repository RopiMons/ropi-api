<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210213154533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, statut_id INT DEFAULT NULL, personne_id INT DEFAULT NULL, adresse_de_livraison_id INT DEFAULT NULL, ref_commande VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, archive TINYINT(1) NOT NULL, INDEX IDX_6EEAA67DF6203804 (statut_id), INDEX IDX_6EEAA67DA21BD112 (personne_id), INDEX IDX_6EEAA67D1AC2C625 (adresse_de_livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, personne_id INT DEFAULT NULL, type_contact_id INT DEFAULT NULL, valeur VARCHAR(100) NOT NULL, INDEX IDX_4C62E638A21BD112 (personne_id), INDEX IDX_4C62E638FAA2F36F (type_contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, date_valeur DATE NOT NULL, reference_comptable VARCHAR(255) DEFAULT NULL, INDEX IDX_B1DC7A1E82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, volonte_membre TINYINT(1) DEFAULT \'0\' NOT NULL, actif TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_adresse (personne_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_1DD0ECEBA21BD112 (personne_id), INDEX IDX_1DD0ECEB4DE7DC5C (adresse_id), PRIMARY KEY(personne_id, adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_commerce (personne_id INT NOT NULL, commerce_id INT NOT NULL, INDEX IDX_7827FCBCA21BD112 (personne_id), INDEX IDX_7827FCBCB09114B7 (commerce_id), PRIMARY KEY(personne_id, commerce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, notifier_le_client TINYINT(1) NOT NULL, notifier_admin TINYINT(1) NOT NULL, delais DATETIME DEFAULT NULL, ordre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_contact (id INT AUTO_INCREMENT NOT NULL, string VARCHAR(50) NOT NULL, obligatoire TINYINT(1) NOT NULL, propose_inscription TINYINT(1) NOT NULL, validateur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D1AC2C625 FOREIGN KEY (adresse_de_livraison_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638FAA2F36F FOREIGN KEY (type_contact_id) REFERENCES type_contact (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE personne_adresse ADD CONSTRAINT FK_1DD0ECEBA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_adresse ADD CONSTRAINT FK_1DD0ECEB4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_commerce ADD CONSTRAINT FK_7827FCBCA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_commerce ADD CONSTRAINT FK_7827FCBCB09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commerce CHANGE is_comptoire is_comptoir TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E82EA2E54');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA21BD112');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A21BD112');
        $this->addSql('ALTER TABLE personne_adresse DROP FOREIGN KEY FK_1DD0ECEBA21BD112');
        $this->addSql('ALTER TABLE personne_commerce DROP FOREIGN KEY FK_7827FCBCA21BD112');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF6203804');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638FAA2F36F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_adresse');
        $this->addSql('DROP TABLE personne_commerce');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE type_contact');
        $this->addSql('ALTER TABLE commerce CHANGE is_comptoir is_comptoire TINYINT(1) NOT NULL');
    }
}
