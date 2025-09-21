<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250921112402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new column "name" to "app_payment"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE public.app_payment ADD COLUMN name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
