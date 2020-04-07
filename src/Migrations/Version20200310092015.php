<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310092015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE penduduk (id INT AUTO_INCREMENT NOT NULL, nik INT NOT NULL, nama_penduduk VARCHAR(255) NOT NULL, no_kk INT NOT NULL, no_telepon INT NOT NULL, alamat VARCHAR(255) NOT NULL, pekerjaan VARCHAR(255) NOT NULL, agama VARCHAR(255) NOT NULL, status_kawin VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) DEFAULT NULL, CHANGE aksi aksi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE penduduk');
        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aksi aksi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
