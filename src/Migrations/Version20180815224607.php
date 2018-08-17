<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180815224607 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE CourseMaterials (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, material_type_id INT DEFAULT NULL, location VARCHAR(150) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_165782BE591CC992 (course_id), INDEX IDX_165782BE74D6573C (material_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CourseMaterials ADD CONSTRAINT FK_165782BE591CC992 FOREIGN KEY (course_id) REFERENCES Course (id)');
        $this->addSql('ALTER TABLE CourseMaterials ADD CONSTRAINT FK_165782BE74D6573C FOREIGN KEY (material_type_id) REFERENCES MaterialType (id)');
        $this->addSql('DROP TABLE coursematerial');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coursematerial (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, material_type_id INT DEFAULT NULL, location VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, is_active TINYINT(1) NOT NULL, INDEX IDX_34278B8A591CC992 (course_id), INDEX IDX_34278B8A74D6573C (material_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coursematerial ADD CONSTRAINT FK_34278B8A591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE coursematerial ADD CONSTRAINT FK_34278B8A74D6573C FOREIGN KEY (material_type_id) REFERENCES materialtype (id)');
        $this->addSql('DROP TABLE CourseMaterials');
    }
}
