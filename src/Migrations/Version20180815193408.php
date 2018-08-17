<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180815193408 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Choice (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, choice VARCHAR(100) NOT NULL, is_answer TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_C6075FA41E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Course (id INT AUTO_INCREMENT NOT NULL, course_name VARCHAR(100) NOT NULL, description VARCHAR(150) NOT NULL, created_by VARCHAR(150) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CourseAttempt (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, student_id INT DEFAULT NULL, attempt INT NOT NULL, mark INT NOT NULL, pass TINYINT(1) NOT NULL, INDEX IDX_332456C1591CC992 (course_id), INDEX IDX_332456C1CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CourseContent (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, content VARCHAR(100) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_D50D640E591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CourseMaterial (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, material_type_id INT DEFAULT NULL, location VARCHAR(150) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_34278B8A591CC992 (course_id), INDEX IDX_34278B8A74D6573C (material_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE MaterialType (id INT AUTO_INCREMENT NOT NULL, handle VARCHAR(150) NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Question (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, question VARCHAR(100) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_4F812B18591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Choice ADD CONSTRAINT FK_C6075FA41E27F6BF FOREIGN KEY (question_id) REFERENCES Question (id)');
        $this->addSql('ALTER TABLE CourseAttempt ADD CONSTRAINT FK_332456C1591CC992 FOREIGN KEY (course_id) REFERENCES Course (id)');
        $this->addSql('ALTER TABLE CourseAttempt ADD CONSTRAINT FK_332456C1CB944F1A FOREIGN KEY (student_id) REFERENCES Account (id)');
        $this->addSql('ALTER TABLE CourseContent ADD CONSTRAINT FK_D50D640E591CC992 FOREIGN KEY (course_id) REFERENCES Course (id)');
        $this->addSql('ALTER TABLE CourseMaterial ADD CONSTRAINT FK_34278B8A591CC992 FOREIGN KEY (course_id) REFERENCES Course (id)');
        $this->addSql('ALTER TABLE CourseMaterial ADD CONSTRAINT FK_34278B8A74D6573C FOREIGN KEY (material_type_id) REFERENCES MaterialType (id)');
        $this->addSql('ALTER TABLE Question ADD CONSTRAINT FK_4F812B18591CC992 FOREIGN KEY (course_id) REFERENCES Course (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CourseAttempt DROP FOREIGN KEY FK_332456C1591CC992');
        $this->addSql('ALTER TABLE CourseContent DROP FOREIGN KEY FK_D50D640E591CC992');
        $this->addSql('ALTER TABLE CourseMaterial DROP FOREIGN KEY FK_34278B8A591CC992');
        $this->addSql('ALTER TABLE Question DROP FOREIGN KEY FK_4F812B18591CC992');
        $this->addSql('ALTER TABLE CourseMaterial DROP FOREIGN KEY FK_34278B8A74D6573C');
        $this->addSql('ALTER TABLE Choice DROP FOREIGN KEY FK_C6075FA41E27F6BF');
        $this->addSql('DROP TABLE Choice');
        $this->addSql('DROP TABLE Course');
        $this->addSql('DROP TABLE CourseAttempt');
        $this->addSql('DROP TABLE CourseContent');
        $this->addSql('DROP TABLE CourseMaterial');
        $this->addSql('DROP TABLE MaterialType');
        $this->addSql('DROP TABLE Question');
    }
}
