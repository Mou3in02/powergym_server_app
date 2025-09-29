<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929171700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add custom date persSession';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE public.app_pers_session ADD COLUMN custom_date TIMESTAMP DEFAULT NULL;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
