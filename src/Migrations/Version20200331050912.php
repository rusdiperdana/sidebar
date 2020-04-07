<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331050912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nd_tracking (id INT AUTO_INCREMENT NOT NULL, refid_id INT NOT NULL, id_user INT DEFAULT NULL, id_jabatan INT DEFAULT NULL, INDEX IDX_D19C9B0A3512AFCB (refid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nd_tracking ADD CONSTRAINT FK_D19C9B0A3512AFCB FOREIGN KEY (refid_id) REFERENCES nd_surat (id)');
        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_approver CHANGE approver_jabatan approver_jabatan INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) DEFAULT NULL, CHANGE aksi aksi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_kata_dasar CHANGE kata_dasar kata_dasar VARCHAR(255) DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_penerima CHANGE penerima_jabatan penerima_jabatan INT DEFAULT NULL, CHANGE penerima_text penerima_text VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_surat CHANGE no_surat_rt no_surat_rt VARCHAR(255) DEFAULT NULL, CHANGE no_surat_rw no_surat_rw VARCHAR(255) DEFAULT NULL, CHANGE no_surat_lurah no_surat_lurah VARCHAR(255) DEFAULT NULL, CHANGE body_surat body_surat VARCHAR(255) DEFAULT NULL, CHANGE no_surat_keterangan no_surat_keterangan INT DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) DEFAULT NULL, CHANGE tgl_selesai_rt tgl_selesai_rt DATETIME DEFAULT NULL, CHANGE tgl_selesai_rw tgl_selesai_rw DATETIME DEFAULT NULL, CHANGE tgl_selesai_kelurahan tgl_selesai_kelurahan DATETIME DEFAULT NULL, CHANGE tgl_buat tgl_buat DATETIME DEFAULT NULL, CHANGE tgl_selesai tgl_selesai DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE nd_tracking');
        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_approver CHANGE approver_jabatan approver_jabatan INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aksi aksi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_kata_dasar CHANGE kata_dasar kata_dasar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE keterangan keterangan VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_penerima CHANGE penerima_jabatan penerima_jabatan INT DEFAULT NULL, CHANGE penerima_text penerima_text VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_surat CHANGE no_surat_rt no_surat_rt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_rw no_surat_rw VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_lurah no_surat_lurah VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE body_surat body_surat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_keterangan no_surat_keterangan INT DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tgl_selesai_rt tgl_selesai_rt DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai_rw tgl_selesai_rw DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai_kelurahan tgl_selesai_kelurahan DATETIME DEFAULT \'NULL\', CHANGE tgl_buat tgl_buat DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai tgl_selesai DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
