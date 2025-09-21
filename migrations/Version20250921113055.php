<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250921113055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add relation between user and persSession';
    }

    public function up(Schema $schema): void
    {
        // create a new column
        $this->addSql('ALTER TABLE public.app_pers_session ADD COLUMN created_by INT DEFAULT NULL;');
        // add foreign key
        $this->addSql('ALTER TABLE public.app_pers_session
            ADD CONSTRAINT app_pers_session_app_user_fk_id
            FOREIGN KEY (created_by)
            REFERENCES public.app_user(id)
            ON DELETE SET NULL;'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
