<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180815224939 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE course ADD created_by_id INT DEFAULT NULL, DROP created_by');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_11326A8FB03A8386 FOREIGN KEY (created_by_id) REFERENCES Account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11326A8FB03A8386 ON course (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Course DROP FOREIGN KEY FK_11326A8FB03A8386');
        $this->addSql('DROP INDEX UNIQ_11326A8FB03A8386 ON Course');
        $this->addSql('ALTER TABLE Course ADD created_by VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, DROP created_by_id');
    }
}
