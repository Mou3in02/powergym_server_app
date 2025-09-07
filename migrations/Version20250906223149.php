<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250906223149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table JWT token';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE app_jwt_token (
                id SERIAL PRIMARY KEY,
                user_id INTEGER NOT NULL,
                token TEXT NOT NULL,
                created_at TIMESTAMP NOT NULL,
                updated_at TIMESTAMP NULL,
                is_deleted BOOLEAN NOT NULL DEFAULT FALSE,
                deleted_at TIMESTAMP NULL,
    
            CONSTRAINT fk_app_jwt_token_user 
                FOREIGN KEY (user_id) 
                REFERENCES public.app_user (id) 
                ON DELETE SET NULL 
            );
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE app_jwt_token');
    }
}
