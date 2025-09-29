<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250628164758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create app_file_upload table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE IF NOT EXISTS public.app_file_upload (
                id SERIAL NOT NULL, 
                original_name VARCHAR(255) DEFAULT NULL, 
                filename VARCHAR(255) DEFAULT NULL, 
                size INT DEFAULT NULL, 
                size_description VARCHAR(50) DEFAULT NULL, 
                uploaded_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
                is_deleted BOOLEAN DEFAULT NULL, 
                status VARCHAR(50) DEFAULT NULL, 
                is_by_service BOOLEAN NOT NULL DEFAULT false,
                PRIMARY KEY(id)
            )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE public.app_file_upload');
    }
}
