<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527231358 extends AbstractMigration {
    public function getDescription() : string {
        return '';
    }

    public function up(Schema $schema) : void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE artefact (id INT AUTO_INCREMENT NOT NULL, recovery_location_id INT DEFAULT NULL, recovery_date_id INT DEFAULT NULL, manufacture_location_id INT DEFAULT NULL, manufacture_date_id INT DEFAULT NULL, institution_id INT DEFAULT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, further_reading LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, category VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, catalog_numbers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', INDEX IDX_8D158D2D348C30E0 (manufacture_location_id), INDEX IDX_8D158D2D3E6BE89F (manufacture_date_id), INDEX IDX_8D158D2DFFEA558 (recovery_location_id), INDEX IDX_8D158D2D10405986 (institution_id), INDEX IDX_8D158D2DF14EB5E4 (recovery_date_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE artefact_bottle (id INT NOT NULL, manufacturer_id INT DEFAULT NULL, content_id INT DEFAULT NULL, packaging_location_id INT DEFAULT NULL, company VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, brand VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, INDEX IDX_EEED6798E2383B3D (packaging_location_id), INDEX IDX_EEED6798A23B42D (manufacturer_id), INDEX IDX_EEED679884A0A3ED (content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE artefact_can (id INT NOT NULL, manufacturer_id INT DEFAULT NULL, content_id INT DEFAULT NULL, packaging_location_id INT DEFAULT NULL, company VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, brand VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, label VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, INDEX IDX_315E4591E2383B3D (packaging_location_id), INDEX IDX_315E4591A23B42D (manufacturer_id), INDEX IDX_315E459184A0A3ED (content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE blog_page (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, weight INT NOT NULL, public TINYINT(1) NOT NULL, include_comments TINYINT(1) NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, searchable LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, excerpt LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, homepage TINYINT(1) DEFAULT \'0\' NOT NULL, in_menu TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_F4DA3AB0A76ED395 (user_id), FULLTEXT INDEX blog_page_content (title, searchable), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, status_id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, include_comments TINYINT(1) NOT NULL, searchable LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, excerpt LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BA5AE01DA76ED395 (user_id), FULLTEXT INDEX blog_post_content (title, searchable), INDEX IDX_BA5AE01D12469DE2 (category_id), INDEX IDX_BA5AE01D6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE blog_post_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_CA275A0C6DE44026 (description), FULLTEXT INDEX IDX_CA275A0CEA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_CA275A0C5E237E06 (name), FULLTEXT INDEX IDX_CA275A0CEA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE blog_post_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, public TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_92121D876DE44026 (description), FULLTEXT INDEX IDX_92121D87EA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_92121D875E237E06 (name), FULLTEXT INDEX IDX_92121D87EA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE circa_date (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, start INT DEFAULT NULL, start_circa TINYINT(1) DEFAULT \'0\' NOT NULL, end INT DEFAULT NULL, end_circa TINYINT(1) DEFAULT \'0\' NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, fullname VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, follow_up TINYINT(1) NOT NULL, entity VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_9474526C6BF700BD (status_id), FULLTEXT INDEX comment_ft_idx (fullname, content), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE comment_note (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, comment_id INT NOT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX commentnote_ft_idx (content), INDEX IDX_E98B58F8A76ED395 (user_id), INDEX IDX_E98B58F8F8697D13 (comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE comment_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_B1133D0E6DE44026 (description), FULLTEXT INDEX IDX_B1133D0EEA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_B1133D0E5E237E06 (name), FULLTEXT INDEX IDX_B1133D0EEA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_FEC530A96DE44026 (description), FULLTEXT INDEX IDX_FEC530A9EA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_FEC530A95E237E06 (name), FULLTEXT INDEX IDX_FEC530A9EA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, uri VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, comment LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_41405E396DE44026 (description), FULLTEXT INDEX IDX_41405E39EA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_41405E39841CB121 (uri), FULLTEXT INDEX IDX_41405E39EA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, artefact_id INT DEFAULT NULL, original_name VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_path VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, thumb_path VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_size INT NOT NULL, image_width INT NOT NULL, image_height INT NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, public TINYINT(1) DEFAULT \'0\' NOT NULL, copyright LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C53D045FB52412E3 (artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE institution (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, address LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, contact LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_3A9F98E55E237E06F47645AE (name, url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, geoname_id VARCHAR(16) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, latitude NUMERIC(11, 8) DEFAULT \'NULL\', longitude NUMERIC(11, 8) DEFAULT \'NULL\', alternate_names LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', country_code VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, admin1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, admin2 VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, admin3 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, admin4 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, timezone VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, elevation INT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_5E9E89CB6DE44026 (description), FULLTEXT INDEX IDX_5E9E89CBEA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_5E9E89CB5E237E06 (name), FULLTEXT INDEX IDX_5E9E89CBEA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label VARCHAR(120) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_3D0AE6DC6DE44026 (description), FULLTEXT INDEX IDX_3D0AE6DCEA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_3D0AE6DC5E237E06 (name), FULLTEXT INDEX IDX_3D0AE6DCEA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE nines_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, active TINYINT(1) NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, login DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, reset_expiry DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', fullname VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, affiliation VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_5BA994A1E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, citation LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, doi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, abstract LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, urls LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', FULLTEXT INDEX IDX_AF3C67792B36786B75355FA1 (title, abstract), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('CREATE TABLE reference (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, artefact_id INT DEFAULT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_AEA3491338B217A7 (publication_id), INDEX IDX_AEA34913B52412E3 (artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema) : void {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE artefact');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE artefact_bottle');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE artefact_can');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE blog_page');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE blog_post');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE blog_post_category');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE blog_post_status');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE circa_date');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE comment');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE comment_note');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE comment_status');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE content');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE element');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE image');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE institution');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE location');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE manufacturer');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE nines_user');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE publication');
        $this->abortIf(
            ! $this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL57Platform,
            "Migration can only be executed safely on '\\Doctrine\\DBAL\\Platforms\\MySQL57Platform'."
        );

        $this->addSql('DROP TABLE reference');
    }
}
