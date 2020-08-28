<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200828170201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wbnt_dfgb_test DROP FOREIGN KEY FK_A86F10518E63F6D6');
        $this->addSql('DROP TABLE wbnt_dfgb_test');
        $this->addSql('DROP TABLE wbnt_dfgb_testrelated');
        $this->addSql('ALTER TABLE nines_user CHANGE active active TINYINT(1) NOT NULL, CHANGE login login DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE reset_token reset_token VARCHAR(255) DEFAULT NULL, CHANGE reset_expiry reset_expiry DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE affiliation affiliation VARCHAR(64) NOT NULL, CHANGE created created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated updated DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE publication CHANGE urls urls LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wbnt_dfgb_test (id INT AUTO_INCREMENT NOT NULL, testrelated_id INT DEFAULT NULL, name VARCHAR(60) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_A86F10518E63F6D6 (testrelated_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wbnt_dfgb_testrelated (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE wbnt_dfgb_test ADD CONSTRAINT FK_A86F10518E63F6D6 FOREIGN KEY (testrelated_id) REFERENCES wbnt_dfgb_testrelated (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nines_user CHANGE active active TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE reset_token reset_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reset_expiry reset_expiry DATETIME DEFAULT NULL, CHANGE affiliation affiliation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE login login DATETIME DEFAULT NULL, CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated updated DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE publication CHANGE urls urls LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
