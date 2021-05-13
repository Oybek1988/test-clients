<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513030423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add clients relation to stages table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD stage_id INT NOT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E742298D193 FOREIGN KEY (stage_id) REFERENCES stages (id)');
        $this->addSql('CREATE INDEX IDX_C82E742298D193 ON clients (stage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E742298D193');
        $this->addSql('DROP INDEX IDX_C82E742298D193 ON clients');
        $this->addSql('ALTER TABLE clients DROP stage_id');
    }
}
