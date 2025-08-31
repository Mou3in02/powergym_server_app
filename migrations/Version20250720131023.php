<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250720131023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table app_user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE public.app_user (
                id SERIAL PRIMARY KEY,
                username VARCHAR(180) NOT NULL,
                roles JSON NOT NULL,
                password VARCHAR(255) DEFAULT NULL,
                email VARCHAR(255) DEFAULT NULL,
                firstname VARCHAR(255) DEFAULT NULL,
                lastname VARCHAR(255) DEFAULT NULL,
                lastlogin TIMESTAMP DEFAULT NULL,
                is_deleted BOOLEAN NOT NULL DEFAULT FALSE,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT NULL,
                CONSTRAINT UNIQ_IDENTIFIER_USERNAME UNIQUE (username)
            )
        ');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE public.app_user');
    }
}
