<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331074902 extends AbstractMigration
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
        $this->addSql('ALTER TABLE nd_approver CHANGE approver_jabatan approver_jabatan INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) DEFAULT NULL, CHANGE aksi aksi VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_kata_dasar CHANGE kata_dasar kata_dasar VARCHAR(255) DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_penerima CHANGE penerima_jabatan penerima_jabatan INT DEFAULT NULL, CHANGE penerima_text penerima_text VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_surat ADD pengirim_nama_text VARCHAR(255) DEFAULT NULL, CHANGE no_surat_rt no_surat_rt VARCHAR(255) DEFAULT NULL, CHANGE no_surat_rw no_surat_rw VARCHAR(255) DEFAULT NULL, CHANGE no_surat_lurah no_surat_lurah VARCHAR(255) DEFAULT NULL, CHANGE body_surat body_surat VARCHAR(255) DEFAULT NULL, CHANGE step step INT DEFAULT NULL, CHANGE no_surat_keterangan no_surat_keterangan INT DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) DEFAULT NULL, CHANGE tgl_selesai_rt tgl_selesai_rt DATETIME DEFAULT NULL, CHANGE tgl_selesai_rw tgl_selesai_rw DATETIME DEFAULT NULL, CHANGE tgl_selesai_kelurahan tgl_selesai_kelurahan DATETIME DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE tgl_buat tgl_buat DATETIME DEFAULT NULL, CHANGE tgl_selesai tgl_selesai DATETIME DEFAULT NULL, CHANGE idSuratStatus idSuratStatus INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_tracking CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_jabatan id_jabatan INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commond_job_position CHANGE parent parent VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_approver CHANGE approver_jabatan approver_jabatan INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_attachment CHANGE nama_file nama_file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_history CHANGE komentar komentar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aksi aksi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_kata_dasar CHANGE kata_dasar kata_dasar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE keterangan keterangan VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_penerima CHANGE penerima_jabatan penerima_jabatan INT DEFAULT NULL, CHANGE penerima_text penerima_text VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE nd_surat DROP pengirim_nama_text, CHANGE no_surat_rt no_surat_rt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_rw no_surat_rw VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE no_surat_lurah no_surat_lurah VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE body_surat body_surat VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE step step INT DEFAULT NULL, CHANGE no_surat_keterangan no_surat_keterangan INT DEFAULT NULL, CHANGE keterangan keterangan VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tgl_selesai_rt tgl_selesai_rt DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai_rw tgl_selesai_rw DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai_kelurahan tgl_selesai_kelurahan DATETIME DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE tgl_buat tgl_buat DATETIME DEFAULT \'NULL\', CHANGE tgl_selesai tgl_selesai DATETIME DEFAULT \'NULL\', CHANGE idSuratStatus idSuratStatus INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nd_tracking CHANGE id_user id_user INT DEFAULT NULL, CHANGE id_jabatan id_jabatan INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
