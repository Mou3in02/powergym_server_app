<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250930211032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add uploaded by column To table "file_upload"';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE public.app_file_upload ADD COLUMN uploaded_by INT DEFAULT NULL;');
        // add foreign key
        $this->addSql('ALTER TABLE public.app_file_upload
            ADD CONSTRAINT app_file_upload_app_user_fk_id
            FOREIGN KEY (uploaded_by)
            REFERENCES public.app_user(id)
            ON DELETE SET NULL;'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
