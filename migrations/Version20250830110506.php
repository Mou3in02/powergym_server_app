<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250830110506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table app_payment';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE public.app_payment (
                id SERIAL PRIMARY KEY,
                external_id VARCHAR(100) NOT NULL,
                pers_person_id varchar(100) NOT NULL,
                update_time TIMESTAMP NOT NULL,
                create_time TIMESTAMP NOT NULL,
                start_time TIMESTAMP DEFAULT NULL,
                end_time TIMESTAMP DEFAULT NULL,
                days int NOT NULL DEFAULT 0,
                price DECIMAL(10,2) NOT NULL DEFAULT 0,
                is_deleted BOOLEAN NOT NULL DEFAULT false
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE public.app_payment');
    }
}
