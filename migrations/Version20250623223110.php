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
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            CREATE TABLE file_import (
                id SERIAL NOT NULL, 
                original_name VARCHAR(255) DEFAULT NULL, 
                filename VARCHAR(255) DEFAULT NULL, 
                size INT DEFAULT NULL, 
                size_description VARCHAR(50) DEFAULT NULL, 
                imported_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
                is_deleted BOOLEAN DEFAULT NULL, 
                status VARCHAR(50) DEFAULT NULL, 
                PRIMARY KEY(id)
            )'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE file_import');
    }
}
