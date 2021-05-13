<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513030851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add clients relation to services';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD service_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E74AC8DE0F FOREIGN KEY (service_type_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_C82E74AC8DE0F ON clients (service_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E74AC8DE0F');
        $this->addSql('DROP INDEX IDX_C82E74AC8DE0F ON clients');
        $this->addSql('ALTER TABLE clients DROP service_type_id');
    }
}
