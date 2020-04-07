<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302052956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C7373DB');
        $this->addSql('DROP TABLE posisi');
        $this->addSql('DROP INDEX IDX_8D93D649C7373DB ON user');
        $this->addSql('ALTER TABLE user CHANGE id_posisi_id id_job_position_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64957B6F687 FOREIGN KEY (id_job_position_id) REFERENCES commond_job_position (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64957B6F687 ON user (id_job_position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE posisi (id INT AUTO_INCREMENT NOT NULL, nama_posisi VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, deskripsi_posisi VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64957B6F687');
        $this->addSql('DROP INDEX IDX_8D93D64957B6F687 ON user');
        $this->addSql('ALTER TABLE user CHANGE id_job_position_id id_posisi_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C7373DB FOREIGN KEY (id_posisi_id) REFERENCES posisi (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C7373DB ON user (id_posisi_id)');
    }
}
