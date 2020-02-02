<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200201002744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCF2C56620');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526098DE13AC');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP INDEX UNIQ_8D93D6493DA5256D ON user');
        $this->addSql('ALTER TABLE user DROP image_id, DROP roles');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT NOT NULL, usercrea_id INT NOT NULL, num INT NOT NULL, solde INT NOT NULL, date_c DATETIME NOT NULL, INDEX IDX_CFF6526098DE13AC (partenaire_id), INDEX IDX_CFF65260B6F1AD0B (usercrea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, compte_id INT NOT NULL, montant INT NOT NULL, date_d DATETIME NOT NULL, INDEX IDX_47948BBCF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nenea VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_32FFA373A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526098DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260B6F1AD0B FOREIGN KEY (usercrea_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA373A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD image_id INT DEFAULT NULL, ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493DA5256D ON user (image_id)');
    }
}
