<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250710112852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table app_pers_session';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            CREATE TABLE public.app_pers_session (
                id SERIAL NOT NULL, 
                id_client VARCHAR(100) DEFAULT NULL, 
                first_name VARCHAR(255) NOT NULL, 
                last_name VARCHAR(255) NOT NULL, 
                price DOUBLE PRECISION NOT NULL, 
                created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                is_deleted BOOLEAN DEFAULT false,
                PRIMARY KEY(id)
            )
        ');
    }

    public function down(Schema $schema): void
    {

        $this->addSql('DROP TABLE public.app_pers_session');
    }
}
