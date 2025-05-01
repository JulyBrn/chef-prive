<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430153719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE galerie ADD image_file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE galerie DROP img_url');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE galerie ADD img_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE galerie DROP image_file');
    }
}
