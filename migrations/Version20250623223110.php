<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250623223110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create file_import table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE public.file_execution (
                id SERIAL PRIMARY KEY,
                type VARCHAR(50) NOT NULL,
                filename VARCHAR(255) DEFAULT NULL,
                size INTEGER DEFAULT NULL,
                size_description VARCHAR(50) DEFAULT NULL,
                created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL,
                status VARCHAR(50) DEFAULT NULL,
                execution_time  VARCHAR(255) DEFAULT NULL,
                execution_time_description VARCHAR(50) DEFAULT NULL,
                start_at  VARCHAR(255) DEFAULT NULL,
                end_at  VARCHAR(255) DEFAULT NULL,
                is_deleted BOOLEAN NOT NULL DEFAULT false
            )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE public.file_execution');
    }
}
