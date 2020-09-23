/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 100110
Source Host           : localhost:3306
Source Database       : tracer_study_db

Target Server Type    : MYSQL
Target Server Version : 100110
File Encoding         : 65001

Date: 2017-09-12 08:57:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alumni
-- ----------------------------
DROP TABLE IF EXISTS `alumni`;
CREATE TABLE `alumni` (
  `npm` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fak` int(11) NOT NULL,
  `jur` int(11) NOT NULL,
  `prodi` varchar(50) CHARACTER SET utf8 NOT NULL,
  `birth_place` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `birthday` date NOT NULL,
  `wisuda` date DEFAULT NULL,
  `jk` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_other` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin_bb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social` mediumtext COLLATE utf8_unicode_ci,
  `fb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `has_work` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `registered` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL  ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL ,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`npm`),
  KEY `FK_alumni_master_fakultas` (`fak`),
  KEY `FK_alumni_master_jurusan` (`jur`),
  CONSTRAINT `FK_alumni_master_fakultas` FOREIGN KEY (`fak`) REFERENCES `master_fakultas` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of alumni
-- ----------------------------
INSERT INTO `alumni` VALUES ('0915031006', 'DAIMATUL KHOIRIYAH', '5', '1', '1', 'Bandar Jaya', '1991-10-13', '2017-09-12', 'P', 'Islam', '', null, null, null, null, null, null, 'rendiagungwijaya@gmail.com', null, null, '0', '2', '2017-09-12 08:24:25', '2017-09-12 01:24:25', '1');
INSERT INTO `alumni` VALUES ('0915031069', 'RENDI AGUNG WIJAYA', '5', '1', '1', 'Sumberhadi', '1992-06-25', '2013-09-18', 'Laki-Laki', 'Islam', '082186540005', '', '', '', '', '', '', 'rendiagungwijaya@gmail.com', '0915031069.jpg', 'Way Kandis', '1', '2', '2017-09-12 07:46:33', '2017-09-12 00:46:33', '1');

-- ----------------------------
-- Table structure for alumni_academic
-- ----------------------------
DROP TABLE IF EXISTS `alumni_academic`;
CREATE TABLE `alumni_academic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(50) DEFAULT NULL,
  `npm` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of alumni_academic
-- ----------------------------
INSERT INTO `alumni_academic` VALUES ('1', 'S1', '0915031069', '2009 - 2013', 'Teknik Elektro Universitas Lampung', '2017-09-12 00:46:19', '2017-09-12 00:46:19');
INSERT INTO `alumni_academic` VALUES ('2', 'SMA/Sederajat', '0915031069', '2006-2009', 'SMKN 2 Bandar Lampung', '2017-09-12 00:46:59', '2017-09-12 00:46:59');

-- ----------------------------
-- Table structure for alumni_work
-- ----------------------------
DROP TABLE IF EXISTS `alumni_work`;
CREATE TABLE `alumni_work` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `npm` varchar(50) DEFAULT '0',
  `tahun` varchar(50) DEFAULT '0',
  `perusahaan` varchar(50) DEFAULT '0',
  `posisi` varchar(50) DEFAULT '0',
  `nama_atasan` varchar(50) DEFAULT '0',
  `telp_atasan` varchar(50) DEFAULT '0',
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  `email_atasan` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of alumni_work
-- ----------------------------
INSERT INTO `alumni_work` VALUES ('1', '0915031069', '2013 - 2015', 'Lamda', 'Programmer', 'John Doe', '08123123121', '2017-09-12 00:20:26', '2017-09-12 00:20:26', 'rendiagungwijaya@gmail.com');

-- ----------------------------
-- Table structure for login_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `login_perusahaan`;
CREATE TABLE `login_perusahaan` (
  `key_valid` varchar(100) NOT NULL,
  `npm` varchar(100) DEFAULT NULL,
  `id_perusahaan` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL  ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`key_valid`),
  KEY `FK_login_perusahaan_alumni_work` (`id_perusahaan`),
  CONSTRAINT `FK_login_perusahaan_alumni_work` FOREIGN KEY (`id_perusahaan`) REFERENCES `alumni_work` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of login_perusahaan
-- ----------------------------

-- ----------------------------
-- Table structure for mailbox
-- ----------------------------
DROP TABLE IF EXISTS `mailbox`;
CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pesan` text,
  `read` varchar(1) DEFAULT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mailbox
-- ----------------------------

-- ----------------------------
-- Table structure for master_fakultas
-- ----------------------------
DROP TABLE IF EXISTS `master_fakultas`;
CREATE TABLE `master_fakultas` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8 NOT NULL,
  `urutan` int(11) NOT NULL,
  `active` varchar(1) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_fakultas
-- ----------------------------
INSERT INTO `master_fakultas` VALUES ('5', 'TEKNIK', '5', '1', '2014-06-18 07:45:16', '2014-06-24 07:20:30');

-- ----------------------------
-- Table structure for master_jurusan
-- ----------------------------
DROP TABLE IF EXISTS `master_jurusan`;
CREATE TABLE `master_jurusan` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `fak` int(11) DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `urutan` int(3) DEFAULT '0',
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  `active` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '1',
  PRIMARY KEY (`kode`),
  KEY `FK_master_jurusan_master_fakultas` (`fak`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of master_jurusan
-- ----------------------------
INSERT INTO `master_jurusan` VALUES ('1', '5', 'TEKNIK ELEKTRO', '1', '2017-09-11 23:22:43', '2017-09-11 23:22:43', '1');

-- ----------------------------
-- Table structure for master_prodi
-- ----------------------------
DROP TABLE IF EXISTS `master_prodi`;
CREATE TABLE `master_prodi` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `jur` int(11) DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `urutan` int(3) DEFAULT '0',
  `active` varchar(1) CHARACTER SET utf8 DEFAULT '1',
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`kode`),
  KEY `FK_master_prodi_master_jurusan` (`jur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of master_prodi
-- ----------------------------
INSERT INTO `master_prodi` VALUES ('1', '1', 'TEKNIK ELEKTRO S1', '1', '1', '2017-09-11 23:23:06', '2017-09-11 23:23:06');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_06_09_190446_create_masterfakultas_table', '1');
INSERT INTO `migrations` VALUES ('2014_06_09_191423_create_masterjurusan_table', '1');
INSERT INTO `migrations` VALUES ('2014_06_12_170426_create_member_list_table', '2');

-- ----------------------------
-- Table structure for poll_alumni
-- ----------------------------
DROP TABLE IF EXISTS `poll_alumni`;
CREATE TABLE `poll_alumni` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `npm` varchar(50) DEFAULT NULL,
  `id_jawaban` bigint(20) DEFAULT '0',
  `sub_jawaban` varchar(50) DEFAULT '0',
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`),
  KEY `FK_poll_perusahaan_questions_detail` (`id_jawaban`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of poll_alumni
-- ----------------------------
INSERT INTO `poll_alumni` VALUES ('1', '0915031069', '261', '', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('2', '0915031069', '257', '', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('3', '0915031069', '241', '', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('4', '0915031069', '228', '', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('5', '0915031069', '43', 'undefined', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('6', '0915031069', '63', 'undefined', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('7', '0915031069', '69', '3', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('8', '0915031069', '154', 'undefined', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('9', '0915031069', '24', '6', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('10', '0915031069', '159', 'undefined', '2017-09-12 00:44:38', '2017-09-12 00:44:38');
INSERT INTO `poll_alumni` VALUES ('11', '0915031069', '83', 'undefined', '2017-09-12 00:44:39', '2017-09-12 00:44:39');
INSERT INTO `poll_alumni` VALUES ('12', '0915031069', '84', 'undefined', '2017-09-12 00:44:39', '2017-09-12 00:44:39');
INSERT INTO `poll_alumni` VALUES ('13', '0915031069', '82', 'undefined', '2017-09-12 00:44:39', '2017-09-12 00:44:39');
INSERT INTO `poll_alumni` VALUES ('14', '0915031069', '165', 'undefined', '2017-09-12 00:44:39', '2017-09-12 00:44:39');
INSERT INTO `poll_alumni` VALUES ('15', '0915031069', '81', 'undefined', '2017-09-12 00:44:39', '2017-09-12 00:44:39');
INSERT INTO `poll_alumni` VALUES ('16', '0915031069', '88', 'undefined', '2017-09-12 00:44:39', '2017-09-12 00:44:39');

-- ----------------------------
-- Table structure for poll_alumni_kompetensi
-- ----------------------------
DROP TABLE IF EXISTS `poll_alumni_kompetensi`;
CREATE TABLE `poll_alumni_kompetensi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `npm` varchar(50) DEFAULT NULL,
  `id_jawaban` bigint(20) DEFAULT '0',
  `sub_jawaban` varchar(50) DEFAULT '0',
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`),
  KEY `FK_poll_perusahaan_questions_detail` (`id_jawaban`),
  CONSTRAINT `poll_alumni_kompetensi_ibfk_1` FOREIGN KEY (`id_jawaban`) REFERENCES `questions_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of poll_alumni_kompetensi
-- ----------------------------
INSERT INTO `poll_alumni_kompetensi` VALUES ('1', '0915031069', '268', '0', '2017-09-12 00:57:46', '2017-09-12 00:57:46');
INSERT INTO `poll_alumni_kompetensi` VALUES ('2', '0915031069', '273', '0', '2017-09-12 00:57:46', '2017-09-12 00:57:46');
INSERT INTO `poll_alumni_kompetensi` VALUES ('3', '0915031069', '180', '0', '2017-09-12 00:57:46', '2017-09-12 00:57:46');
INSERT INTO `poll_alumni_kompetensi` VALUES ('4', '0915031069', '485', '0', '2017-09-12 00:57:46', '2017-09-12 00:57:46');
INSERT INTO `poll_alumni_kompetensi` VALUES ('5', '0915031069', '278', '0', '2017-09-12 00:57:46', '2017-09-12 00:57:46');
INSERT INTO `poll_alumni_kompetensi` VALUES ('6', '0915031069', '585', '0', '2017-09-12 00:57:46', '2017-09-12 00:57:46');
INSERT INTO `poll_alumni_kompetensi` VALUES ('7', '0915031069', '343', '0', '2017-09-12 00:57:47', '2017-09-12 00:57:47');
INSERT INTO `poll_alumni_kompetensi` VALUES ('8', '0915031069', '589', '0', '2017-09-12 00:57:47', '2017-09-12 00:57:47');

-- ----------------------------
-- Table structure for poll_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `poll_perusahaan`;
CREATE TABLE `poll_perusahaan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `npm` varchar(50) DEFAULT NULL,
  `id_perusahaan` bigint(20) DEFAULT '0',
  `id_jawaban` bigint(20) DEFAULT '0',
  `sub_jawaban` text,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`),
  KEY `FK_poll_perusahaan_alumni_work` (`id_perusahaan`),
  KEY `FK_poll_perusahaan_questions_detail` (`id_jawaban`),
  CONSTRAINT `FK_poll_perusahaan_alumni_work` FOREIGN KEY (`id_perusahaan`) REFERENCES `alumni_work` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_poll_perusahaan_questions_detail` FOREIGN KEY (`id_jawaban`) REFERENCES `questions_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of poll_perusahaan
-- ----------------------------
INSERT INTO `poll_perusahaan` VALUES ('1', '0915031069', '1', '222', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('2', '0915031069', '1', '189', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('3', '0915031069', '1', '199', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('4', '0915031069', '1', '224', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('5', '0915031069', '1', '226', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('6', '0915031069', '1', '223', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('7', '0915031069', '1', '225', 'undefined', '2017-09-12 00:32:39', '2017-09-12 00:32:39');
INSERT INTO `poll_perusahaan` VALUES ('8', '0915031069', '1', '591', 'Tingkatkan', '2017-09-12 00:32:39', '2017-09-12 00:32:39');

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `kode_questioner` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `helptext` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`),
  KEY `FK_question_questioner` (`kode_questioner`),
  CONSTRAINT `FK_question_questioner` FOREIGN KEY (`kode_questioner`) REFERENCES `questioner` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('1', 'F6', 'F1', 'Kapan anda mulai mencari pekerjaan?', 'Mohon pekerjaan sambilan tidak dimasukkan(pilih salah satu)', 'Radio', '2014-06-18 04:37:02', '2014-06-18 04:37:02');
INSERT INTO `question` VALUES ('2', 'F7', 'F1', 'Bagaimana anda mencari pekerjaan tersebut? ', 'Jawaban bisa lebih dari satu', 'Checkbox', '2014-06-18 04:45:01', '2014-06-18 04:45:01');
INSERT INTO `question` VALUES ('3', 'F8', 'F1', 'Berapa bulan waktu yang dihabiskan (sebelum dan sesudah wisuda) untuk memperoleh pekerjaan pertama?', 'Pilih salah satu', 'Radio', '2014-06-18 04:51:02', '2014-06-18 04:52:33');
INSERT INTO `question` VALUES ('4', 'F9', 'F1', 'Berapa perusahaan/instansi/institusi yang sudah anda lamar (lewat surat atau e-mail) sebelum anda memeroleh pekerjaan pertama?', '', 'Text', '2014-06-18 04:55:51', '2014-06-18 05:02:02');
INSERT INTO `question` VALUES ('5', 'F10', 'F1', 'Berapa perusahaan/instansi/institusi yang merespon lamaran anda?', '', 'Text', '2014-06-18 06:50:56', '2014-06-18 06:50:56');
INSERT INTO `question` VALUES ('6', 'F11', 'F1', 'Apakah anda bekerja saat ini ?', '(termasuk kerja sambilan dan wirausaha)', 'Radio', '2014-06-18 07:13:29', '2014-06-18 07:13:29');
INSERT INTO `question` VALUES ('7', 'F12', 'F1', 'Bagaimana anda menggambarkan situasi anda saat ini? ', 'Jawaban bisa lebih dari satu', 'Checkbox', '2014-06-18 07:14:40', '2014-06-18 07:14:40');
INSERT INTO `question` VALUES ('8', 'F13', 'F1', 'Apakah anda aktif mencari pekerjaan dalam 4 minggu terakhir?', ' Pilihlah Satu Jawaban', 'Radio', '2014-06-18 07:24:15', '2014-06-18 07:24:15');
INSERT INTO `question` VALUES ('9', 'F14', 'F1', 'Apa jenis perusahaan/instansi/institusi tempat anda bekerja sekarang?', 'Pilih Salah Satu', 'Radio', '2014-06-18 07:26:25', '2014-06-18 07:26:25');
INSERT INTO `question` VALUES ('10', 'F15', 'F1', 'Tempat anda bekerja saat ini bergerak di bidang apa?', '', 'Combobox', '2014-06-19 23:19:02', '2014-06-22 04:41:25');
INSERT INTO `question` VALUES ('11', 'F16a', 'F1', 'Kira-kira berapa pendapatan anda setiap bulannya (Dari Pekerjaan Utama)?', '', 'Combobox', '2014-06-19 23:24:11', '2014-06-22 04:06:47');
INSERT INTO `question` VALUES ('12', 'F16b', 'F1', 'Kira-kira berapa pendapatan anda setiap bulannya (Dari Lembur dan Tips)?', '', 'Combobox', '2014-06-19 23:25:13', '2014-06-22 04:41:49');
INSERT INTO `question` VALUES ('13', 'F16c', 'F1', 'Kira-kira berapa pendapatan anda setiap bulannya (Dari Pekerjaan Lainnya)?', '', 'Combobox', '2014-06-19 23:26:53', '2014-06-22 04:41:59');
INSERT INTO `question` VALUES ('14', 'F17', 'F1', 'Seberapa erat hubungan antara bidang studi dengan pekerjaan anda?', 'Pilih salah satu', 'Radio', '2014-06-19 23:28:28', '2014-06-19 23:28:28');
INSERT INTO `question` VALUES ('15', 'F18', 'F1', 'Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan anda saat ini?', 'Pilih salah satu', 'Radio', '2014-06-19 23:29:25', '2014-06-19 23:29:25');
INSERT INTO `question` VALUES ('16', 'F19', 'F1', 'Jika menurut anda pekerjaan anda saat ini tidak sesuai dengan pendidikan anda, mengapa anda mengambilnya?', 'Pilihan dapat lebih dari satu', 'Checkbox', '2014-06-19 23:31:06', '2014-06-19 23:31:06');
INSERT INTO `question` VALUES ('17', '1', 'F20', 'Pengetahuan di bidang atau disiplin ilmu anda', 'Pilih skala yang sesuai (1-5)', 'Radio', '2014-06-19 23:33:29', '2014-06-19 23:33:29');
INSERT INTO `question` VALUES ('18', '2', 'F20', 'Pengetahuan di luar bidang atau disiplin ilmu anda', '', 'Combobox', '2014-06-19 23:48:22', '2014-06-23 15:09:13');
INSERT INTO `question` VALUES ('19', '1', 'A', 'Bagaimana menurut Anda tentang Integritas (etika dan moral) dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:49:25', '2014-06-20 00:49:25');
INSERT INTO `question` VALUES ('20', '2', 'A', 'Bagaimana menurut Anda tentang Keahlian berdasarkan bidang ilmu (profesionalisme) dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:50:05', '2014-06-20 00:51:27');
INSERT INTO `question` VALUES ('21', '3', 'A', 'Bagaimana menurut Anda tentang Bahasa Inggris dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:50:17', '2014-06-20 00:51:45');
INSERT INTO `question` VALUES ('22', '4', 'A', 'Bagaimana menurut Anda tentang Penggunaan Teknologi Informasi dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:50:28', '2014-06-20 00:51:58');
INSERT INTO `question` VALUES ('23', '5', 'A', 'Bagaimana menurut Anda tentang Komunikas dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:50:39', '2014-06-20 00:52:12');
INSERT INTO `question` VALUES ('24', '6', 'A', 'Bagaimana menurut Anda tentang Kerjasama tim dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:50:54', '2014-06-20 00:52:23');
INSERT INTO `question` VALUES ('25', '7', 'A', 'Bagaimana menurut Anda tentang Pengembangan diri dari alumni kami di atas selama bekerja ?', '', 'Radio', '2014-06-20 00:51:05', '2014-06-20 00:52:53');
INSERT INTO `question` VALUES ('26', '3', 'F20', 'Pengetahuan umum', '', 'Combobox', '2014-06-23 06:30:04', '2014-06-23 06:30:04');
INSERT INTO `question` VALUES ('27', '4', 'F20', 'Ketrampilan internet', '', 'Combobox', '2014-06-23 06:30:26', '2014-06-23 06:30:26');
INSERT INTO `question` VALUES ('28', '5', 'F20', 'Ketrampilan komputer', '', 'Combobox', '2014-06-23 06:30:59', '2014-06-23 06:30:59');
INSERT INTO `question` VALUES ('29', '6', 'F20', 'Berpikir kritis', '', 'Combobox', '2014-06-23 06:31:27', '2014-06-23 06:31:27');
INSERT INTO `question` VALUES ('30', '7', 'F20', 'Ketrampilan riset', '', 'Combobox', '2014-06-23 06:37:38', '2014-06-23 06:38:32');
INSERT INTO `question` VALUES ('31', '8', 'F20', 'Kemampuan belajar', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('32', '9', 'F20', 'Kemampuan bahasa Inggris', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('33', '10', 'F20', 'Kemampuan berkomunikasi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('34', '11', 'F20', 'Bekerja di bawah tekanan', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('35', '12', 'F20', 'Manajemen waktu', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('36', '13', 'F20', 'Bekerja secara mandiri', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('37', '14', 'F20', 'Bekerja dalam tim/bekerjasama dengan orang lain', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('38', '15', 'F20', 'Kemampuan dalam memecahkan masalah', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('39', '16', 'F20', 'Negosiasi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('40', '17', 'F20', 'Kemampuan analisis', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('41', '18', 'F20', 'Toleransi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('42', '19', 'F20', 'Kemampuan adaptasi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('43', '20', 'F20', 'Loyalitas dan integritas', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('44', '21', 'F20', 'Bekerja dengan orang yang berbeda budaya maupun latar belakang', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('45', '23', 'F20', 'Kemampuan dalam memegang tanggungjawab', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('46', '24', 'F20', 'Inisiatif', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('47', '25', 'F20', 'Manajemen proyek/program', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('48', '26', 'F20', 'Kemampuan untuk mempresentasikan ide/produk/laporan', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('49', '27', 'F20', 'Kemampuan dalam menulis laporan, memo dan dokumen', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('50', '28', 'F20', 'Kemampuan untuk terus belajar sepanjang hayat', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('53', '22', 'F20', 'Kepemimpinan', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('57', '3', 'F21', 'Pengetahuan umum', '', 'Combobox', '2014-06-23 06:30:04', '2014-06-23 06:30:04');
INSERT INTO `question` VALUES ('58', '4', 'F21', 'Ketrampilan internet', '', 'Combobox', '2014-06-23 06:30:26', '2014-06-23 06:30:26');
INSERT INTO `question` VALUES ('59', '5', 'F21', 'Ketrampilan komputer', '', 'Combobox', '2014-06-23 06:30:59', '2014-06-23 06:30:59');
INSERT INTO `question` VALUES ('60', '6', 'F21', 'Berpikir kritis', '', 'Combobox', '2014-06-23 06:31:27', '2014-06-23 06:31:27');
INSERT INTO `question` VALUES ('61', '7', 'F21', 'Ketrampilan riset', '', 'Combobox', '2014-06-23 06:37:38', '2014-06-23 06:38:32');
INSERT INTO `question` VALUES ('62', '8', 'F21', 'Kemampuan belajar', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('63', '1', 'F21', 'Pengetahuan di bidang atau disiplin ilmu anda', 'Pilih skala yang sesuai (1-5)', 'Combobox', '2014-06-19 23:33:29', '2014-06-23 13:50:23');
INSERT INTO `question` VALUES ('64', '2', 'F21', 'Pengetahuan di luar bidang atau disiplin ilmu anda', '', 'Combobox', '2014-06-19 23:48:22', '2014-06-23 13:52:45');
INSERT INTO `question` VALUES ('65', '9', 'F21', 'Kemampuan bahasa Inggris', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('66', '10', 'F21', 'Kemampuan berkomunikasi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('67', '11', 'F21', 'Bekerja di bawah tekanan', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('68', '12', 'F21', 'Manajemen waktu', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('69', '13', 'F21', 'Bekerja secara mandiri', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('70', '14', 'F21', 'Bekerja dalam tim/bekerjasama dengan orang lain', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('71', '15', 'F21', 'Kemampuan dalam memecahkan masalah', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('72', '16', 'F21', 'Negosiasi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('73', '17', 'F21', 'Kemampuan analisis', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('74', '18', 'F21', 'Toleransi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('75', '19', 'F21', 'Kemampuan adaptasi', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('76', '20', 'F21', 'Loyalitas dan integritas', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('77', '21', 'F21', 'Bekerja dengan orang yang berbeda budaya maupun latar belakang', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('78', '23', 'F21', 'Kemampuan dalam memegang tanggungjawab', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('79', '24', 'F21', 'Inisiatif', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('80', '25', 'F21', 'Manajemen proyek/program', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('81', '26', 'F21', 'Kemampuan untuk mempresentasikan ide/produk/laporan', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('82', '27', 'F21', 'Kemampuan dalam menulis laporan, memo dan dokumen', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('83', '22', 'F21', 'Kepemimpinan', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('84', '28', 'F21', 'Kemampuan untuk terus belajar sepanjang hayat', '', 'Combobox', '2014-06-23 06:38:15', '2014-06-23 06:38:15');
INSERT INTO `question` VALUES ('85', '8', 'A', 'Mohon berikan masukan Anda kepada pihak Universitas', '', 'Textarea', '2014-06-23 15:06:17', '2014-06-23 15:06:17');

-- ----------------------------
-- Table structure for questioner
-- ----------------------------
DROP TABLE IF EXISTS `questioner`;
CREATE TABLE `questioner` (
  `kode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `for` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of questioner
-- ----------------------------
INSERT INTO `questioner` VALUES ('A', 'Pertanyaan Perusahaan', 'Company', '', '2014-06-20 00:47:58', '2014-06-23 12:34:54', '1');
INSERT INTO `questioner` VALUES ('F1', 'Kuesioner Utama', 'Alumni', '', '2014-06-17 00:23:57', '2014-06-23 12:34:44', '1');
INSERT INTO `questioner` VALUES ('F20', 'Tolong berikan penilaian [1-5] untuk kompetensi yang Anda kuasai saat lulus (Nilai 5 adalah skor tertinggi)', 'Alumni', 'Table', '2014-06-19 23:32:38', '2014-06-22 04:48:46', '1');
INSERT INTO `questioner` VALUES ('F21', 'Tolong berikan penilaian [1-5] untuk kontribusi perguruan tinggi dalam hal kompetensi berikut  (Nilai 5 adalah skor tertinggi)', 'Alumni', 'Table', '2014-06-19 23:32:38', '2014-06-22 04:48:46', '1');

-- ----------------------------
-- Table structure for questions_detail
-- ----------------------------
DROP TABLE IF EXISTS `questions_detail`;
CREATE TABLE `questions_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no` int(11) DEFAULT NULL,
  `kode_kuesioner` varchar(50) DEFAULT NULL,
  `kode_questions` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `option_value` varchar(255) DEFAULT NULL,
  `sub_option` varchar(255) DEFAULT NULL,
  `sub_option_class` varchar(50) DEFAULT NULL,
  `go_to` varchar(50) DEFAULT NULL,
  `skip` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=592 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of questions_detail
-- ----------------------------
INSERT INTO `questions_detail` VALUES ('24', '1', 'F1', 'F8', 'Radio', 'Kira-kira', 'bulan sebelum wisuda', 'numbers', '', '', '2014-06-18 04:52:34', '2014-06-18 04:52:34');
INSERT INTO `questions_detail` VALUES ('25', '2', 'F1', 'F8', 'Radio', 'Kira-kira', 'bulan setelah wisuda', 'numbers', '', '', '2014-06-18 04:52:34', '2014-06-18 04:52:34');
INSERT INTO `questions_detail` VALUES ('29', '1', 'F1', 'F9', 'Text', null, 'perusahaan/instansi/institusi', 'numbers', null, null, null, null);
INSERT INTO `questions_detail` VALUES ('43', '1', 'F1', 'F11', 'Radio', 'Ya', '', null, 'F14,F15,F16a,F16b,F16c,F17', 'F12,F13', '2014-06-18 07:21:05', '2014-06-18 07:21:05');
INSERT INTO `questions_detail` VALUES ('44', '2', 'F1', 'F11', 'Radio', 'Tidak', '', null, 'F12,F13', 'F14,F15,F16a,F16b,F16c', '2014-06-18 07:21:05', '2014-06-18 07:21:05');
INSERT INTO `questions_detail` VALUES ('46', '1', 'F1', 'F10', 'Text', '', 'perusahaan/instansi/institusi', 'numbers', '', '', '2014-06-18 07:22:30', '2014-06-18 07:22:30');
INSERT INTO `questions_detail` VALUES ('52', '4', 'F1', 'F13', 'Radio', 'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan', '', null, 'F17', 'F14,F15,F16a,F16b,F16c', '2014-06-18 07:24:45', '2014-06-18 07:24:45');
INSERT INTO `questions_detail` VALUES ('53', '5', 'F1', 'F13', 'Radio', 'Lainnya', '  ', null, 'F17', 'F14,F15,F16a,F16b,F16c', '2014-06-18 07:24:45', '2014-06-18 07:24:45');
INSERT INTO `questions_detail` VALUES ('54', '1', 'F1', 'F13', 'Radio', 'Tidak', '', null, 'F17', 'F14,F15,F16a,F16b,F16c', '2014-06-18 07:24:45', '2014-06-18 07:24:45');
INSERT INTO `questions_detail` VALUES ('55', '3', 'F1', 'F13', 'Radio', 'Ya, saya akan mulai bekerja dalam 2 minggu ke depan', '', null, 'F17', 'F14,F15,F16a,F16b,F16c', '2014-06-18 07:24:45', '2014-06-18 07:24:45');
INSERT INTO `questions_detail` VALUES ('56', '2', 'F1', 'F13', 'Radio', 'Tidak, tapi saya sedang menunggu hasil lamaran kerja', '', null, 'F17', 'F14,F15,F16a,F16b,F16c', '2014-06-18 07:24:45', '2014-06-18 07:24:45');
INSERT INTO `questions_detail` VALUES ('57', '1', 'F1', 'F12', 'Checkbox', 'Saya masih belajar/melanjutkan kuliah profesi atau pascasarjana', '', null, '', '', '2014-06-18 07:25:03', '2014-06-18 07:25:03');
INSERT INTO `questions_detail` VALUES ('58', '3', 'F1', 'F12', 'Checkbox', 'Saya sibuk dengan keluarga dan anak-anak', '', null, '', '', '2014-06-18 07:25:03', '2014-06-18 07:25:03');
INSERT INTO `questions_detail` VALUES ('59', '5', 'F1', 'F12', 'Checkbox', 'Lainnya', '  ', null, '', '', '2014-06-18 07:25:03', '2014-06-18 07:25:03');
INSERT INTO `questions_detail` VALUES ('60', '4', 'F1', 'F12', 'Checkbox', 'Saya sekarang sedang mencari pekerjaan', '', null, '', '', '2014-06-18 07:25:03', '2014-06-18 07:25:03');
INSERT INTO `questions_detail` VALUES ('61', '2', 'F1', 'F12', 'Checkbox', 'Saya menikah', '', null, '', '', '2014-06-18 07:25:04', '2014-06-18 07:25:04');
INSERT INTO `questions_detail` VALUES ('62', '2', 'F1', 'F14', 'Radio', 'Organisasi non-profit/Lembaga Swadaya Masyarakat', '', null, '', '', '2014-06-18 07:26:27', '2014-06-18 07:26:27');
INSERT INTO `questions_detail` VALUES ('63', '4', 'F1', 'F14', 'Radio', 'Wiraswasta/perusahaan sendiri', '', null, '', '', '2014-06-18 07:26:27', '2014-06-18 07:26:27');
INSERT INTO `questions_detail` VALUES ('64', '5', 'F1', 'F14', 'Radio', 'Lainnya', '  ', null, '', '', '2014-06-18 07:26:27', '2014-06-18 07:26:27');
INSERT INTO `questions_detail` VALUES ('65', '3', 'F1', 'F14', 'Radio', 'Perusahaan swasta', '', null, '', '', '2014-06-18 07:26:27', '2014-06-18 07:26:27');
INSERT INTO `questions_detail` VALUES ('66', '1', 'F1', 'F14', 'Radio', 'Instansi pemerintah (termasuk BUMN)', '', null, '', '', '2014-06-18 07:26:27', '2014-06-18 07:26:27');
INSERT INTO `questions_detail` VALUES ('67', '3', 'F1', 'F6', 'Radio', 'Saya tidak mencari kerja', '', null, 'F11', 'F7,F8,F9,F10', '2014-06-18 07:53:18', '2014-06-18 07:53:18');
INSERT INTO `questions_detail` VALUES ('68', '1', 'F1', 'F6', 'Radio', 'Kira - Kira', 'bulan sebelum wisuda', 'numbers', 'F7,F8,F9,F10,F11', '', '2014-06-18 07:53:18', '2014-06-18 07:53:18');
INSERT INTO `questions_detail` VALUES ('69', '2', 'F1', 'F6', 'Radio', 'Kira - Kira', 'bulan setelah wisuda', 'numbers', 'F7,F8,F9,F10,F11', '', '2014-06-18 07:53:18', '2014-06-18 07:53:18');
INSERT INTO `questions_detail` VALUES ('81', '1', 'F1', 'F7', 'Checkbox', 'Melalui iklan di koran/majalah, brosur ', '', null, '', '', '2014-06-19 23:15:11', '2014-06-19 23:15:11');
INSERT INTO `questions_detail` VALUES ('82', '2', 'F1', 'F7', 'Checkbox', 'Melamar ke perusahaan tanpa mengetahui lowongan yang ada ', '', null, '', '', '2014-06-19 23:15:11', '2014-06-19 23:15:11');
INSERT INTO `questions_detail` VALUES ('83', '3', 'F1', 'F7', 'Checkbox', 'Pergi ke bursa/pameran kerja', '', null, '', '', '2014-06-19 23:15:11', '2014-06-19 23:15:11');
INSERT INTO `questions_detail` VALUES ('84', '4', 'F1', 'F7', 'Checkbox', 'Mencari lewat internet/iklan online/milis ', '', null, '', '', '2014-06-19 23:15:13', '2014-06-19 23:15:13');
INSERT INTO `questions_detail` VALUES ('85', '5', 'F1', 'F7', 'Checkbox', 'Dihubungi oleh perusahaan', '', null, '', '', '2014-06-19 23:15:13', '2014-06-19 23:15:13');
INSERT INTO `questions_detail` VALUES ('86', '6', 'F1', 'F7', 'Checkbox', 'Menghubungi Kemenakertrans', '', null, '', '', '2014-06-19 23:15:13', '2014-06-19 23:15:13');
INSERT INTO `questions_detail` VALUES ('87', '7', 'F1', 'F7', 'Checkbox', 'Menghubungi agen tenaga kerja komersial/swasta', '', null, '', '', '2014-06-19 23:15:13', '2014-06-19 23:15:13');
INSERT INTO `questions_detail` VALUES ('88', '8', 'F1', 'F7', 'Checkbox', 'Memeroleh informasi dari pusat/kantor pengembangan karir fakultas/universitas', '', null, '', '', '2014-06-19 23:15:14', '2014-06-19 23:15:14');
INSERT INTO `questions_detail` VALUES ('89', '9', 'F1', 'F7', 'Checkbox', 'Menghubungi kantor kemahasiswaan/hubungan alumni', '', null, '', '', '2014-06-19 23:15:17', '2014-06-19 23:15:17');
INSERT INTO `questions_detail` VALUES ('90', '10', 'F1', 'F7', 'Checkbox', 'Membangun jejaring (network) sejak masih kuliah', '', null, '', '', '2014-06-19 23:15:17', '2014-06-19 23:15:17');
INSERT INTO `questions_detail` VALUES ('91', '11', 'F1', 'F7', 'Checkbox', 'Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll.)', '', null, '', '', '2014-06-19 23:15:17', '2014-06-19 23:15:17');
INSERT INTO `questions_detail` VALUES ('92', '12', 'F1', 'F7', 'Checkbox', 'Membangun bisnis sendiri', '', null, '', '', '2014-06-19 23:15:19', '2014-06-19 23:15:19');
INSERT INTO `questions_detail` VALUES ('93', '13', 'F1', 'F7', 'Checkbox', 'Melalui penempatan kerja atau magang', '', null, '', '', '2014-06-19 23:15:19', '2014-06-19 23:15:19');
INSERT INTO `questions_detail` VALUES ('94', '14', 'F1', 'F7', 'Checkbox', 'Bekerja di tempat yang sama dengan tempat kerja semasa kuliah', '', null, '', '', '2014-06-19 23:15:19', '2014-06-19 23:15:19');
INSERT INTO `questions_detail` VALUES ('95', '15', 'F1', 'F7', 'Checkbox', 'Lainnya ', '  ', null, '', '', '2014-06-19 23:15:19', '2014-06-19 23:15:19');
INSERT INTO `questions_detail` VALUES ('154', '1', 'F1', 'F17', 'Radio', 'Sangat Erat', '', null, '', '', '2014-06-19 23:28:29', '2014-06-19 23:28:29');
INSERT INTO `questions_detail` VALUES ('155', '3', 'F1', 'F17', 'Radio', 'Cukup Erat', '', null, '', '', '2014-06-19 23:28:29', '2014-06-19 23:28:29');
INSERT INTO `questions_detail` VALUES ('156', '2', 'F1', 'F17', 'Radio', 'Erat', '', null, '', '', '2014-06-19 23:28:29', '2014-06-19 23:28:29');
INSERT INTO `questions_detail` VALUES ('157', '5', 'F1', 'F17', 'Radio', 'Tidak Sama Sekali', '', null, '', '', '2014-06-19 23:28:30', '2014-06-19 23:28:30');
INSERT INTO `questions_detail` VALUES ('158', '4', 'F1', 'F17', 'Radio', 'Kurang Erat', '', null, '', '', '2014-06-19 23:28:30', '2014-06-19 23:28:30');
INSERT INTO `questions_detail` VALUES ('159', '2', 'F1', 'F18', 'Radio', 'Tingkat yang Sama', '', null, '', '', '2014-06-19 23:29:27', '2014-06-19 23:29:27');
INSERT INTO `questions_detail` VALUES ('160', '1', 'F1', 'F18', 'Radio', 'Setingkat Lebih Tinggi', '', null, '', '', '2014-06-19 23:29:27', '2014-06-19 23:29:27');
INSERT INTO `questions_detail` VALUES ('161', '3', 'F1', 'F18', 'Radio', 'Setingkat Lebih Rendah', '', null, '', '', '2014-06-19 23:29:27', '2014-06-19 23:29:27');
INSERT INTO `questions_detail` VALUES ('162', '4', 'F1', 'F18', 'Radio', 'Tidak Perlu Pendidikan Tinggi', '', null, '', '', '2014-06-19 23:29:28', '2014-06-19 23:29:28');
INSERT INTO `questions_detail` VALUES ('163', '2', 'F1', 'F19', 'Checkbox', 'Saya belum mendapatkan pekerjaan yang lebih sesuai.', '', null, '', '', '2014-06-19 23:31:08', '2014-06-19 23:31:08');
INSERT INTO `questions_detail` VALUES ('164', '3', 'F1', 'F19', 'Checkbox', 'Di pekerjaan ini saya memeroleh prospek karir yang baik.', '', null, '', '', '2014-06-19 23:31:08', '2014-06-19 23:31:08');
INSERT INTO `questions_detail` VALUES ('165', '1', 'F1', 'F19', 'Checkbox', 'Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah sesuai dengan pendidikan saya. ', '', null, '', '', '2014-06-19 23:31:08', '2014-06-19 23:31:08');
INSERT INTO `questions_detail` VALUES ('166', '4', 'F1', 'F19', 'Checkbox', 'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya.', '', null, '', '', '2014-06-19 23:31:09', '2014-06-19 23:31:09');
INSERT INTO `questions_detail` VALUES ('167', '6', 'F1', 'F19', 'Checkbox', 'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini. ', '', null, '', '', '2014-06-19 23:31:09', '2014-06-19 23:31:09');
INSERT INTO `questions_detail` VALUES ('168', '5', 'F1', 'F19', 'Checkbox', 'Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya.', '', null, '', '', '2014-06-19 23:31:09', '2014-06-19 23:31:09');
INSERT INTO `questions_detail` VALUES ('169', '7', 'F1', 'F19', 'Checkbox', 'Pekerjaan saya saat ini lebih aman/terjamin/secure ', '', null, '', '', '2014-06-19 23:31:09', '2014-06-19 23:31:09');
INSERT INTO `questions_detail` VALUES ('170', '8', 'F1', 'F19', 'Checkbox', 'Pekerjaan saya saat ini lebih menarik ', '', null, '', '', '2014-06-19 23:31:10', '2014-06-19 23:31:10');
INSERT INTO `questions_detail` VALUES ('171', '9', 'F1', 'F19', 'Checkbox', 'Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll.', '', null, '', '', '2014-06-19 23:31:10', '2014-06-19 23:31:10');
INSERT INTO `questions_detail` VALUES ('172', '10', 'F1', 'F19', 'Checkbox', 'Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya.', '', null, '', '', '2014-06-19 23:31:10', '2014-06-19 23:31:10');
INSERT INTO `questions_detail` VALUES ('173', '11', 'F1', 'F19', 'Checkbox', 'Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya.', '', null, '', '', '2014-06-19 23:31:11', '2014-06-19 23:31:11');
INSERT INTO `questions_detail` VALUES ('174', '12', 'F1', 'F19', 'Checkbox', 'Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya. ', '', null, '', '', '2014-06-19 23:31:12', '2014-06-19 23:31:12');
INSERT INTO `questions_detail` VALUES ('175', '13', 'F1', 'F19', 'Checkbox', 'Lainnya : ', ' ', null, '', '', '2014-06-19 23:31:12', '2014-06-19 23:31:12');
INSERT INTO `questions_detail` VALUES ('176', '2', 'F20', '1', 'Radio', '2', '', null, '', '', '2014-06-19 23:33:30', '2014-06-19 23:33:30');
INSERT INTO `questions_detail` VALUES ('177', '1', 'F20', '1', 'Radio', '1', '', null, '', '', '2014-06-19 23:33:30', '2014-06-19 23:33:30');
INSERT INTO `questions_detail` VALUES ('178', '3', 'F20', '1', 'Radio', '3', '', null, '', '', '2014-06-19 23:33:30', '2014-06-19 23:33:30');
INSERT INTO `questions_detail` VALUES ('179', '4', 'F20', '1', 'Radio', '4', '', null, '', '', '2014-06-19 23:33:32', '2014-06-19 23:33:32');
INSERT INTO `questions_detail` VALUES ('180', '5', 'F20', '1', 'Radio', '5', '', null, '', '', '2014-06-19 23:33:32', '2014-06-19 23:33:32');
INSERT INTO `questions_detail` VALUES ('186', '2', 'A', '1', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:49:27', '2014-06-20 00:49:27');
INSERT INTO `questions_detail` VALUES ('187', '3', 'A', '1', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:49:27', '2014-06-20 00:49:27');
INSERT INTO `questions_detail` VALUES ('188', '4', 'A', '1', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:49:27', '2014-06-20 00:49:27');
INSERT INTO `questions_detail` VALUES ('189', '1', 'A', '1', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:49:27', '2014-06-20 00:49:27');
INSERT INTO `questions_detail` VALUES ('199', '1', 'A', '2', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('200', '4', 'A', '2', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('201', '3', 'A', '2', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('202', '2', 'A', '2', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('207', '2', 'A', '3', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('208', '2', 'A', '4', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('209', '2', 'A', '5', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('210', '2', 'A', '6', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('211', '2', 'A', '7', 'Radio', 'Baik', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('212', '3', 'A', '3', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('213', '3', 'A', '4', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('214', '3', 'A', '5', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('215', '3', 'A', '6', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('216', '3', 'A', '7', 'Radio', 'Cukup', '', null, '', '', '2014-06-20 00:51:29', '2014-06-20 00:51:29');
INSERT INTO `questions_detail` VALUES ('217', '4', 'A', '3', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('218', '4', 'A', '4', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('219', '4', 'A', '5', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('220', '4', 'A', '6', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('221', '4', 'A', '7', 'Radio', 'Kurang', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('222', '1', 'A', '3', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('223', '1', 'A', '4', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('224', '1', 'A', '5', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('225', '1', 'A', '7', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('226', '1', 'A', '6', 'Radio', 'Sangat Baik', '', null, '', '', '2014-06-20 00:51:28', '2014-06-20 00:51:28');
INSERT INTO `questions_detail` VALUES ('227', '2', 'F1', 'F16a', 'Combobox', '2.500.000 - 5.000.000', '', null, '', '', '2014-06-22 04:06:49', '2014-06-22 04:06:49');
INSERT INTO `questions_detail` VALUES ('228', '5', 'F1', 'F16a', 'Combobox', '>10.000.000', '', null, '', '', '2014-06-22 04:06:49', '2014-06-22 04:06:49');
INSERT INTO `questions_detail` VALUES ('229', '1', 'F1', 'F16a', 'Combobox', '< 2.500.000', '', null, '', '', '2014-06-22 04:06:49', '2014-06-22 04:06:49');
INSERT INTO `questions_detail` VALUES ('230', '4', 'F1', 'F16a', 'Combobox', '7.500.000 - 10.000.000', '', null, '', '', '2014-06-22 04:06:49', '2014-06-22 04:06:49');
INSERT INTO `questions_detail` VALUES ('231', '3', 'F1', 'F16a', 'Combobox', '5.000.000 - 7.500.000', '', null, '', '', '2014-06-22 04:06:49', '2014-06-22 04:06:49');
INSERT INTO `questions_detail` VALUES ('232', '5', 'F1', 'F15', 'Combobox', 'Pertanian, Kehutanan dan Perikanan', '', null, '', '', '2014-06-22 04:41:28', '2014-06-22 04:41:28');
INSERT INTO `questions_detail` VALUES ('233', '2', 'F1', 'F15', 'Combobox', 'Pertambangan dan Penggalian', '', null, '', '', '2014-06-22 04:41:28', '2014-06-22 04:41:28');
INSERT INTO `questions_detail` VALUES ('234', '4', 'F1', 'F15', 'Combobox', 'Pengadaan Listrik, Gas, Uap/Air Panas dan Udara Dingin', '', null, '', '', '2014-06-22 04:41:28', '2014-06-22 04:41:28');
INSERT INTO `questions_detail` VALUES ('235', '3', 'F1', 'F15', 'Combobox', 'Industri Pengolahan', '', null, '', '', '2014-06-22 04:41:28', '2014-06-22 04:41:28');
INSERT INTO `questions_detail` VALUES ('236', '1', 'F1', 'F15', 'Combobox', 'Pertanian, Kehutanan dan Perikanan', '', null, '', '', '2014-06-22 04:41:28', '2014-06-22 04:41:28');
INSERT INTO `questions_detail` VALUES ('237', '6', 'F1', 'F15', 'Combobox', 'Pengadaan Air, Pengelolaan Sampah dan Daur Ulang, Pembuangan dan Pembersihan Limbah dan Sampah', '', null, '', '', '2014-06-22 04:41:29', '2014-06-22 04:41:29');
INSERT INTO `questions_detail` VALUES ('238', '7', 'F1', 'F15', 'Combobox', 'Konstruksi', '', null, '', '', '2014-06-22 04:41:29', '2014-06-22 04:41:29');
INSERT INTO `questions_detail` VALUES ('239', '9', 'F1', 'F15', 'Combobox', 'Transportasi dan Pergudangan', '', null, '', '', '2014-06-22 04:41:30', '2014-06-22 04:41:30');
INSERT INTO `questions_detail` VALUES ('240', '10', 'F1', 'F15', 'Combobox', 'Penyediaan Akomodasi dan Penyediaan Makan Minum', '', null, '', '', '2014-06-22 04:41:30', '2014-06-22 04:41:30');
INSERT INTO `questions_detail` VALUES ('241', '11', 'F1', 'F15', 'Combobox', 'Informasi dan Komunikasi', '', null, '', '', '2014-06-22 04:41:30', '2014-06-22 04:41:30');
INSERT INTO `questions_detail` VALUES ('242', '8', 'F1', 'F15', 'Combobox', 'Perdagangan Besar dan Eceran; Reparasi dan Perawatan Mobil dan Sepeda Motor', '', null, '', '', '2014-06-22 04:41:30', '2014-06-22 04:41:30');
INSERT INTO `questions_detail` VALUES ('243', '12', 'F1', 'F15', 'Combobox', 'Jasa Keuangan dan Asuransi', '', null, '', '', '2014-06-22 04:41:31', '2014-06-22 04:41:31');
INSERT INTO `questions_detail` VALUES ('244', '13', 'F1', 'F15', 'Combobox', 'Real Estat', '', null, '', '', '2014-06-22 04:41:31', '2014-06-22 04:41:31');
INSERT INTO `questions_detail` VALUES ('245', '14', 'F1', 'F15', 'Combobox', 'Jasa Profesional, Ilmiah dan Teknis', '', null, '', '', '2014-06-22 04:41:31', '2014-06-22 04:41:31');
INSERT INTO `questions_detail` VALUES ('246', '17', 'F1', 'F15', 'Combobox', 'Jasa Pendidikan', '', null, '', '', '2014-06-22 04:41:31', '2014-06-22 04:41:31');
INSERT INTO `questions_detail` VALUES ('247', '16', 'F1', 'F15', 'Combobox', 'Administrasi Pemerintahan, Pertahanan dan Jaminan Sosial Wajib', '', null, '', '', '2014-06-22 04:41:31', '2014-06-22 04:41:31');
INSERT INTO `questions_detail` VALUES ('248', '15', 'F1', 'F15', 'Combobox', 'Jasa Persewaan, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya', '', null, '', '', '2014-06-22 04:41:31', '2014-06-22 04:41:31');
INSERT INTO `questions_detail` VALUES ('249', '18', 'F1', 'F15', 'Combobox', 'Jasa Kesehatan dan Kegiatan Sosial', '', null, '', '', '2014-06-22 04:41:32', '2014-06-22 04:41:32');
INSERT INTO `questions_detail` VALUES ('250', '19', 'F1', 'F15', 'Combobox', 'Kebudayaan, Hiburan dan Rekreasi', '', null, '', '', '2014-06-22 04:41:32', '2014-06-22 04:41:32');
INSERT INTO `questions_detail` VALUES ('251', '20', 'F1', 'F15', 'Combobox', 'Kegiatan Jasa Lainnya', '', null, '', '', '2014-06-22 04:41:32', '2014-06-22 04:41:32');
INSERT INTO `questions_detail` VALUES ('252', '21', 'F1', 'F15', 'Combobox', 'Jasa Perorangan yang Melayani Rumah Tangga', '', null, '', '', '2014-06-22 04:41:33', '2014-06-22 04:41:33');
INSERT INTO `questions_detail` VALUES ('253', '22', 'F1', 'F15', 'Combobox', 'Kegiatan Badan Internasional dan Badan Ektra Internasional', '', null, '', '', '2014-06-22 04:41:33', '2014-06-22 04:41:33');
INSERT INTO `questions_detail` VALUES ('254', '3', 'F1', 'F16b', 'Combobox', '5.000.000 - 7.500.000', '', null, '', '', '2014-06-22 04:41:51', '2014-06-22 04:41:51');
INSERT INTO `questions_detail` VALUES ('255', '2', 'F1', 'F16b', 'Combobox', '2.500.000 - 5.000.000', '', null, '', '', '2014-06-22 04:41:51', '2014-06-22 04:41:51');
INSERT INTO `questions_detail` VALUES ('256', '1', 'F1', 'F16b', 'Combobox', '<2.500.000', '', null, '', '', '2014-06-22 04:41:51', '2014-06-22 04:41:51');
INSERT INTO `questions_detail` VALUES ('257', '4', 'F1', 'F16b', 'Combobox', '7.500.000 - 10.000.000', '', null, '', '', '2014-06-22 04:41:51', '2014-06-22 04:41:51');
INSERT INTO `questions_detail` VALUES ('258', '5', 'F1', 'F16b', 'Combobox', '>10.000.000', '', null, '', '', '2014-06-22 04:41:51', '2014-06-22 04:41:51');
INSERT INTO `questions_detail` VALUES ('259', '3', 'F1', 'F16c', 'Combobox', '5.000.000 - 7.500.000', '', null, '', '', '2014-06-22 04:42:01', '2014-06-22 04:42:01');
INSERT INTO `questions_detail` VALUES ('260', '4', 'F1', 'F16c', 'Combobox', '7.500.000 - 10.000.000', '', null, '', '', '2014-06-22 04:42:01', '2014-06-22 04:42:01');
INSERT INTO `questions_detail` VALUES ('261', '2', 'F1', 'F16c', 'Combobox', '2.500.000 - 5.000.000', '', null, '', '', '2014-06-22 04:42:01', '2014-06-22 04:42:01');
INSERT INTO `questions_detail` VALUES ('262', '1', 'F1', 'F16c', 'Combobox', '<2.500.000', '', null, '', '', '2014-06-22 04:42:01', '2014-06-22 04:42:01');
INSERT INTO `questions_detail` VALUES ('263', '5', 'F1', 'F16c', 'Combobox', '>10.000.000', '', null, '', '', '2014-06-22 04:42:01', '2014-06-22 04:42:01');
INSERT INTO `questions_detail` VALUES ('264', '1', 'F20', '3', 'Combobox', '1', '', null, '', '', '2014-06-23 06:30:05', '2014-06-23 06:30:05');
INSERT INTO `questions_detail` VALUES ('265', '3', 'F20', '3', 'Combobox', '3', '', null, '', '', '2014-06-23 06:30:05', '2014-06-23 06:30:05');
INSERT INTO `questions_detail` VALUES ('266', '2', 'F20', '3', 'Combobox', '2', '', null, '', '', '2014-06-23 06:30:05', '2014-06-23 06:30:05');
INSERT INTO `questions_detail` VALUES ('267', '4', 'F20', '3', 'Combobox', '4', '', null, '', '', '2014-06-23 06:30:07', '2014-06-23 06:30:07');
INSERT INTO `questions_detail` VALUES ('268', '5', 'F20', '3', 'Combobox', '5', '', null, '', '', '2014-06-23 06:30:07', '2014-06-23 06:30:07');
INSERT INTO `questions_detail` VALUES ('269', '2', 'F20', '4', 'Combobox', '2', '', null, '', '', '2014-06-23 06:30:28', '2014-06-23 06:30:28');
INSERT INTO `questions_detail` VALUES ('270', '1', 'F20', '4', 'Combobox', '1', '', null, '', '', '2014-06-23 06:30:28', '2014-06-23 06:30:28');
INSERT INTO `questions_detail` VALUES ('271', '3', 'F20', '4', 'Combobox', '3', '', null, '', '', '2014-06-23 06:30:28', '2014-06-23 06:30:28');
INSERT INTO `questions_detail` VALUES ('272', '4', 'F20', '4', 'Combobox', '4', '', null, '', '', '2014-06-23 06:30:29', '2014-06-23 06:30:29');
INSERT INTO `questions_detail` VALUES ('273', '5', 'F20', '4', 'Combobox', '5', '', null, '', '', '2014-06-23 06:30:29', '2014-06-23 06:30:29');
INSERT INTO `questions_detail` VALUES ('274', '2', 'F20', '5', 'Combobox', '2', '', null, '', '', '2014-06-23 06:31:00', '2014-06-23 06:31:00');
INSERT INTO `questions_detail` VALUES ('275', '1', 'F20', '5', 'Combobox', '1', '', null, '', '', '2014-06-23 06:31:01', '2014-06-23 06:31:01');
INSERT INTO `questions_detail` VALUES ('276', '3', 'F20', '5', 'Combobox', '3', '', null, '', '', '2014-06-23 06:31:01', '2014-06-23 06:31:01');
INSERT INTO `questions_detail` VALUES ('277', '4', 'F20', '5', 'Combobox', '4', '', null, '', '', '2014-06-23 06:31:02', '2014-06-23 06:31:02');
INSERT INTO `questions_detail` VALUES ('278', '5', 'F20', '5', 'Combobox', '5', '', null, '', '', '2014-06-23 06:31:02', '2014-06-23 06:31:02');
INSERT INTO `questions_detail` VALUES ('279', '1', 'F20', '6', 'Combobox', '1', '', null, '', '', '2014-06-23 06:31:28', '2014-06-23 06:31:28');
INSERT INTO `questions_detail` VALUES ('280', '3', 'F20', '6', 'Combobox', '3', '', null, '', '', '2014-06-23 06:31:28', '2014-06-23 06:31:28');
INSERT INTO `questions_detail` VALUES ('281', '2', 'F20', '6', 'Combobox', '2', '', null, '', '', '2014-06-23 06:31:29', '2014-06-23 06:31:29');
INSERT INTO `questions_detail` VALUES ('282', '4', 'F20', '6', 'Combobox', '4', '', null, '', '', '2014-06-23 06:31:30', '2014-06-23 06:31:30');
INSERT INTO `questions_detail` VALUES ('283', '5', 'F20', '6', 'Combobox', '5', '', null, '', '', '2014-06-23 06:31:30', '2014-06-23 06:31:30');
INSERT INTO `questions_detail` VALUES ('310', '2', 'F20', '26', 'Combobox', '2', '', null, '', '', '2014-06-23 06:46:44', '2014-06-23 06:46:44');
INSERT INTO `questions_detail` VALUES ('311', '3', 'F20', '26', 'Combobox', '3', '', null, '', '', '2014-06-23 06:46:44', '2014-06-23 06:46:44');
INSERT INTO `questions_detail` VALUES ('312', '1', 'F20', '26', 'Combobox', '1', '', null, '', '', '2014-06-23 06:46:44', '2014-06-23 06:46:44');
INSERT INTO `questions_detail` VALUES ('313', '4', 'F20', '26', 'Combobox', '4', '', null, '', '', '2014-06-23 06:46:46', '2014-06-23 06:46:46');
INSERT INTO `questions_detail` VALUES ('314', '5', 'F20', '26', 'Combobox', '5', '', null, '', '', '2014-06-23 06:46:46', '2014-06-23 06:46:46');
INSERT INTO `questions_detail` VALUES ('320', '2', 'F20', '22', 'Combobox', '2', '', null, '', '', '2014-06-23 06:47:13', '2014-06-23 06:47:13');
INSERT INTO `questions_detail` VALUES ('321', '3', 'F20', '22', 'Combobox', '3', '', null, '', '', '2014-06-23 06:47:13', '2014-06-23 06:47:13');
INSERT INTO `questions_detail` VALUES ('322', '1', 'F20', '22', 'Combobox', '1', '', null, '', '', '2014-06-23 06:47:13', '2014-06-23 06:47:13');
INSERT INTO `questions_detail` VALUES ('323', '4', 'F20', '22', 'Combobox', '4', '', null, '', '', '2014-06-23 06:47:14', '2014-06-23 06:47:14');
INSERT INTO `questions_detail` VALUES ('324', '5', 'F20', '22', 'Combobox', '5', '', null, '', '', '2014-06-23 06:47:14', '2014-06-23 06:47:14');
INSERT INTO `questions_detail` VALUES ('330', '3', 'F20', '8', 'Combobox', '3', '', null, '', '', '2014-06-23 06:47:32', '2014-06-23 06:47:32');
INSERT INTO `questions_detail` VALUES ('331', '1', 'F20', '8', 'Combobox', '1', '', null, '', '', '2014-06-23 06:47:32', '2014-06-23 06:47:32');
INSERT INTO `questions_detail` VALUES ('332', '2', 'F20', '8', 'Combobox', '2', '', null, '', '', '2014-06-23 06:47:32', '2014-06-23 06:47:32');
INSERT INTO `questions_detail` VALUES ('333', '4', 'F20', '8', 'Combobox', '4', '', null, '', '', '2014-06-23 06:47:33', '2014-06-23 06:47:33');
INSERT INTO `questions_detail` VALUES ('334', '5', 'F20', '8', 'Combobox', '5', '', null, '', '', '2014-06-23 06:47:33', '2014-06-23 06:47:33');
INSERT INTO `questions_detail` VALUES ('335', '3', 'F20', '10', 'Combobox', '3', '', null, '', '', '2014-06-23 06:47:43', '2014-06-23 06:47:43');
INSERT INTO `questions_detail` VALUES ('336', '2', 'F20', '10', 'Combobox', '2', '', null, '', '', '2014-06-23 06:47:43', '2014-06-23 06:47:43');
INSERT INTO `questions_detail` VALUES ('337', '1', 'F20', '10', 'Combobox', '1', '', null, '', '', '2014-06-23 06:47:43', '2014-06-23 06:47:43');
INSERT INTO `questions_detail` VALUES ('338', '4', 'F20', '10', 'Combobox', '4', '', null, '', '', '2014-06-23 06:47:44', '2014-06-23 06:47:44');
INSERT INTO `questions_detail` VALUES ('339', '5', 'F20', '10', 'Combobox', '5', '', null, '', '', '2014-06-23 06:47:44', '2014-06-23 06:47:44');
INSERT INTO `questions_detail` VALUES ('340', '2', 'F20', '12', 'Combobox', '2', '', null, '', '', '2014-06-23 06:48:31', '2014-06-23 06:48:31');
INSERT INTO `questions_detail` VALUES ('341', '1', 'F20', '12', 'Combobox', '1', '', null, '', '', '2014-06-23 06:48:31', '2014-06-23 06:48:31');
INSERT INTO `questions_detail` VALUES ('342', '3', 'F20', '12', 'Combobox', '3', '', null, '', '', '2014-06-23 06:48:31', '2014-06-23 06:48:31');
INSERT INTO `questions_detail` VALUES ('343', '4', 'F20', '12', 'Combobox', '4', '', null, '', '', '2014-06-23 06:48:32', '2014-06-23 06:48:32');
INSERT INTO `questions_detail` VALUES ('344', '5', 'F20', '12', 'Combobox', '5', '', null, '', '', '2014-06-23 06:48:33', '2014-06-23 06:48:33');
INSERT INTO `questions_detail` VALUES ('345', '3', 'F20', '14', 'Combobox', '3', '', null, '', '', '2014-06-23 06:48:41', '2014-06-23 06:48:41');
INSERT INTO `questions_detail` VALUES ('346', '2', 'F20', '14', 'Combobox', '2', '', null, '', '', '2014-06-23 06:48:41', '2014-06-23 06:48:41');
INSERT INTO `questions_detail` VALUES ('347', '1', 'F20', '14', 'Combobox', '1', '', null, '', '', '2014-06-23 06:48:41', '2014-06-23 06:48:41');
INSERT INTO `questions_detail` VALUES ('348', '4', 'F20', '14', 'Combobox', '4', '', null, '', '', '2014-06-23 06:48:43', '2014-06-23 06:48:43');
INSERT INTO `questions_detail` VALUES ('349', '5', 'F20', '14', 'Combobox', '5', '', null, '', '', '2014-06-23 06:48:43', '2014-06-23 06:48:43');
INSERT INTO `questions_detail` VALUES ('350', '1', 'F20', '15', 'Combobox', '1', '', null, '', '', '2014-06-23 06:48:56', '2014-06-23 06:48:56');
INSERT INTO `questions_detail` VALUES ('351', '3', 'F20', '15', 'Combobox', '3', '', null, '', '', '2014-06-23 06:48:56', '2014-06-23 06:48:56');
INSERT INTO `questions_detail` VALUES ('352', '2', 'F20', '15', 'Combobox', '2', '', null, '', '', '2014-06-23 06:48:56', '2014-06-23 06:48:56');
INSERT INTO `questions_detail` VALUES ('353', '4', 'F20', '15', 'Combobox', '4', '', null, '', '', '2014-06-23 06:48:58', '2014-06-23 06:48:58');
INSERT INTO `questions_detail` VALUES ('354', '5', 'F20', '15', 'Combobox', '5', '', null, '', '', '2014-06-23 06:48:58', '2014-06-23 06:48:58');
INSERT INTO `questions_detail` VALUES ('356', '2', 'F21', '1', 'Combobox', '2', '', null, '', '', '2014-06-23 13:50:25', '2014-06-23 13:50:25');
INSERT INTO `questions_detail` VALUES ('357', '1', 'F21', '1', 'Combobox', '1', '', null, '', '', '2014-06-23 13:50:25', '2014-06-23 13:50:25');
INSERT INTO `questions_detail` VALUES ('358', '3', 'F21', '1', 'Combobox', '3', '', null, '', '', '2014-06-23 13:50:25', '2014-06-23 13:50:25');
INSERT INTO `questions_detail` VALUES ('359', '4', 'F21', '1', 'Combobox', '4', '', null, '', '', '2014-06-23 13:50:26', '2014-06-23 13:50:26');
INSERT INTO `questions_detail` VALUES ('360', '5', 'F21', '1', 'Combobox', '5', '', null, '', '', '2014-06-23 13:50:26', '2014-06-23 13:50:26');
INSERT INTO `questions_detail` VALUES ('361', '1', 'F21', '10', 'Combobox', '1', '', null, '', '', '2014-06-23 13:50:38', '2014-06-23 13:50:38');
INSERT INTO `questions_detail` VALUES ('362', '3', 'F21', '10', 'Combobox', '3', '', null, '', '', '2014-06-23 13:50:38', '2014-06-23 13:50:38');
INSERT INTO `questions_detail` VALUES ('363', '2', 'F21', '10', 'Combobox', '2', '', null, '', '', '2014-06-23 13:50:38', '2014-06-23 13:50:38');
INSERT INTO `questions_detail` VALUES ('364', '4', 'F21', '10', 'Combobox', '4', '', null, '', '', '2014-06-23 13:50:39', '2014-06-23 13:50:39');
INSERT INTO `questions_detail` VALUES ('365', '5', 'F21', '10', 'Combobox', '5', '', null, '', '', '2014-06-23 13:50:39', '2014-06-23 13:50:39');
INSERT INTO `questions_detail` VALUES ('371', '2', 'F21', '12', 'Combobox', '2', '', null, '', '', '2014-06-23 13:51:08', '2014-06-23 13:51:08');
INSERT INTO `questions_detail` VALUES ('372', '1', 'F21', '12', 'Combobox', '1', '', null, '', '', '2014-06-23 13:51:08', '2014-06-23 13:51:08');
INSERT INTO `questions_detail` VALUES ('373', '3', 'F21', '12', 'Combobox', '3', '', null, '', '', '2014-06-23 13:51:08', '2014-06-23 13:51:08');
INSERT INTO `questions_detail` VALUES ('374', '4', 'F21', '12', 'Combobox', '4', '', null, '', '', '2014-06-23 13:51:09', '2014-06-23 13:51:09');
INSERT INTO `questions_detail` VALUES ('375', '5', 'F21', '12', 'Combobox', '5', '', null, '', '', '2014-06-23 13:51:09', '2014-06-23 13:51:09');
INSERT INTO `questions_detail` VALUES ('376', '2', 'F21', '13', 'Combobox', '2', '', null, '', '', '2014-06-23 13:51:20', '2014-06-23 13:51:20');
INSERT INTO `questions_detail` VALUES ('377', '1', 'F21', '13', 'Combobox', '1', '', null, '', '', '2014-06-23 13:51:20', '2014-06-23 13:51:20');
INSERT INTO `questions_detail` VALUES ('378', '3', 'F21', '13', 'Combobox', '3', '', null, '', '', '2014-06-23 13:51:21', '2014-06-23 13:51:21');
INSERT INTO `questions_detail` VALUES ('379', '4', 'F21', '13', 'Combobox', '4', '', null, '', '', '2014-06-23 13:51:22', '2014-06-23 13:51:22');
INSERT INTO `questions_detail` VALUES ('380', '5', 'F21', '13', 'Combobox', '5', '', null, '', '', '2014-06-23 13:51:22', '2014-06-23 13:51:22');
INSERT INTO `questions_detail` VALUES ('381', '2', 'F21', '14', 'Combobox', '2', '', null, '', '', '2014-06-23 13:51:31', '2014-06-23 13:51:31');
INSERT INTO `questions_detail` VALUES ('382', '3', 'F21', '14', 'Combobox', '3', '', null, '', '', '2014-06-23 13:51:31', '2014-06-23 13:51:31');
INSERT INTO `questions_detail` VALUES ('383', '1', 'F21', '14', 'Combobox', '1', '', null, '', '', '2014-06-23 13:51:31', '2014-06-23 13:51:31');
INSERT INTO `questions_detail` VALUES ('384', '5', 'F21', '14', 'Combobox', '5', '', null, '', '', '2014-06-23 13:51:32', '2014-06-23 13:51:32');
INSERT INTO `questions_detail` VALUES ('385', '4', 'F21', '14', 'Combobox', '4', '', null, '', '', '2014-06-23 13:51:32', '2014-06-23 13:51:32');
INSERT INTO `questions_detail` VALUES ('386', '3', 'F21', '15', 'Combobox', '3', '', null, '', '', '2014-06-23 13:51:42', '2014-06-23 13:51:42');
INSERT INTO `questions_detail` VALUES ('387', '1', 'F21', '15', 'Combobox', '1', '', null, '', '', '2014-06-23 13:51:42', '2014-06-23 13:51:42');
INSERT INTO `questions_detail` VALUES ('388', '2', 'F21', '15', 'Combobox', '2', '', null, '', '', '2014-06-23 13:51:42', '2014-06-23 13:51:42');
INSERT INTO `questions_detail` VALUES ('389', '4', 'F21', '15', 'Combobox', '4', '', null, '', '', '2014-06-23 13:51:43', '2014-06-23 13:51:43');
INSERT INTO `questions_detail` VALUES ('390', '5', 'F21', '15', 'Combobox', '5', '', null, '', '', '2014-06-23 13:51:43', '2014-06-23 13:51:43');
INSERT INTO `questions_detail` VALUES ('396', '3', 'F21', '16', 'Combobox', '3', '', null, '', '', '2014-06-23 13:51:58', '2014-06-23 13:51:58');
INSERT INTO `questions_detail` VALUES ('397', '1', 'F21', '16', 'Combobox', '1', '', null, '', '', '2014-06-23 13:51:58', '2014-06-23 13:51:58');
INSERT INTO `questions_detail` VALUES ('398', '2', 'F21', '16', 'Combobox', '2', '', null, '', '', '2014-06-23 13:51:58', '2014-06-23 13:51:58');
INSERT INTO `questions_detail` VALUES ('399', '4', 'F21', '16', 'Combobox', '4', '', null, '', '', '2014-06-23 13:51:59', '2014-06-23 13:51:59');
INSERT INTO `questions_detail` VALUES ('400', '5', 'F21', '16', 'Combobox', '5', '', null, '', '', '2014-06-23 13:51:59', '2014-06-23 13:51:59');
INSERT INTO `questions_detail` VALUES ('401', '1', 'F21', '17', 'Combobox', '1', '', null, '', '', '2014-06-23 13:52:07', '2014-06-23 13:52:07');
INSERT INTO `questions_detail` VALUES ('402', '2', 'F21', '17', 'Combobox', '2', '', null, '', '', '2014-06-23 13:52:07', '2014-06-23 13:52:07');
INSERT INTO `questions_detail` VALUES ('403', '3', 'F21', '17', 'Combobox', '3', '', null, '', '', '2014-06-23 13:52:08', '2014-06-23 13:52:08');
INSERT INTO `questions_detail` VALUES ('404', '4', 'F21', '17', 'Combobox', '4', '', null, '', '', '2014-06-23 13:52:09', '2014-06-23 13:52:09');
INSERT INTO `questions_detail` VALUES ('405', '5', 'F21', '17', 'Combobox', '5', '', null, '', '', '2014-06-23 13:52:09', '2014-06-23 13:52:09');
INSERT INTO `questions_detail` VALUES ('406', '3', 'F21', '18', 'Combobox', '3', '', null, '', '', '2014-06-23 13:52:17', '2014-06-23 13:52:17');
INSERT INTO `questions_detail` VALUES ('407', '2', 'F21', '18', 'Combobox', '2', '', null, '', '', '2014-06-23 13:52:17', '2014-06-23 13:52:17');
INSERT INTO `questions_detail` VALUES ('408', '1', 'F21', '18', 'Combobox', '1', '', null, '', '', '2014-06-23 13:52:17', '2014-06-23 13:52:17');
INSERT INTO `questions_detail` VALUES ('409', '4', 'F21', '18', 'Combobox', '4', '', null, '', '', '2014-06-23 13:52:18', '2014-06-23 13:52:18');
INSERT INTO `questions_detail` VALUES ('410', '5', 'F21', '18', 'Combobox', '5', '', null, '', '', '2014-06-23 13:52:18', '2014-06-23 13:52:18');
INSERT INTO `questions_detail` VALUES ('411', '1', 'F21', '19', 'Combobox', '1', '', null, '', '', '2014-06-23 13:52:32', '2014-06-23 13:52:32');
INSERT INTO `questions_detail` VALUES ('412', '2', 'F21', '19', 'Combobox', '2', '', null, '', '', '2014-06-23 13:52:32', '2014-06-23 13:52:32');
INSERT INTO `questions_detail` VALUES ('413', '3', 'F21', '19', 'Combobox', '3', '', null, '', '', '2014-06-23 13:52:32', '2014-06-23 13:52:32');
INSERT INTO `questions_detail` VALUES ('414', '4', 'F21', '19', 'Combobox', '4', '', null, '', '', '2014-06-23 13:52:33', '2014-06-23 13:52:33');
INSERT INTO `questions_detail` VALUES ('415', '5', 'F21', '19', 'Combobox', '5', '', null, '', '', '2014-06-23 13:52:34', '2014-06-23 13:52:34');
INSERT INTO `questions_detail` VALUES ('416', '3', 'F21', '2', 'Combobox', '3', '', null, '', '', '2014-06-23 13:52:46', '2014-06-23 13:52:46');
INSERT INTO `questions_detail` VALUES ('417', '2', 'F21', '2', 'Combobox', '2', '', null, '', '', '2014-06-23 13:52:46', '2014-06-23 13:52:46');
INSERT INTO `questions_detail` VALUES ('418', '1', 'F21', '2', 'Combobox', '1', '', null, '', '', '2014-06-23 13:52:46', '2014-06-23 13:52:46');
INSERT INTO `questions_detail` VALUES ('419', '4', 'F21', '2', 'Combobox', '4', '', null, '', '', '2014-06-23 13:52:47', '2014-06-23 13:52:47');
INSERT INTO `questions_detail` VALUES ('420', '5', 'F21', '2', 'Combobox', '5', '', null, '', '', '2014-06-23 13:52:48', '2014-06-23 13:52:48');
INSERT INTO `questions_detail` VALUES ('421', '3', 'F21', '11', 'Combobox', '3', '', null, '', '', '2014-06-23 13:52:57', '2014-06-23 13:52:57');
INSERT INTO `questions_detail` VALUES ('422', '1', 'F21', '11', 'Combobox', '1', '', null, '', '', '2014-06-23 13:52:57', '2014-06-23 13:52:57');
INSERT INTO `questions_detail` VALUES ('423', '2', 'F21', '11', 'Combobox', '2', '', null, '', '', '2014-06-23 13:52:57', '2014-06-23 13:52:57');
INSERT INTO `questions_detail` VALUES ('424', '5', 'F21', '11', 'Combobox', '5', '', null, '', '', '2014-06-23 13:52:58', '2014-06-23 13:52:58');
INSERT INTO `questions_detail` VALUES ('425', '4', 'F21', '11', 'Combobox', '4', '', null, '', '', '2014-06-23 13:52:58', '2014-06-23 13:52:58');
INSERT INTO `questions_detail` VALUES ('426', '3', 'F21', '20', 'Combobox', '3', '', null, '', '', '2014-06-23 13:53:13', '2014-06-23 13:53:13');
INSERT INTO `questions_detail` VALUES ('427', '2', 'F21', '20', 'Combobox', '2', '', null, '', '', '2014-06-23 13:53:13', '2014-06-23 13:53:13');
INSERT INTO `questions_detail` VALUES ('428', '1', 'F21', '20', 'Combobox', '1', '', null, '', '', '2014-06-23 13:53:13', '2014-06-23 13:53:13');
INSERT INTO `questions_detail` VALUES ('429', '4', 'F21', '20', 'Combobox', '4', '', null, '', '', '2014-06-23 13:53:14', '2014-06-23 13:53:14');
INSERT INTO `questions_detail` VALUES ('430', '5', 'F21', '20', 'Combobox', '5', '', null, '', '', '2014-06-23 13:53:14', '2014-06-23 13:53:14');
INSERT INTO `questions_detail` VALUES ('436', '3', 'F21', '22', 'Combobox', '3', '', null, '', '', '2014-06-23 13:53:37', '2014-06-23 13:53:37');
INSERT INTO `questions_detail` VALUES ('437', '2', 'F21', '22', 'Combobox', '2', '', null, '', '', '2014-06-23 13:53:37', '2014-06-23 13:53:37');
INSERT INTO `questions_detail` VALUES ('438', '1', 'F21', '22', 'Combobox', '1', '', null, '', '', '2014-06-23 13:53:37', '2014-06-23 13:53:37');
INSERT INTO `questions_detail` VALUES ('439', '4', 'F21', '22', 'Combobox', '4', '', null, '', '', '2014-06-23 13:53:39', '2014-06-23 13:53:39');
INSERT INTO `questions_detail` VALUES ('440', '5', 'F21', '22', 'Combobox', '5', '', null, '', '', '2014-06-23 13:53:39', '2014-06-23 13:53:39');
INSERT INTO `questions_detail` VALUES ('441', '3', 'F21', '21', 'Combobox', '3', '', null, '', '', '2014-06-23 13:53:43', '2014-06-23 13:53:43');
INSERT INTO `questions_detail` VALUES ('442', '1', 'F21', '21', 'Combobox', '1', '', null, '', '', '2014-06-23 13:53:43', '2014-06-23 13:53:43');
INSERT INTO `questions_detail` VALUES ('443', '2', 'F21', '21', 'Combobox', '2', '', null, '', '', '2014-06-23 13:53:43', '2014-06-23 13:53:43');
INSERT INTO `questions_detail` VALUES ('444', '4', 'F21', '21', 'Combobox', '4', '', null, '', '', '2014-06-23 13:53:45', '2014-06-23 13:53:45');
INSERT INTO `questions_detail` VALUES ('445', '5', 'F21', '21', 'Combobox', '5', '', null, '', '', '2014-06-23 13:53:45', '2014-06-23 13:53:45');
INSERT INTO `questions_detail` VALUES ('446', '2', 'F21', '24', 'Combobox', '2', '', null, '', '', '2014-06-23 13:53:56', '2014-06-23 13:53:56');
INSERT INTO `questions_detail` VALUES ('447', '3', 'F21', '24', 'Combobox', '3', '', null, '', '', '2014-06-23 13:53:57', '2014-06-23 13:53:57');
INSERT INTO `questions_detail` VALUES ('448', '1', 'F21', '24', 'Combobox', '1', '', null, '', '', '2014-06-23 13:53:57', '2014-06-23 13:53:57');
INSERT INTO `questions_detail` VALUES ('449', '5', 'F21', '24', 'Combobox', '5', '', null, '', '', '2014-06-23 13:53:58', '2014-06-23 13:53:58');
INSERT INTO `questions_detail` VALUES ('450', '4', 'F21', '24', 'Combobox', '4', '', null, '', '', '2014-06-23 13:53:58', '2014-06-23 13:53:58');
INSERT INTO `questions_detail` VALUES ('451', '1', 'F20', '9', 'Combobox', '1', '', null, '', '', '2014-06-23 15:06:51', '2014-06-23 15:06:51');
INSERT INTO `questions_detail` VALUES ('452', '3', 'F20', '9', 'Combobox', '3', '', null, '', '', '2014-06-23 15:06:51', '2014-06-23 15:06:51');
INSERT INTO `questions_detail` VALUES ('453', '2', 'F20', '9', 'Combobox', '2', '', null, '', '', '2014-06-23 15:06:51', '2014-06-23 15:06:51');
INSERT INTO `questions_detail` VALUES ('454', '4', 'F20', '9', 'Combobox', '4', '', null, '', '', '2014-06-23 15:06:52', '2014-06-23 15:06:52');
INSERT INTO `questions_detail` VALUES ('455', '5', 'F20', '9', 'Combobox', '5', '', null, '', '', '2014-06-23 15:06:52', '2014-06-23 15:06:52');
INSERT INTO `questions_detail` VALUES ('456', '2', 'F20', '11', 'Combobox', '2', '', null, '', '', '2014-06-23 15:07:51', '2014-06-23 15:07:51');
INSERT INTO `questions_detail` VALUES ('457', '3', 'F20', '11', 'Combobox', '3', '', null, '', '', '2014-06-23 15:07:51', '2014-06-23 15:07:51');
INSERT INTO `questions_detail` VALUES ('458', '1', 'F20', '11', 'Combobox', '1', '', null, '', '', '2014-06-23 15:07:51', '2014-06-23 15:07:51');
INSERT INTO `questions_detail` VALUES ('459', '4', 'F20', '11', 'Combobox', '4', '', null, '', '', '2014-06-23 15:07:53', '2014-06-23 15:07:53');
INSERT INTO `questions_detail` VALUES ('460', '5', 'F20', '11', 'Combobox', '5', '', null, '', '', '2014-06-23 15:07:53', '2014-06-23 15:07:53');
INSERT INTO `questions_detail` VALUES ('461', '2', 'F20', '17', 'Combobox', '2', '', null, '', '', '2014-06-23 15:08:18', '2014-06-23 15:08:18');
INSERT INTO `questions_detail` VALUES ('462', '3', 'F20', '17', 'Combobox', '3', '', null, '', '', '2014-06-23 15:08:18', '2014-06-23 15:08:18');
INSERT INTO `questions_detail` VALUES ('463', '1', 'F20', '17', 'Combobox', '1', '', null, '', '', '2014-06-23 15:08:18', '2014-06-23 15:08:18');
INSERT INTO `questions_detail` VALUES ('464', '4', 'F20', '17', 'Combobox', '4', '', null, '', '', '2014-06-23 15:08:20', '2014-06-23 15:08:20');
INSERT INTO `questions_detail` VALUES ('465', '5', 'F20', '17', 'Combobox', '5', '', null, '', '', '2014-06-23 15:08:20', '2014-06-23 15:08:20');
INSERT INTO `questions_detail` VALUES ('466', '1', 'F20', '16', 'Combobox', '1', '', null, '', '', '2014-06-23 15:08:28', '2014-06-23 15:08:28');
INSERT INTO `questions_detail` VALUES ('467', '3', 'F20', '16', 'Combobox', '3', '', null, '', '', '2014-06-23 15:08:28', '2014-06-23 15:08:28');
INSERT INTO `questions_detail` VALUES ('468', '2', 'F20', '16', 'Combobox', '2', '', null, '', '', '2014-06-23 15:08:28', '2014-06-23 15:08:28');
INSERT INTO `questions_detail` VALUES ('469', '4', 'F20', '16', 'Combobox', '4', '', null, '', '', '2014-06-23 15:08:29', '2014-06-23 15:08:29');
INSERT INTO `questions_detail` VALUES ('470', '5', 'F20', '16', 'Combobox', '5', '', null, '', '', '2014-06-23 15:08:29', '2014-06-23 15:08:29');
INSERT INTO `questions_detail` VALUES ('471', '3', 'F20', '18', 'Combobox', '3', '', null, '', '', '2014-06-23 15:08:45', '2014-06-23 15:08:45');
INSERT INTO `questions_detail` VALUES ('472', '1', 'F20', '18', 'Combobox', '1', '', null, '', '', '2014-06-23 15:08:45', '2014-06-23 15:08:45');
INSERT INTO `questions_detail` VALUES ('473', '2', 'F20', '18', 'Combobox', '2', '', null, '', '', '2014-06-23 15:08:45', '2014-06-23 15:08:45');
INSERT INTO `questions_detail` VALUES ('474', '4', 'F20', '18', 'Combobox', '4', '', null, '', '', '2014-06-23 15:08:46', '2014-06-23 15:08:46');
INSERT INTO `questions_detail` VALUES ('475', '5', 'F20', '18', 'Combobox', '5', '', null, '', '', '2014-06-23 15:08:46', '2014-06-23 15:08:46');
INSERT INTO `questions_detail` VALUES ('476', '1', 'F20', '19', 'Combobox', '1', '', null, '', '', '2014-06-23 15:09:00', '2014-06-23 15:09:00');
INSERT INTO `questions_detail` VALUES ('477', '3', 'F20', '19', 'Combobox', '3', '', null, '', '', '2014-06-23 15:09:00', '2014-06-23 15:09:00');
INSERT INTO `questions_detail` VALUES ('478', '2', 'F20', '19', 'Combobox', '2', '', null, '', '', '2014-06-23 15:09:00', '2014-06-23 15:09:00');
INSERT INTO `questions_detail` VALUES ('479', '4', 'F20', '19', 'Combobox', '4', '', null, '', '', '2014-06-23 15:09:01', '2014-06-23 15:09:01');
INSERT INTO `questions_detail` VALUES ('480', '5', 'F20', '19', 'Combobox', '5', '', null, '', '', '2014-06-23 15:09:01', '2014-06-23 15:09:01');
INSERT INTO `questions_detail` VALUES ('481', '2', 'F20', '2', 'Combobox', '2', '', null, '', '', '2014-06-23 15:09:15', '2014-06-23 15:09:15');
INSERT INTO `questions_detail` VALUES ('482', '1', 'F20', '2', 'Combobox', '1', '', null, '', '', '2014-06-23 15:09:15', '2014-06-23 15:09:15');
INSERT INTO `questions_detail` VALUES ('483', '3', 'F20', '2', 'Combobox', '3', '', null, '', '', '2014-06-23 15:09:15', '2014-06-23 15:09:15');
INSERT INTO `questions_detail` VALUES ('484', '4', 'F20', '2', 'Combobox', '4', '', null, '', '', '2014-06-23 15:09:17', '2014-06-23 15:09:17');
INSERT INTO `questions_detail` VALUES ('485', '5', 'F20', '2', 'Combobox', '5', '', null, '', '', '2014-06-23 15:09:17', '2014-06-23 15:09:17');
INSERT INTO `questions_detail` VALUES ('486', '1', 'F20', '20', 'Combobox', '1', '', null, '', '', '2014-06-23 15:09:29', '2014-06-23 15:09:29');
INSERT INTO `questions_detail` VALUES ('487', '2', 'F20', '20', 'Combobox', '2', '', null, '', '', '2014-06-23 15:09:29', '2014-06-23 15:09:29');
INSERT INTO `questions_detail` VALUES ('488', '3', 'F20', '20', 'Combobox', '3', '', null, '', '', '2014-06-23 15:09:29', '2014-06-23 15:09:29');
INSERT INTO `questions_detail` VALUES ('489', '4', 'F20', '20', 'Combobox', '4', '', null, '', '', '2014-06-23 15:09:31', '2014-06-23 15:09:31');
INSERT INTO `questions_detail` VALUES ('490', '5', 'F20', '20', 'Combobox', '5', '', null, '', '', '2014-06-23 15:09:31', '2014-06-23 15:09:31');
INSERT INTO `questions_detail` VALUES ('491', '2', 'F20', '21', 'Combobox', '2', '', null, '', '', '2014-06-23 15:09:36', '2014-06-23 15:09:36');
INSERT INTO `questions_detail` VALUES ('492', '1', 'F20', '21', 'Combobox', '1', '', null, '', '', '2014-06-23 15:09:36', '2014-06-23 15:09:36');
INSERT INTO `questions_detail` VALUES ('493', '3', 'F20', '21', 'Combobox', '3', '', null, '', '', '2014-06-23 15:09:36', '2014-06-23 15:09:36');
INSERT INTO `questions_detail` VALUES ('494', '4', 'F20', '21', 'Combobox', '4', '', null, '', '', '2014-06-23 15:09:37', '2014-06-23 15:09:37');
INSERT INTO `questions_detail` VALUES ('495', '5', 'F20', '21', 'Combobox', '5', '', null, '', '', '2014-06-23 15:09:37', '2014-06-23 15:09:37');
INSERT INTO `questions_detail` VALUES ('496', '1', 'F20', '23', 'Combobox', '1', '', null, '', '', '2014-06-23 15:09:51', '2014-06-23 15:09:51');
INSERT INTO `questions_detail` VALUES ('497', '3', 'F20', '23', 'Combobox', '3', '', null, '', '', '2014-06-23 15:09:51', '2014-06-23 15:09:51');
INSERT INTO `questions_detail` VALUES ('498', '2', 'F20', '23', 'Combobox', '2', '', null, '', '', '2014-06-23 15:09:51', '2014-06-23 15:09:51');
INSERT INTO `questions_detail` VALUES ('499', '4', 'F20', '23', 'Combobox', '4', '', null, '', '', '2014-06-23 15:09:52', '2014-06-23 15:09:52');
INSERT INTO `questions_detail` VALUES ('500', '5', 'F20', '23', 'Combobox', '5', '', null, '', '', '2014-06-23 15:09:52', '2014-06-23 15:09:52');
INSERT INTO `questions_detail` VALUES ('501', '1', 'F20', '24', 'Combobox', '1', '', null, '', '', '2014-06-23 15:10:00', '2014-06-23 15:10:00');
INSERT INTO `questions_detail` VALUES ('502', '3', 'F20', '24', 'Combobox', '3', '', null, '', '', '2014-06-23 15:10:00', '2014-06-23 15:10:00');
INSERT INTO `questions_detail` VALUES ('503', '2', 'F20', '24', 'Combobox', '2', '', null, '', '', '2014-06-23 15:10:00', '2014-06-23 15:10:00');
INSERT INTO `questions_detail` VALUES ('504', '4', 'F20', '24', 'Combobox', '4', '', null, '', '', '2014-06-23 15:10:01', '2014-06-23 15:10:01');
INSERT INTO `questions_detail` VALUES ('505', '5', 'F20', '24', 'Combobox', '5', '', null, '', '', '2014-06-23 15:10:02', '2014-06-23 15:10:02');
INSERT INTO `questions_detail` VALUES ('506', '2', 'F20', '25', 'Combobox', '2', '', null, '', '', '2014-06-23 15:10:10', '2014-06-23 15:10:10');
INSERT INTO `questions_detail` VALUES ('507', '3', 'F20', '25', 'Combobox', '3', '', null, '', '', '2014-06-23 15:10:10', '2014-06-23 15:10:10');
INSERT INTO `questions_detail` VALUES ('508', '1', 'F20', '25', 'Combobox', '1', '', null, '', '', '2014-06-23 15:10:10', '2014-06-23 15:10:10');
INSERT INTO `questions_detail` VALUES ('509', '4', 'F20', '25', 'Combobox', '4', '', null, '', '', '2014-06-23 15:10:11', '2014-06-23 15:10:11');
INSERT INTO `questions_detail` VALUES ('510', '5', 'F20', '25', 'Combobox', '5', '', null, '', '', '2014-06-23 15:10:11', '2014-06-23 15:10:11');
INSERT INTO `questions_detail` VALUES ('511', '3', 'F20', '27', 'Combobox', '3', '', null, '', '', '2014-06-23 15:10:30', '2014-06-23 15:10:30');
INSERT INTO `questions_detail` VALUES ('512', '2', 'F20', '27', 'Combobox', '2', '', null, '', '', '2014-06-23 15:10:30', '2014-06-23 15:10:30');
INSERT INTO `questions_detail` VALUES ('513', '1', 'F20', '27', 'Combobox', '1', '', null, '', '', '2014-06-23 15:10:30', '2014-06-23 15:10:30');
INSERT INTO `questions_detail` VALUES ('514', '4', 'F20', '27', 'Combobox', '4', '', null, '', '', '2014-06-23 15:10:31', '2014-06-23 15:10:31');
INSERT INTO `questions_detail` VALUES ('515', '5', 'F20', '27', 'Combobox', '5', '', null, '', '', '2014-06-23 15:10:31', '2014-06-23 15:10:31');
INSERT INTO `questions_detail` VALUES ('516', '3', 'F20', '28', 'Combobox', '3', '', null, '', '', '2014-06-23 15:10:45', '2014-06-23 15:10:45');
INSERT INTO `questions_detail` VALUES ('517', '1', 'F20', '28', 'Combobox', '1', '', null, '', '', '2014-06-23 15:10:45', '2014-06-23 15:10:45');
INSERT INTO `questions_detail` VALUES ('518', '2', 'F20', '28', 'Combobox', '2', '', null, '', '', '2014-06-23 15:10:45', '2014-06-23 15:10:45');
INSERT INTO `questions_detail` VALUES ('519', '4', 'F20', '28', 'Combobox', '4', '', null, '', '', '2014-06-23 15:10:47', '2014-06-23 15:10:47');
INSERT INTO `questions_detail` VALUES ('520', '5', 'F20', '28', 'Combobox', '5', '', null, '', '', '2014-06-23 15:10:47', '2014-06-23 15:10:47');
INSERT INTO `questions_detail` VALUES ('521', '1', 'F21', '9', 'Combobox', '1', '', null, '', '', '2014-06-23 15:11:06', '2014-06-23 15:11:06');
INSERT INTO `questions_detail` VALUES ('522', '3', 'F21', '9', 'Combobox', '3', '', null, '', '', '2014-06-23 15:11:06', '2014-06-23 15:11:06');
INSERT INTO `questions_detail` VALUES ('523', '2', 'F21', '9', 'Combobox', '2', '', null, '', '', '2014-06-23 15:11:06', '2014-06-23 15:11:06');
INSERT INTO `questions_detail` VALUES ('524', '5', 'F21', '9', 'Combobox', '5', '', null, '', '', '2014-06-23 15:11:08', '2014-06-23 15:11:08');
INSERT INTO `questions_detail` VALUES ('525', '4', 'F21', '9', 'Combobox', '4', '', null, '', '', '2014-06-23 15:11:08', '2014-06-23 15:11:08');
INSERT INTO `questions_detail` VALUES ('526', '3', 'F21', '8', 'Combobox', '3', '', null, '', '', '2014-06-23 15:11:20', '2014-06-23 15:11:20');
INSERT INTO `questions_detail` VALUES ('527', '1', 'F21', '8', 'Combobox', '1', '', null, '', '', '2014-06-23 15:11:20', '2014-06-23 15:11:20');
INSERT INTO `questions_detail` VALUES ('528', '2', 'F21', '8', 'Combobox', '2', '', null, '', '', '2014-06-23 15:11:20', '2014-06-23 15:11:20');
INSERT INTO `questions_detail` VALUES ('529', '4', 'F21', '8', 'Combobox', '4', '', null, '', '', '2014-06-23 15:11:21', '2014-06-23 15:11:21');
INSERT INTO `questions_detail` VALUES ('530', '5', 'F21', '8', 'Combobox', '5', '', null, '', '', '2014-06-23 15:11:21', '2014-06-23 15:11:21');
INSERT INTO `questions_detail` VALUES ('531', '3', 'F21', '7', 'Combobox', '3', '', null, '', '', '2014-06-23 15:11:30', '2014-06-23 15:11:30');
INSERT INTO `questions_detail` VALUES ('532', '1', 'F21', '7', 'Combobox', '1', '', null, '', '', '2014-06-23 15:11:30', '2014-06-23 15:11:30');
INSERT INTO `questions_detail` VALUES ('533', '2', 'F21', '7', 'Combobox', '2', '', null, '', '', '2014-06-23 15:11:30', '2014-06-23 15:11:30');
INSERT INTO `questions_detail` VALUES ('534', '4', 'F21', '7', 'Combobox', '4', '', null, '', '', '2014-06-23 15:11:31', '2014-06-23 15:11:31');
INSERT INTO `questions_detail` VALUES ('535', '5', 'F21', '7', 'Combobox', '5', '', null, '', '', '2014-06-23 15:11:31', '2014-06-23 15:11:31');
INSERT INTO `questions_detail` VALUES ('536', '1', 'F21', '6', 'Combobox', '1', '', null, '', '', '2014-06-23 15:11:55', '2014-06-23 15:11:55');
INSERT INTO `questions_detail` VALUES ('537', '3', 'F21', '6', 'Combobox', '3', '', null, '', '', '2014-06-23 15:11:55', '2014-06-23 15:11:55');
INSERT INTO `questions_detail` VALUES ('538', '2', 'F21', '6', 'Combobox', '2', '', null, '', '', '2014-06-23 15:11:56', '2014-06-23 15:11:56');
INSERT INTO `questions_detail` VALUES ('539', '4', 'F21', '6', 'Combobox', '4', '', null, '', '', '2014-06-23 15:11:57', '2014-06-23 15:11:57');
INSERT INTO `questions_detail` VALUES ('540', '5', 'F21', '6', 'Combobox', '5', '', null, '', '', '2014-06-23 15:11:57', '2014-06-23 15:11:57');
INSERT INTO `questions_detail` VALUES ('541', '2', 'F21', '4', 'Combobox', '2', '', null, '', '', '2014-06-23 15:12:08', '2014-06-23 15:12:08');
INSERT INTO `questions_detail` VALUES ('542', '1', 'F21', '4', 'Combobox', '1', '', null, '', '', '2014-06-23 15:12:08', '2014-06-23 15:12:08');
INSERT INTO `questions_detail` VALUES ('543', '3', 'F21', '4', 'Combobox', '3', '', null, '', '', '2014-06-23 15:12:08', '2014-06-23 15:12:08');
INSERT INTO `questions_detail` VALUES ('544', '4', 'F21', '4', 'Combobox', '4', '', null, '', '', '2014-06-23 15:12:09', '2014-06-23 15:12:09');
INSERT INTO `questions_detail` VALUES ('545', '5', 'F21', '4', 'Combobox', '5', '', null, '', '', '2014-06-23 15:12:09', '2014-06-23 15:12:09');
INSERT INTO `questions_detail` VALUES ('546', '2', 'F21', '3', 'Combobox', '2', '', null, '', '', '2014-06-23 15:12:18', '2014-06-23 15:12:18');
INSERT INTO `questions_detail` VALUES ('547', '1', 'F21', '3', 'Combobox', '1', '', null, '', '', '2014-06-23 15:12:19', '2014-06-23 15:12:19');
INSERT INTO `questions_detail` VALUES ('548', '3', 'F21', '3', 'Combobox', '3', '', null, '', '', '2014-06-23 15:12:19', '2014-06-23 15:12:19');
INSERT INTO `questions_detail` VALUES ('549', '4', 'F21', '3', 'Combobox', '4', '', null, '', '', '2014-06-23 15:12:20', '2014-06-23 15:12:20');
INSERT INTO `questions_detail` VALUES ('550', '5', 'F21', '3', 'Combobox', '5', '', null, '', '', '2014-06-23 15:12:20', '2014-06-23 15:12:20');
INSERT INTO `questions_detail` VALUES ('551', '3', 'F21', '28', 'Combobox', '3', '', null, '', '', '2014-06-23 15:12:46', '2014-06-23 15:12:46');
INSERT INTO `questions_detail` VALUES ('552', '2', 'F21', '28', 'Combobox', '2', '', null, '', '', '2014-06-23 15:12:46', '2014-06-23 15:12:46');
INSERT INTO `questions_detail` VALUES ('553', '1', 'F21', '28', 'Combobox', '1', '', null, '', '', '2014-06-23 15:12:46', '2014-06-23 15:12:46');
INSERT INTO `questions_detail` VALUES ('554', '4', 'F21', '28', 'Combobox', '4', '', null, '', '', '2014-06-23 15:12:47', '2014-06-23 15:12:47');
INSERT INTO `questions_detail` VALUES ('555', '5', 'F21', '28', 'Combobox', '5', '', null, '', '', '2014-06-23 15:12:47', '2014-06-23 15:12:47');
INSERT INTO `questions_detail` VALUES ('556', '1', 'F21', '27', 'Combobox', '1', '', null, '', '', '2014-06-23 15:12:56', '2014-06-23 15:12:56');
INSERT INTO `questions_detail` VALUES ('557', '2', 'F21', '27', 'Combobox', '2', '', null, '', '', '2014-06-23 15:12:56', '2014-06-23 15:12:56');
INSERT INTO `questions_detail` VALUES ('558', '3', 'F21', '27', 'Combobox', '3', '', null, '', '', '2014-06-23 15:12:56', '2014-06-23 15:12:56');
INSERT INTO `questions_detail` VALUES ('559', '4', 'F21', '27', 'Combobox', '4', '', null, '', '', '2014-06-23 15:12:57', '2014-06-23 15:12:57');
INSERT INTO `questions_detail` VALUES ('560', '5', 'F21', '27', 'Combobox', '5', '', null, '', '', '2014-06-23 15:12:57', '2014-06-23 15:12:57');
INSERT INTO `questions_detail` VALUES ('561', '1', 'F21', '26', 'Combobox', '1', '', null, '', '', '2014-06-23 15:13:07', '2014-06-23 15:13:07');
INSERT INTO `questions_detail` VALUES ('562', '2', 'F21', '26', 'Combobox', '2', '', null, '', '', '2014-06-23 15:13:07', '2014-06-23 15:13:07');
INSERT INTO `questions_detail` VALUES ('563', '3', 'F21', '26', 'Combobox', '3', '', null, '', '', '2014-06-23 15:13:07', '2014-06-23 15:13:07');
INSERT INTO `questions_detail` VALUES ('564', '4', 'F21', '26', 'Combobox', '4', '', null, '', '', '2014-06-23 15:13:08', '2014-06-23 15:13:08');
INSERT INTO `questions_detail` VALUES ('565', '5', 'F21', '26', 'Combobox', '5', '', null, '', '', '2014-06-23 15:13:08', '2014-06-23 15:13:08');
INSERT INTO `questions_detail` VALUES ('566', '3', 'F21', '25', 'Combobox', '3', '', null, '', '', '2014-06-23 15:13:19', '2014-06-23 15:13:19');
INSERT INTO `questions_detail` VALUES ('567', '2', 'F21', '25', 'Combobox', '2', '', null, '', '', '2014-06-23 15:13:19', '2014-06-23 15:13:19');
INSERT INTO `questions_detail` VALUES ('568', '1', 'F21', '25', 'Combobox', '1', '', null, '', '', '2014-06-23 15:13:19', '2014-06-23 15:13:19');
INSERT INTO `questions_detail` VALUES ('569', '5', 'F21', '25', 'Combobox', '5', '', null, '', '', '2014-06-23 15:13:20', '2014-06-23 15:13:20');
INSERT INTO `questions_detail` VALUES ('570', '4', 'F21', '25', 'Combobox', '4', '', null, '', '', '2014-06-23 15:13:20', '2014-06-23 15:13:20');
INSERT INTO `questions_detail` VALUES ('571', '1', 'F21', '23', 'Combobox', '1', '', null, '', '', '2014-06-23 15:13:35', '2014-06-23 15:13:35');
INSERT INTO `questions_detail` VALUES ('572', '2', 'F21', '23', 'Combobox', '2', '', null, '', '', '2014-06-23 15:13:35', '2014-06-23 15:13:35');
INSERT INTO `questions_detail` VALUES ('573', '3', 'F21', '23', 'Combobox', '3', '', null, '', '', '2014-06-23 15:13:35', '2014-06-23 15:13:35');
INSERT INTO `questions_detail` VALUES ('574', '4', 'F21', '23', 'Combobox', '4', '', null, '', '', '2014-06-23 15:13:37', '2014-06-23 15:13:37');
INSERT INTO `questions_detail` VALUES ('575', '5', 'F21', '23', 'Combobox', '5', '', null, '', '', '2014-06-23 15:13:37', '2014-06-23 15:13:37');
INSERT INTO `questions_detail` VALUES ('576', '1', 'F21', '5', 'Combobox', '1', '', null, '', '', '2014-06-23 15:14:32', '2014-06-23 15:14:32');
INSERT INTO `questions_detail` VALUES ('577', '2', 'F21', '5', 'Combobox', '2', '', null, '', '', '2014-06-23 15:14:32', '2014-06-23 15:14:32');
INSERT INTO `questions_detail` VALUES ('578', '3', 'F21', '5', 'Combobox', '3', '', null, '', '', '2014-06-23 15:14:32', '2014-06-23 15:14:32');
INSERT INTO `questions_detail` VALUES ('579', '4', 'F21', '5', 'Combobox', '4', '', null, '', '', '2014-06-23 15:14:33', '2014-06-23 15:14:33');
INSERT INTO `questions_detail` VALUES ('580', '5', 'F21', '5', 'Combobox', '5', '', null, '', '', '2014-06-23 15:14:33', '2014-06-23 15:14:33');
INSERT INTO `questions_detail` VALUES ('581', '3', 'F20', '7', 'Combobox', '3', '', null, '', '', '2014-06-23 15:15:18', '2014-06-23 15:15:18');
INSERT INTO `questions_detail` VALUES ('582', '2', 'F20', '7', 'Combobox', '2', '', null, '', '', '2014-06-23 15:15:18', '2014-06-23 15:15:18');
INSERT INTO `questions_detail` VALUES ('583', '1', 'F20', '7', 'Combobox', '1', '', null, '', '', '2014-06-23 15:15:18', '2014-06-23 15:15:18');
INSERT INTO `questions_detail` VALUES ('584', '4', 'F20', '7', 'Combobox', '4', '', null, '', '', '2014-06-23 15:15:19', '2014-06-23 15:15:19');
INSERT INTO `questions_detail` VALUES ('585', '5', 'F20', '7', 'Combobox', '5', '', null, '', '', '2014-06-23 15:15:19', '2014-06-23 15:15:19');
INSERT INTO `questions_detail` VALUES ('586', '1', 'F20', '13', 'Combobox', '1', '', null, '', '', '2014-06-23 15:26:42', '2014-06-23 15:26:42');
INSERT INTO `questions_detail` VALUES ('587', '2', 'F20', '13', 'Combobox', '2', '', null, '', '', '2014-06-23 15:26:42', '2014-06-23 15:26:42');
INSERT INTO `questions_detail` VALUES ('588', '3', 'F20', '13', 'Combobox', '3', '', null, '', '', '2014-06-23 15:26:42', '2014-06-23 15:26:42');
INSERT INTO `questions_detail` VALUES ('589', '4', 'F20', '13', 'Combobox', '4', '', null, '', '', '2014-06-23 15:26:44', '2014-06-23 15:26:44');
INSERT INTO `questions_detail` VALUES ('590', '5', 'F20', '13', 'Combobox', '5', '', null, '', '', '2014-06-23 15:26:44', '2014-06-23 15:26:44');
INSERT INTO `questions_detail` VALUES ('591', '1', 'A', '8', 'Textarea', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `member_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `urut` int(11) NOT NULL,
  `fak` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `jur` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `prodi` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_valid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL ,
  `updated_at` timestamp NULL ,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('0915031006', '2', '', '', '', '$2y$10$mHKiqHzKaqK7cFcXmap13e7lRsofH9WFJ706p665msMo981VXxlbG', 'rendiagungwijaya@gmail.com', 'Alumni', '', '2017-09-12 01:24:17', '2017-09-12 01:25:07');
INSERT INTO `users` VALUES ('0915031069', '1', '', '', '', '$2y$10$1UhhzNherzYE2j2idPJ.9OhmOIBWpTclZnbGZw8VSKa/./tqb3p1i', 'rendiagungwijaya@gmail.com', 'Alumni', 'ZDZr7pqL3DKLX0Z4XtWC9q3JQwR6BQCcAs1Qv0QqJAGP0JxHGrRhJVcvQBFh', '2017-09-12 00:18:22', '2017-09-12 00:57:52');
INSERT INTO `users` VALUES ('admin', '0', '', '', '', '$2y$10$3IlrSwDk14V16uhX7UXkiu/sGqbwTCreO1.cbJ2Bema6WjWPKX6RK', '', 'Administrator', 'Y15cJySZkXfNIdGDsbjYAS4tzYLjUJWZvy9x8EPaXqB0bb1MpnSkI9tSw383', '2014-06-23 16:17:51', '2017-09-12 01:20:02');
