<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310095220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) DEFAULT NULL, CHANGE aksi aksi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_surat CHANGE no_surat_rt no_surat_rt VARCHAR(255) DEFAULT NULL, CHANGE no_surat_rw no_surat_rw VARCHAR(255) DEFAULT NULL, CHANGE no_surat_lurah no_surat_lurah VARCHAR(255) DEFAULT NULL, CHANGE body_surat body_surat VARCHAR(255) DEFAULT NULL, CHANGE no_surat_keterangan no_surat_keterangan INT DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) DEFAULT NULL, CHANGE tgl_selesai_rt tgl_selesai_rt DATETIME DEFAULT NULL, CHANGE tgl_selesai_rw tgl_selesai_rw DATETIME DEFAULT NULL, CHANGE tgl_selesai_kelurahan tgl_selesai_kelurahan DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE surat_rt ADD refid_id INT NOT NULL');
        $this->addSql('ALTER TABLE surat_rt ADD CONSTRAINT FK_D2C9B4B63512AFCB FOREIGN KEY (refid_id) REFERENCES nd_surat (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D2C9B4B63512AFCB ON surat_rt (refid_id)');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aksi aksi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_surat CHANGE no_surat_rt no_surat_rt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_rw no_surat_rw VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_lurah no_surat_lurah VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE body_surat body_surat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_keterangan no_surat_keterangan INT DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tgl_selesai_rt tgl_selesai_rt DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai_rw tgl_selesai_rw DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai_kelurahan tgl_selesai_kelurahan DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE surat_rt DROP FOREIGN KEY FK_D2C9B4B63512AFCB');
        $this->addSql('DROP INDEX UNIQ_D2C9B4B63512AFCB ON surat_rt');
        $this->addSql('ALTER TABLE surat_rt DROP refid_id');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
