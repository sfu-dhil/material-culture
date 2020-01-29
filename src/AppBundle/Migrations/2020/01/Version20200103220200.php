<?php declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103220200 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE FULLTEXT INDEX IDX_AF3C67792B36786B75355FA1 ON publication (title, abstract)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP INDEX IDX_AF3C67792B36786B75355FA1 ON publication');
    }
}
