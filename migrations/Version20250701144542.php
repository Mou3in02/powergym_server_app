<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250701144542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_acc_combopendoorid CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_acc_combopenpersonid CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_acc_deviceid CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_acc_dstimeid CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_acc_timesegid CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_adms_devcmd CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seq_pers_wiegandfmtbid CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE file_import_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seance_pers_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE seance_pers (id INT NOT NULL, first_name VARCHAR(500) NOT NULL, last_name VARCHAR(500) NOT NULL, price DOUBLE PRECISION NOT NULL, id_admin VARCHAR(50) NOT NULL, date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, lastlogin TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_deleted BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON "user" (username)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level_dept
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_option
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_auth_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_door
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_transaction
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_auxin
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_timeseg
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_reader
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE file_import
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_dstime
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_verifymode
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_firstin_lastout
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level_door
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_alarm_monitor
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_event
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seance_pers_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_acc_combopendoorid INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_acc_combopenpersonid INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_acc_deviceid INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_acc_dstimeid INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_acc_timesegid INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_adms_devcmd INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seq_pers_wiegandfmtbid INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE file_import_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level_dept (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dept_id VARCHAR(255) NOT NULL, level_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(255) DEFAULT NULL, business_id BIGINT DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, timeseg_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_option (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, option_name VARCHAR(50) NOT NULL, option_type SMALLINT NOT NULL, option_value VARCHAR(150) NOT NULL, dev_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_auth_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acc_support_fun_list VARCHAR(300) DEFAULT NULL, auth_flag BOOLEAN NOT NULL, device_name VARCHAR(255) DEFAULT NULL, device_secret VARCHAR(255) DEFAULT NULL, device_type VARCHAR(255) DEFAULT NULL, dns VARCHAR(255) DEFAULT NULL, dns_fun_on VARCHAR(255) DEFAULT NULL, ex_param TEXT DEFAULT NULL, gateway VARCHAR(50) DEFAULT NULL, ip VARCHAR(50) NOT NULL, is_support_ssl VARCHAR(255) DEFAULT NULL, mac_address VARCHAR(50) DEFAULT NULL, master_control_on VARCHAR(255) DEFAULT NULL, mode_type VARCHAR(255) DEFAULT NULL, product_id VARCHAR(255) DEFAULT NULL, product_key VARCHAR(255) DEFAULT NULL, protype VARCHAR(255) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, server_url VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, sub_control_on VARCHAR(255) DEFAULT NULL, subnet_mask VARCHAR(50) DEFAULT NULL, ver VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_door (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, action_interval SMALLINT NOT NULL, active_timeseg_id VARCHAR(255) DEFAULT NULL, allow_suaccess_lock VARCHAR(255) DEFAULT NULL, back_lock BOOLEAN NOT NULL, combopen_interval SMALLINT DEFAULT NULL, delay_open_time SMALLINT DEFAULT NULL, door_no SMALLINT NOT NULL, door_sensor_status SMALLINT NOT NULL, enabled BOOLEAN DEFAULT NULL, ext_delay_drivertime SMALLINT DEFAULT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, force_pwd VARCHAR(255) DEFAULT NULL, host_status SMALLINT DEFAULT NULL, in_apb_duration SMALLINT DEFAULT NULL, is_disable_audio BOOLEAN DEFAULT NULL, latch_door_type SMALLINT DEFAULT NULL, latch_time_out SMALLINT DEFAULT NULL, latch_timeseg_id VARCHAR(255) DEFAULT NULL, lock_delay SMALLINT NOT NULL, name VARCHAR(100) NOT NULL, passmode_timeseg_id VARCHAR(255) DEFAULT NULL, reader_type SMALLINT DEFAULT NULL, sex_input_mode VARCHAR(255) DEFAULT NULL, sex_supervised_resistor VARCHAR(255) DEFAULT NULL, sen_input_mode VARCHAR(255) DEFAULT NULL, sen_supervised_resistor VARCHAR(255) DEFAULT NULL, sensor_delay SMALLINT DEFAULT NULL, supper_pwd VARCHAR(255) DEFAULT NULL, verify_mode SMALLINT NOT NULL, wg_input_id VARCHAR(255) DEFAULT NULL, wg_input_type SMALLINT DEFAULT NULL, wg_output_id VARCHAR(255) DEFAULT NULL, wg_output_type SMALLINT DEFAULT NULL, wg_reversed SMALLINT DEFAULT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_transaction (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acc_zone VARCHAR(30) DEFAULT NULL, acc_zone_code VARCHAR(30) DEFAULT NULL, area_name VARCHAR(100) DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, dept_code VARCHAR(100) DEFAULT NULL, dept_name VARCHAR(100) DEFAULT NULL, description VARCHAR(200) DEFAULT NULL, dev_alias VARCHAR(100) DEFAULT NULL, dev_id VARCHAR(255) DEFAULT NULL, dev_sn VARCHAR(30) DEFAULT NULL, event_addr SMALLINT DEFAULT NULL, event_name VARCHAR(100) DEFAULT NULL, event_no SMALLINT NOT NULL, event_point_id VARCHAR(255) DEFAULT NULL, event_point_name VARCHAR(100) DEFAULT NULL, event_point_type SMALLINT DEFAULT NULL, event_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_name VARCHAR(50) DEFAULT NULL, log_id INT DEFAULT NULL, mask_flag VARCHAR(10) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, pin VARCHAR(30) DEFAULT NULL, reader_name VARCHAR(100) DEFAULT NULL, reader_state SMALLINT DEFAULT NULL, temperature VARCHAR(50) DEFAULT NULL, trigger_cond SMALLINT DEFAULT NULL, unique_key VARCHAR(250) DEFAULT NULL, verify_mode_name VARCHAR(100) DEFAULT NULL, verify_mode_no SMALLINT DEFAULT NULL, vid_linkage_handle VARCHAR(256) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_auxin (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, aux_no SMALLINT NOT NULL, disable BOOLEAN DEFAULT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, input_mode VARCHAR(255) DEFAULT NULL, name VARCHAR(100) NOT NULL, printer_number VARCHAR(20) NOT NULL, remark VARCHAR(50) DEFAULT NULL, supervised_resistor VARCHAR(255) DEFAULT NULL, timeseg_id VARCHAR(255) DEFAULT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_timeseg (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_id BIGINT DEFAULT NULL, friday_end1 VARCHAR(20) DEFAULT NULL, friday_end2 VARCHAR(20) DEFAULT NULL, friday_end3 VARCHAR(20) DEFAULT NULL, friday_start1 VARCHAR(20) DEFAULT NULL, friday_start2 VARCHAR(20) DEFAULT NULL, friday_start3 VARCHAR(20) DEFAULT NULL, holidaytype1_end1 VARCHAR(20) DEFAULT NULL, holidaytype1_end2 VARCHAR(20) DEFAULT NULL, holidaytype1_end3 VARCHAR(20) DEFAULT NULL, holidaytype1_start1 VARCHAR(20) DEFAULT NULL, holidaytype1_start2 VARCHAR(20) DEFAULT NULL, holidaytype1_start3 VARCHAR(20) DEFAULT NULL, holidaytype2_end1 VARCHAR(20) DEFAULT NULL, holidaytype2_end2 VARCHAR(20) DEFAULT NULL, holidaytype2_end3 VARCHAR(20) DEFAULT NULL, holidaytype2_start1 VARCHAR(20) DEFAULT NULL, holidaytype2_start2 VARCHAR(20) DEFAULT NULL, holidaytype2_start3 VARCHAR(20) DEFAULT NULL, holidaytype3_end1 VARCHAR(20) DEFAULT NULL, holidaytype3_end2 VARCHAR(20) DEFAULT NULL, holidaytype3_end3 VARCHAR(20) DEFAULT NULL, holidaytype3_start1 VARCHAR(20) DEFAULT NULL, holidaytype3_start2 VARCHAR(20) DEFAULT NULL, holidaytype3_start3 VARCHAR(20) DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, monday_end1 VARCHAR(20) DEFAULT NULL, monday_end2 VARCHAR(20) DEFAULT NULL, monday_end3 VARCHAR(20) DEFAULT NULL, monday_start1 VARCHAR(20) DEFAULT NULL, monday_start2 VARCHAR(20) DEFAULT NULL, monday_start3 VARCHAR(20) DEFAULT NULL, name VARCHAR(30) DEFAULT NULL, remark VARCHAR(50) DEFAULT NULL, saturday_end1 VARCHAR(20) DEFAULT NULL, saturday_end2 VARCHAR(20) DEFAULT NULL, saturday_end3 VARCHAR(20) DEFAULT NULL, saturday_start1 VARCHAR(20) DEFAULT NULL, saturday_start2 VARCHAR(20) DEFAULT NULL, saturday_start3 VARCHAR(20) DEFAULT NULL, sunday_end1 VARCHAR(20) DEFAULT NULL, sunday_end2 VARCHAR(20) DEFAULT NULL, sunday_end3 VARCHAR(20) DEFAULT NULL, sunday_start1 VARCHAR(20) DEFAULT NULL, sunday_start2 VARCHAR(20) DEFAULT NULL, sunday_start3 VARCHAR(20) DEFAULT NULL, thursday_end1 VARCHAR(20) DEFAULT NULL, thursday_end2 VARCHAR(20) DEFAULT NULL, thursday_end3 VARCHAR(20) DEFAULT NULL, thursday_start1 VARCHAR(20) DEFAULT NULL, thursday_start2 VARCHAR(20) DEFAULT NULL, thursday_start3 VARCHAR(20) DEFAULT NULL, tuesday_end1 VARCHAR(20) DEFAULT NULL, tuesday_end2 VARCHAR(20) DEFAULT NULL, tuesday_end3 VARCHAR(20) DEFAULT NULL, tuesday_start1 VARCHAR(20) DEFAULT NULL, tuesday_start2 VARCHAR(20) DEFAULT NULL, tuesday_start3 VARCHAR(20) DEFAULT NULL, wednesday_end1 VARCHAR(20) DEFAULT NULL, wednesday_end2 VARCHAR(20) DEFAULT NULL, wednesday_end3 VARCHAR(20) DEFAULT NULL, wednesday_start1 VARCHAR(20) DEFAULT NULL, wednesday_start2 VARCHAR(20) DEFAULT NULL, wednesday_start3 VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_reader (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, comm_address SMALLINT DEFAULT NULL, comm_type SMALLINT DEFAULT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, ip VARCHAR(20) DEFAULT NULL, mac VARCHAR(30) DEFAULT NULL, multicast VARCHAR(30) DEFAULT NULL, name VARCHAR(100) NOT NULL, offline_refuse SMALLINT DEFAULT NULL, port SMALLINT DEFAULT NULL, reader_encrypt BOOLEAN DEFAULT NULL, reader_no SMALLINT NOT NULL, reader_state SMALLINT NOT NULL, rs485_protocol_type SMALLINT DEFAULT NULL, serial_port SMALLINT DEFAULT NULL, user_lock_fun SMALLINT DEFAULT NULL, wg_inputfmt_id VARCHAR(255) DEFAULT NULL, wg_reversed SMALLINT DEFAULT NULL, door_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acpanel_type SMALLINT NOT NULL, dev_alias VARCHAR(100) NOT NULL, auth_area_id VARCHAR(255) DEFAULT NULL, baudrate INT DEFAULT NULL, business_id BIGINT DEFAULT NULL, com_address SMALLINT DEFAULT NULL, com_port SMALLINT DEFAULT NULL, comm_pwd VARCHAR(255) DEFAULT NULL, comm_type SMALLINT NOT NULL, device_name VARCHAR(30) DEFAULT NULL, enabled BOOLEAN NOT NULL, four_to_two BOOLEAN DEFAULT NULL, fw_version VARCHAR(50) DEFAULT NULL, gateway VARCHAR(15) DEFAULT NULL, icon_type SMALLINT DEFAULT NULL, ip_address VARCHAR(15) DEFAULT NULL, ip_port INT DEFAULT NULL, is_registrationdevice BOOLEAN NOT NULL, mac_address VARCHAR(30) DEFAULT NULL, machine_type SMALLINT NOT NULL, sn VARCHAR(30) NOT NULL, subnet_mask VARCHAR(15) DEFAULT NULL, time_zone VARCHAR(10) DEFAULT NULL, wg_reader_id VARCHAR(255) DEFAULT NULL, dstime_id VARCHAR(50) DEFAULT NULL, parent_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE file_import (id SERIAL NOT NULL, original_name VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, size_description VARCHAR(50) DEFAULT NULL, imported_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_deleted BOOLEAN DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_dstime (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, bussiness_id BIGINT DEFAULT NULL, dstime_mode SMALLINT NOT NULL, end_time VARCHAR(20) NOT NULL, end_year VARCHAR(20) DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, name VARCHAR(100) NOT NULL, start_time VARCHAR(20) NOT NULL, start_year VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, delay_passage BOOLEAN NOT NULL, disabled BOOLEAN NOT NULL, end_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_set_valid_time BOOLEAN NOT NULL, pers_person_id VARCHAR(255) NOT NULL, privilege SMALLINT DEFAULT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, super_auth SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_verifymode (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, name VARCHAR(100) NOT NULL, verify_no SMALLINT NOT NULL, dev_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, pers_person_id VARCHAR(255) DEFAULT NULL, level_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_firstin_lastout (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dept_code VARCHAR(100) DEFAULT NULL, dept_name VARCHAR(100) DEFAULT NULL, first_in_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, last_out_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, pin VARCHAR(30) DEFAULT NULL, reader_name_in VARCHAR(100) DEFAULT NULL, reader_name_out VARCHAR(100) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level_door (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, door_id VARCHAR(50) NOT NULL, level_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_alarm_monitor (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dev_alias VARCHAR(255) DEFAULT NULL, event_name VARCHAR(255) DEFAULT NULL, event_no SMALLINT DEFAULT NULL, event_point_name VARCHAR(255) DEFAULT NULL, event_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, pin VARCHAR(255) DEFAULT NULL, reader_name VARCHAR(255) DEFAULT NULL, status SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_event (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, base_media_file_id VARCHAR(255) DEFAULT NULL, event_level SMALLINT NOT NULL, event_no SMALLINT NOT NULL, event_priority SMALLINT DEFAULT NULL, name VARCHAR(100) NOT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE seance_pers
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
