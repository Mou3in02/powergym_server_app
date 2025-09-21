<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250921113520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new column "date" to table "app_pers_session"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE public.app_pers_session ADD COLUMN date TIMESTAMP DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
