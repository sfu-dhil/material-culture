<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103220825 extends AbstractMigration {
    public function up(Schema $schema) : void {
        $this->addSql('CREATE FULLTEXT INDEX IDX_3A9F98E55E237E06F47645AE ON institution (name, url)');
    }

    public function down(Schema $schema) : void {
        $this->addSql('DROP INDEX IDX_3A9F98E55E237E06F47645AE ON institution');
    }
}