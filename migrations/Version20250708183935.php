<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250708183935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP SEQUENCE seance_pers_id_seq CASCADE
        SQL);
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
            DROP SEQUENCE sessionpers_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE session_pers (id INT NOT NULL, id_client VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, price INT NOT NULL, date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
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
            DROP TABLE acc_timeseg_bid
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_appmenus_children
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_oplog
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_auxout
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_user_area
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_pos_allow_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_point
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_device_op_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_out
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_firstin_lastout
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_print_param
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_sign_address
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_map
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_dictionary
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_appmenus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_person_verifymoderule
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_personsch_shift
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_department
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_role_permission
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_area
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_sign
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_sysparam
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_transaction
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_autoexport
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_pos_buy_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_person_firstopen
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_person_lastaddr
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_language
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_combopen_comb
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_linkage_trigger
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_tempsch_timeslot
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_register
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_area_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_overtime
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_bid
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_event
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_trip
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_door
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_shift_timeslot
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_company
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_alarm_monitor
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_interlock
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_personsch
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_pos_full_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_device_option
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_biotemplate
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_dbbackup
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level_door
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_adjust
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_acc_device_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_linkage_vid
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_cmd_id
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_timeslot
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_verifymode
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device_option
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_app
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_print_template
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_security_param
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_devcmd
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_user_dept
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_product
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_person_combopenperson
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_ext_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_dstime_bid
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_holiday
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_antipassback
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_lang_res
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_map_pos
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_groupsch_shift
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_media_file
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_dictionary_value
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_linkage
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_topdoor_by_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_deptsch_shift
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_linkage_inout
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_verifymode_rule
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_api_token
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_linkage_index
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_reader_option
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_cyclesch_shift
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_cyclesch
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_custom_rule
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_firstopen
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_linkage_media
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_sign_address_area
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_auxin
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_deptsch
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_leave
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_auth_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_shift
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_permission
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_combopen_door
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_timeslot_breaktime
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_day_card_detail
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_timeseg
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_holiday
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_dstime
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_class
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_custom_rule_org
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_role
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_record
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_group_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_timing
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_device_option
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_combopen_person
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_tempsch
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_group
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_mail
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_door_verifymoderule
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE sessionpers
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_reader
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE base_message
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_groupsch
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE auth_user_role
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_transaction
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_break_time
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE att_leavetype
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE adms_att_device_log
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE data_source
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_combopendoor_bid
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_combopenperson_bid
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_device
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE acc_level_dept
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file_execution ALTER id DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file_execution ALTER is_deleted DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file_import ALTER id DROP DEFAULT
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE seance_pers_id_seq INCREMENT BY 1 MINVALUE 1 START 1
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
            CREATE SEQUENCE sessionpers_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_timeseg_bid (id BIGINT NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_appmenus_children (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, color VARCHAR(100) DEFAULT NULL, icon VARCHAR(100) DEFAULT NULL, name VARCHAR(100) NOT NULL, text VARCHAR(100) NOT NULL, app_menus_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_oplog (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, content TEXT DEFAULT NULL, cost_time INT DEFAULT NULL, op_ip VARCHAR(40) DEFAULT NULL, op_object VARCHAR(200) DEFAULT NULL, op_result SMALLINT DEFAULT NULL, op_sys VARCHAR(40) DEFAULT NULL, op_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, op_type VARCHAR(200) DEFAULT NULL, op_user_id VARCHAR(50) DEFAULT NULL, op_username VARCHAR(30) DEFAULT NULL, remark VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_auxout (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, aux_no SMALLINT NOT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, name VARCHAR(100) NOT NULL, printer_number VARCHAR(20) NOT NULL, remark VARCHAR(50) DEFAULT NULL, timeseg_id VARCHAR(255) DEFAULT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_user_area (auth_user_id VARCHAR(50) NOT NULL, auth_area_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_pos_allow_log (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, allow_money DOUBLE PRECISION DEFAULT NULL, allow_time VARCHAR(255) DEFAULT NULL, balance DOUBLE PRECISION DEFAULT NULL, base_batch VARCHAR(255) DEFAULT NULL, batch VARCHAR(255) DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, card_rec_id VARCHAR(255) DEFAULT NULL, rec_no VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, sys_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_point (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, area_id VARCHAR(50) DEFAULT NULL, device_id VARCHAR(50) DEFAULT NULL, device_module VARCHAR(10) DEFAULT NULL, device_sn VARCHAR(50) DEFAULT NULL, door_no SMALLINT DEFAULT NULL, ip_address VARCHAR(50) DEFAULT NULL, point_name VARCHAR(50) DEFAULT NULL, status SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_device_op_log (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(50) DEFAULT NULL, dev_sn VARCHAR(50) DEFAULT NULL, op_content VARCHAR(100) DEFAULT NULL, op_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, op_type VARCHAR(50) DEFAULT NULL, op_value1 VARCHAR(50) DEFAULT NULL, op_value2 VARCHAR(50) DEFAULT NULL, op_value3 VARCHAR(50) DEFAULT NULL, op_value_content1 VARCHAR(100) DEFAULT NULL, op_value_content2 VARCHAR(100) DEFAULT NULL, op_value_content3 VARCHAR(100) DEFAULT NULL, op_who_content VARCHAR(100) DEFAULT NULL, op_who_value VARCHAR(50) DEFAULT NULL, operator_pin VARCHAR(50) DEFAULT NULL, operator_name VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_out (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, out_long INT DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_firstin_lastout (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dept_code VARCHAR(100) DEFAULT NULL, dept_name VARCHAR(100) DEFAULT NULL, first_in_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, last_out_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, pin VARCHAR(30) DEFAULT NULL, reader_name_in VARCHAR(100) DEFAULT NULL, reader_name_out VARCHAR(100) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_print_param (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, align VARCHAR(50) DEFAULT NULL, cell VARCHAR(100) DEFAULT NULL, color VARCHAR(50) DEFAULT NULL, direction VARCHAR(50) DEFAULT NULL, font_family VARCHAR(50) DEFAULT NULL, font_size VARCHAR(50) DEFAULT NULL, height VARCHAR(50) DEFAULT NULL, left_point VARCHAR(50) DEFAULT NULL, print_type VARCHAR(50) DEFAULT NULL, print_value VARCHAR(100) DEFAULT NULL, style VARCHAR(50) DEFAULT NULL, top_point VARCHAR(50) DEFAULT NULL, width VARCHAR(50) DEFAULT NULL, template_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_sign_address (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, valid_range INT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_map (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(255) DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, map_path VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, width DOUBLE PRECISION DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_dictionary (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, is_allow_modify BOOLEAN DEFAULT NULL, code VARCHAR(60) NOT NULL, module_name VARCHAR(50) DEFAULT NULL, name VARCHAR(60) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_appmenus (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, code VARCHAR(30) NOT NULL, name VARCHAR(100) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_person_verifymoderule (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, pers_person_id VARCHAR(255) DEFAULT NULL, acc_verifymoderule_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_personsch_shift (shift_id VARCHAR(50) NOT NULL, personsch_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_department (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, code VARCHAR(30) NOT NULL, init_code VARCHAR(30) DEFAULT NULL, name VARCHAR(100) NOT NULL, sort INT DEFAULT NULL, parent_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_role_permission (auth_role_id VARCHAR(50) NOT NULL, auth_permission_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_area (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, code VARCHAR(30) NOT NULL, init_flag BOOLEAN DEFAULT NULL, name VARCHAR(100) NOT NULL, remark VARCHAR(50) DEFAULT NULL, parent_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_sign (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, after_sign_record VARCHAR(255) DEFAULT NULL, before_sign_record VARCHAR(255) DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(30) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, sign_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_sysparam (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, param_name VARCHAR(50) DEFAULT NULL, param_value VARCHAR(300) DEFAULT NULL, is_visible BOOLEAN DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_transaction (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(50) DEFAULT NULL, auth_area_name VARCHAR(100) DEFAULT NULL, auth_area_no VARCHAR(50) DEFAULT NULL, att_date VARCHAR(30) DEFAULT NULL, att_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, att_photo_url VARCHAR(255) DEFAULT NULL, att_place VARCHAR(250) DEFAULT NULL, att_state VARCHAR(20) DEFAULT NULL, att_time VARCHAR(30) DEFAULT NULL, att_verify VARCHAR(10) DEFAULT NULL, auth_dept_code VARCHAR(100) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, auth_dept_name VARCHAR(100) DEFAULT NULL, device_id VARCHAR(50) DEFAULT NULL, device_name VARCHAR(50) DEFAULT NULL, device_sn VARCHAR(50) DEFAULT NULL, door_no SMALLINT DEFAULT NULL, mark VARCHAR(10) DEFAULT NULL, mask_flag VARCHAR(255) DEFAULT NULL, pers_person_last_name VARCHAR(50) DEFAULT NULL, pers_person_name VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, temperature VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_autoexport (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, email_content VARCHAR(255) DEFAULT NULL, email_recipients VARCHAR(500) DEFAULT NULL, email_subject VARCHAR(255) DEFAULT NULL, email_type VARCHAR(30) DEFAULT NULL, file_content_format VARCHAR(255) DEFAULT NULL, file_date_format VARCHAR(30) DEFAULT NULL, file_field_convert VARCHAR(255) DEFAULT NULL, file_name VARCHAR(50) DEFAULT NULL, file_time_format VARCHAR(50) DEFAULT NULL, file_type VARCHAR(30) DEFAULT NULL, ftp_password VARCHAR(250) DEFAULT NULL, ftp_port INT DEFAULT NULL, ftp_url VARCHAR(30) DEFAULT NULL, ftp_username VARCHAR(30) DEFAULT NULL, job_class VARCHAR(50) DEFAULT NULL, job_cron VARCHAR(50) DEFAULT NULL, job_name VARCHAR(50) DEFAULT NULL, job_status VARCHAR(30) DEFAULT NULL, report_type VARCHAR(30) DEFAULT NULL, send_format VARCHAR(30) DEFAULT NULL, time_send_frequency VARCHAR(30) DEFAULT NULL, time_send_interval VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_pos_buy_log (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, balance DOUBLE PRECISION DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, card_rec_id VARCHAR(255) DEFAULT NULL, meal_date VARCHAR(255) DEFAULT NULL, meal_type VARCHAR(255) DEFAULT NULL, op_id VARCHAR(255) DEFAULT NULL, pos_money DOUBLE PRECISION DEFAULT NULL, pos_time VARCHAR(255) DEFAULT NULL, rec_no VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, sys_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_person_firstopen (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, pers_person_id VARCHAR(255) DEFAULT NULL, acc_firstopen_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_person_lastaddr (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acc_zone VARCHAR(30) DEFAULT NULL, area_name VARCHAR(100) DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, dept_code VARCHAR(100) DEFAULT NULL, dept_name VARCHAR(100) DEFAULT NULL, description VARCHAR(200) DEFAULT NULL, dev_alias VARCHAR(100) DEFAULT NULL, dev_id VARCHAR(255) DEFAULT NULL, dev_sn VARCHAR(30) DEFAULT NULL, event_name VARCHAR(100) NOT NULL, event_no SMALLINT NOT NULL, event_point_id VARCHAR(255) DEFAULT NULL, event_point_name VARCHAR(100) DEFAULT NULL, event_point_type SMALLINT DEFAULT NULL, event_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, pin VARCHAR(30) DEFAULT NULL, reader_name VARCHAR(100) DEFAULT NULL, reader_state SMALLINT DEFAULT NULL, trigger_cond SMALLINT DEFAULT NULL, verify_mode_name VARCHAR(100) DEFAULT NULL, verify_mode_no SMALLINT DEFAULT NULL, vid_linkage_handle VARCHAR(256) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_language (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, build_in_flag BOOLEAN DEFAULT NULL, code VARCHAR(30) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(255) DEFAULT NULL, cmd_count SMALLINT DEFAULT NULL, comm_port INT DEFAULT NULL, data_down_flag VARCHAR(255) DEFAULT NULL, dev_model VARCHAR(50) DEFAULT NULL, dev_name VARCHAR(50) DEFAULT NULL, dev_sn VARCHAR(50) DEFAULT NULL, dev_status SMALLINT DEFAULT NULL, face_count INT DEFAULT NULL, face_version VARCHAR(50) DEFAULT NULL, fp_count INT DEFAULT NULL, fp_version VARCHAR(50) DEFAULT NULL, fw_version VARCHAR(50) DEFAULT NULL, ip_address VARCHAR(50) DEFAULT NULL, is_reg_device BOOLEAN DEFAULT NULL, person_count INT DEFAULT NULL, protocol VARCHAR(50) DEFAULT NULL, push_commkey VARCHAR(50) DEFAULT NULL, real_time BOOLEAN DEFAULT NULL, record_count INT DEFAULT NULL, search_interval SMALLINT DEFAULT NULL, status BOOLEAN DEFAULT NULL, time_zone VARCHAR(50) DEFAULT NULL, trans_interval SMALLINT DEFAULT NULL, trans_times VARCHAR(255) DEFAULT NULL, update_flag VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_combopen_comb (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, opener_number SMALLINT NOT NULL, sort SMALLINT NOT NULL, combopen_door_id VARCHAR(50) NOT NULL, combopen_person_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_linkage_trigger (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, linkage_index INT NOT NULL, trigger_cond SMALLINT NOT NULL, linkage_id VARCHAR(50) NOT NULL, linkage_inout_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_user (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, is_active BOOLEAN DEFAULT NULL, is_staff BOOLEAN DEFAULT NULL, is_superuser BOOLEAN DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, login_pwd VARCHAR(128) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, phone VARCHAR(100) DEFAULT NULL, pwd_create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, pwd_init_flag VARCHAR(10) DEFAULT NULL, salt VARCHAR(50) DEFAULT NULL, user_login_limit INT DEFAULT NULL, user_type VARCHAR(2) DEFAULT NULL, username VARCHAR(30) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_tempsch_timeslot (tempsch_id VARCHAR(50) NOT NULL, timeslot_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_register (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, authorization_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, authorized_validtime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, client_name VARCHAR(100) DEFAULT NULL, client_type VARCHAR(2) DEFAULT NULL, is_activation SMALLINT DEFAULT NULL, registration_code VARCHAR(50) NOT NULL, registration_key VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_area_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(50) DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_overtime (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, overtime_long INT DEFAULT NULL, overtime_sign SMALLINT DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_bid (id BIGINT NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_event (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, base_media_file_id VARCHAR(255) DEFAULT NULL, event_level SMALLINT NOT NULL, event_no SMALLINT NOT NULL, event_priority SMALLINT DEFAULT NULL, name VARCHAR(100) NOT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_trip (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, trip_long INT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_door (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, action_interval SMALLINT NOT NULL, active_timeseg_id VARCHAR(255) DEFAULT NULL, allow_suaccess_lock VARCHAR(255) DEFAULT NULL, back_lock BOOLEAN NOT NULL, combopen_interval SMALLINT DEFAULT NULL, delay_open_time SMALLINT DEFAULT NULL, door_no SMALLINT NOT NULL, door_sensor_status SMALLINT NOT NULL, enabled BOOLEAN DEFAULT NULL, ext_delay_drivertime SMALLINT DEFAULT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, force_pwd VARCHAR(255) DEFAULT NULL, host_status SMALLINT DEFAULT NULL, in_apb_duration SMALLINT DEFAULT NULL, is_disable_audio BOOLEAN DEFAULT NULL, latch_door_type SMALLINT DEFAULT NULL, latch_time_out SMALLINT DEFAULT NULL, latch_timeseg_id VARCHAR(255) DEFAULT NULL, lock_delay SMALLINT NOT NULL, name VARCHAR(100) NOT NULL, passmode_timeseg_id VARCHAR(255) DEFAULT NULL, reader_type SMALLINT DEFAULT NULL, sex_input_mode VARCHAR(255) DEFAULT NULL, sex_supervised_resistor VARCHAR(255) DEFAULT NULL, sen_input_mode VARCHAR(255) DEFAULT NULL, sen_supervised_resistor VARCHAR(255) DEFAULT NULL, sensor_delay SMALLINT DEFAULT NULL, supper_pwd VARCHAR(255) DEFAULT NULL, verify_mode SMALLINT NOT NULL, wg_input_id VARCHAR(255) DEFAULT NULL, wg_input_type SMALLINT DEFAULT NULL, wg_output_id VARCHAR(255) DEFAULT NULL, wg_output_type SMALLINT DEFAULT NULL, wg_reversed SMALLINT DEFAULT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_shift_timeslot (timeslot_id VARCHAR(50) NOT NULL, shift_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_company (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, admin_name VARCHAR(50) DEFAULT NULL, admin_pwd VARCHAR(50) DEFAULT NULL, att_distance INT DEFAULT NULL, company_address VARCHAR(255) DEFAULT NULL, company_name VARCHAR(200) DEFAULT NULL, contact_name VARCHAR(50) DEFAULT NULL, email VARCHAR(200) DEFAULT NULL, latitude VARCHAR(50) DEFAULT NULL, longitude VARCHAR(50) DEFAULT NULL, status VARCHAR(2) DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_alarm_monitor (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dev_alias VARCHAR(255) DEFAULT NULL, event_name VARCHAR(255) DEFAULT NULL, event_no SMALLINT DEFAULT NULL, event_point_name VARCHAR(255) DEFAULT NULL, event_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, pin VARCHAR(255) DEFAULT NULL, reader_name VARCHAR(255) DEFAULT NULL, status SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_interlock (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, interlock_rule SMALLINT NOT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_personsch (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, schedule_id VARCHAR(50) DEFAULT NULL, schedule_type SMALLINT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_pos_full_log (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, balance DOUBLE PRECISION DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, log_type VARCHAR(255) DEFAULT NULL, op_id VARCHAR(255) DEFAULT NULL, rec_no VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, sup_money DOUBLE PRECISION DEFAULT NULL, sup_time VARCHAR(255) DEFAULT NULL, sys_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_device_option (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, option_name VARCHAR(50) DEFAULT NULL, option_value VARCHAR(150) DEFAULT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_biotemplate (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, bio_type SMALLINT NOT NULL, template VARCHAR(3000) NOT NULL, template_no SMALLINT NOT NULL, version VARCHAR(20) NOT NULL, user_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_dbbackup (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, backup_path VARCHAR(200) DEFAULT NULL, backup_result SMALLINT DEFAULT NULL, db_version VARCHAR(20) DEFAULT NULL, is_imme BOOLEAN DEFAULT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level_door (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, door_id VARCHAR(50) NOT NULL, level_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_adjust (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, adjust_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, adjust_type SMALLINT DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(30) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, shift_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_acc_device_log (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, event_addr VARCHAR(255) DEFAULT NULL, event_desc VARCHAR(255) DEFAULT NULL, event_no VARCHAR(255) DEFAULT NULL, event_time VARCHAR(255) DEFAULT NULL, inout_status VARCHAR(255) DEFAULT NULL, log_index VARCHAR(255) DEFAULT NULL, open_mode VARCHAR(255) DEFAULT NULL, pin VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, verify_type VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_linkage_vid (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, action_time INT NOT NULL, action_type SMALLINT NOT NULL, linkage_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_cmd_id (id BIGINT NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_timeslot (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, advance_work_minutes INT DEFAULT NULL, after_off_work_minutes INT DEFAULT NULL, after_to_work_minutes INT DEFAULT NULL, after_work_overtime_minutes INT DEFAULT NULL, allow_early_minutes SMALLINT DEFAULT NULL, allow_late_minutes SMALLINT DEFAULT NULL, before_off_work_minutes INT DEFAULT NULL, before_to_work_minutes INT DEFAULT NULL, before_work_overtime_minutes INT DEFAULT NULL, delayed_work_minutes INT DEFAULT NULL, elastic_cal VARCHAR(4) DEFAULT NULL, enable_flexible_work VARCHAR(10) DEFAULT NULL, enable_working_hours VARCHAR(255) DEFAULT NULL, end_segment_time VARCHAR(20) DEFAULT NULL, end_sign_in_time VARCHAR(20) DEFAULT NULL, end_sign_off_time VARCHAR(20) DEFAULT NULL, inter_segment_deduction SMALLINT DEFAULT NULL, is_advance_count_overtime BOOLEAN DEFAULT NULL, is_count_overtime BOOLEAN DEFAULT NULL, is_delay_count_overtime BOOLEAN DEFAULT NULL, is_must_sign_in BOOLEAN DEFAULT NULL, is_must_sign_off BOOLEAN DEFAULT NULL, is_postpone_count_overtime BOOLEAN DEFAULT NULL, is_segment_deduction BOOLEAN DEFAULT NULL, mark_working_days VARCHAR(20) DEFAULT NULL, max_after_overtime_minutes INT DEFAULT NULL, max_before_overtime_minutes INT DEFAULT NULL, min_after_overtime_minutes INT DEFAULT NULL, min_before_overtime_minutes INT DEFAULT NULL, off_work_time VARCHAR(20) DEFAULT NULL, period_name VARCHAR(50) DEFAULT NULL, period_no VARCHAR(50) DEFAULT NULL, period_type SMALLINT DEFAULT NULL, sign_in_advance_time VARCHAR(20) DEFAULT NULL, sign_out_pospone_time VARCHAR(20) DEFAULT NULL, start_overtime VARCHAR(20) DEFAULT NULL, start_segment_time VARCHAR(20) DEFAULT NULL, start_sign_in_time VARCHAR(20) DEFAULT NULL, start_sign_off_time VARCHAR(20) DEFAULT NULL, to_work_time VARCHAR(20) DEFAULT NULL, working_hours SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_verifymode (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, name VARCHAR(100) NOT NULL, verify_no SMALLINT NOT NULL, dev_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device_option (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, option_name VARCHAR(50) NOT NULL, option_type SMALLINT NOT NULL, option_value VARCHAR(150) NOT NULL, dev_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_app (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, app_key VARCHAR(100) DEFAULT NULL, app_secret VARCHAR(500) DEFAULT NULL, application_id VARCHAR(100) DEFAULT NULL, license_id VARCHAR(200) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, remark VARCHAR(100) DEFAULT NULL, status INT DEFAULT NULL, token VARCHAR(200) DEFAULT NULL, auth_app_type VARCHAR(200) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_print_template (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, code VARCHAR(50) DEFAULT NULL, height INT DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, module_code VARCHAR(50) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, orientation SMALLINT DEFAULT NULL, width INT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_security_param (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, date_value TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_devcmd (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, app_name VARCHAR(10) DEFAULT NULL, cmd_id BIGINT DEFAULT NULL, comm_type SMALLINT DEFAULT NULL, commit_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, content TEXT NOT NULL, is_imme BOOLEAN DEFAULT NULL, remark TEXT DEFAULT NULL, return_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, return_value INT DEFAULT NULL, sn VARCHAR(50) DEFAULT NULL, sync BOOLEAN DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, auth_area_id VARCHAR(255) DEFAULT NULL, business_id BIGINT DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, timeseg_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, annual_leave_days INT DEFAULT NULL, annual_valid_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, auth_dept_code VARCHAR(100) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, auth_dept_name VARCHAR(100) DEFAULT NULL, group_id VARCHAR(50) DEFAULT NULL, hire_date DATE DEFAULT NULL, is_attendance BOOLEAN DEFAULT NULL, per_dev_auth SMALLINT DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_lastname VARCHAR(50) DEFAULT NULL, pers_person_name VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(30) DEFAULT NULL, verify_mode SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_user_dept (auth_user_id VARCHAR(50) NOT NULL, auth_dept_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_product (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, name VARCHAR(50) NOT NULL, product_key VARCHAR(50) NOT NULL, remark VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_person_combopenperson (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, pers_person_id VARCHAR(255) DEFAULT NULL, acc_combopenperson_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_ext_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, alias VARCHAR(100) NOT NULL, comm_address SMALLINT DEFAULT NULL, dev_id VARCHAR(255) DEFAULT NULL, dev_protocol_type SMALLINT DEFAULT NULL, ext_board_no SMALLINT DEFAULT NULL, ext_board_type SMALLINT NOT NULL, serial_port SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_dstime_bid (id BIGINT NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_holiday (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, day_number SMALLINT DEFAULT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, holiday_name VARCHAR(30) DEFAULT NULL, holiday_no VARCHAR(10) DEFAULT NULL, is_all_the_holidays BOOLEAN DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_antipassback (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, apb_rule SMALLINT NOT NULL, dev_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_lang_res (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, content TEXT DEFAULT NULL, is_unconformity BOOLEAN DEFAULT NULL, module_code VARCHAR(50) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, pro_order INT DEFAULT NULL, lang_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_map_pos (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, entity_id VARCHAR(255) NOT NULL, entity_type VARCHAR(30) NOT NULL, left_x DOUBLE PRECISION DEFAULT NULL, top_y DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, map_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, pers_person_id VARCHAR(255) DEFAULT NULL, level_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_groupsch_shift (shift_id VARCHAR(50) NOT NULL, groupsch_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_media_file (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, file_size VARCHAR(100) NOT NULL, init_flag BOOLEAN DEFAULT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(100) NOT NULL, suffix VARCHAR(15) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_dictionary_value (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, code VARCHAR(60) NOT NULL, dict_value VARCHAR(100) NOT NULL, remark VARCHAR(50) DEFAULT NULL, sort INT DEFAULT NULL, dict_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_linkage (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, name VARCHAR(100) NOT NULL, dev_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_topdoor_by_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, door_id VARCHAR(255) NOT NULL, person_id VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_deptsch_shift (shift_id VARCHAR(50) NOT NULL, deptsch_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_linkage_inout (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, action_time SMALLINT NOT NULL, action_type SMALLINT NOT NULL, input_id VARCHAR(255) NOT NULL, input_type VARCHAR(30) NOT NULL, output_id VARCHAR(255) NOT NULL, output_type VARCHAR(30) NOT NULL, linkage_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_verifymode_rule (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, friday_time1_vs_door SMALLINT DEFAULT NULL, friday_time1_vs_person SMALLINT DEFAULT NULL, friday_time2_vs_door SMALLINT DEFAULT NULL, friday_time2_vs_person SMALLINT DEFAULT NULL, friday_time3_vs_door SMALLINT DEFAULT NULL, friday_time3_vs_person SMALLINT DEFAULT NULL, holidaytype1_time1_vs_door SMALLINT DEFAULT NULL, holidaytype1_time1_vs_person SMALLINT DEFAULT NULL, holidaytype1_time2_vs_door SMALLINT DEFAULT NULL, holidaytype1_time2_vs_person SMALLINT DEFAULT NULL, holidaytype1_time3_vs_door SMALLINT DEFAULT NULL, holidaytype1_time3_vs_person SMALLINT DEFAULT NULL, holidaytype2_time1_vs_door SMALLINT DEFAULT NULL, holidaytype2_time1_vs_person SMALLINT DEFAULT NULL, holidaytype2_time2_vs_door SMALLINT DEFAULT NULL, holidaytype2_time2_vs_person SMALLINT DEFAULT NULL, holidaytype2_time3_vs_door SMALLINT DEFAULT NULL, holidaytype2_time3_vs_person SMALLINT DEFAULT NULL, holidaytype3_time1_vs_door SMALLINT DEFAULT NULL, holidaytype3_time1_vs_person SMALLINT DEFAULT NULL, holidaytype3_time2_vs_door SMALLINT DEFAULT NULL, holidaytype3_time2_vs_person SMALLINT DEFAULT NULL, holidaytype3_time3_vs_door SMALLINT DEFAULT NULL, holidaytype3_time3_vs_person SMALLINT DEFAULT NULL, monday_time1_vs_door SMALLINT DEFAULT NULL, monday_time1_vs_person SMALLINT DEFAULT NULL, monday_time2_vs_door SMALLINT DEFAULT NULL, monday_time2_vs_person SMALLINT DEFAULT NULL, monday_time3_vs_door SMALLINT DEFAULT NULL, monday_time3_vs_person SMALLINT DEFAULT NULL, name VARCHAR(30) NOT NULL, new_verify_mode SMALLINT DEFAULT NULL, saturday_time1_vs_door SMALLINT DEFAULT NULL, saturday_time1_vs_person SMALLINT DEFAULT NULL, saturday_time2_vs_door SMALLINT DEFAULT NULL, saturday_time2_vs_person SMALLINT DEFAULT NULL, saturday_time3_vs_door SMALLINT DEFAULT NULL, saturday_time3_vs_person SMALLINT DEFAULT NULL, sunday_time1_vs_door SMALLINT DEFAULT NULL, sunday_time1_vs_person SMALLINT DEFAULT NULL, sunday_time2_vs_door SMALLINT DEFAULT NULL, sunday_time2_vs_person SMALLINT DEFAULT NULL, sunday_time3_vs_door SMALLINT DEFAULT NULL, sunday_time3_vs_person SMALLINT DEFAULT NULL, thursday_time1_vs_door SMALLINT DEFAULT NULL, thursday_time1_vs_person SMALLINT DEFAULT NULL, thursday_time2_vs_door SMALLINT DEFAULT NULL, thursday_time2_vs_person SMALLINT DEFAULT NULL, thursday_time3_vs_door SMALLINT DEFAULT NULL, thursday_time3_vs_person SMALLINT DEFAULT NULL, tuesday_time1_vs_door SMALLINT DEFAULT NULL, tuesday_time1_vs_person SMALLINT DEFAULT NULL, tuesday_time2_vs_door SMALLINT DEFAULT NULL, tuesday_time2_vs_person SMALLINT DEFAULT NULL, tuesday_time3_vs_door SMALLINT DEFAULT NULL, tuesday_time3_vs_person SMALLINT DEFAULT NULL, wednesday_time1_vs_door SMALLINT DEFAULT NULL, wednesday_time1_vs_person SMALLINT DEFAULT NULL, wednesday_time2_vs_door SMALLINT DEFAULT NULL, wednesday_time2_vs_person SMALLINT DEFAULT NULL, wednesday_time3_vs_door SMALLINT DEFAULT NULL, wednesday_time3_vs_person SMALLINT DEFAULT NULL, timeseg_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_api_token (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, client_name VARCHAR(50) DEFAULT NULL, client_token VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_linkage_index (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, max_index INT NOT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_reader_option (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, option_name VARCHAR(50) NOT NULL, option_type SMALLINT NOT NULL, option_value VARCHAR(150) NOT NULL, reader_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_cyclesch_shift (shift_id VARCHAR(50) NOT NULL, cyclesch_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_cyclesch (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, cycle_type SMALLINT DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, group_id VARCHAR(50) DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, schedule_type SMALLINT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_custom_rule (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, count_overtime VARCHAR(255) DEFAULT NULL, cross_day VARCHAR(255) DEFAULT NULL, late_and_early VARCHAR(255) DEFAULT NULL, maxovertime_minutes VARCHAR(255) DEFAULT NULL, maxovertime_type VARCHAR(255) DEFAULT NULL, rule_name VARCHAR(255) DEFAULT NULL, rule_type VARCHAR(4) DEFAULT NULL, shortest_overtime_minutes VARCHAR(255) DEFAULT NULL, sign_break_time VARCHAR(255) DEFAULT NULL, sign_in VARCHAR(255) DEFAULT NULL, sign_out VARCHAR(255) DEFAULT NULL, smart_find_class VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_firstopen (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, timeseg_id VARCHAR(255) NOT NULL, door_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_linkage_media (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, media_content VARCHAR(255) NOT NULL, media_type SMALLINT NOT NULL, linkage_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_sign_address_area (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, area_id VARCHAR(255) DEFAULT NULL, sign_address_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_auxin (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, aux_no SMALLINT NOT NULL, disable BOOLEAN DEFAULT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, input_mode VARCHAR(255) DEFAULT NULL, name VARCHAR(100) NOT NULL, printer_number VARCHAR(20) NOT NULL, remark VARCHAR(50) DEFAULT NULL, supervised_resistor VARCHAR(255) DEFAULT NULL, timeseg_id VARCHAR(255) DEFAULT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_deptsch (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, attendance_mode SMALLINT DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, overtime_mode SMALLINT DEFAULT NULL, overtime_remark SMALLINT DEFAULT NULL, schedule_type SMALLINT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_leave (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, days DOUBLE PRECISION DEFAULT NULL, auth_dept_code VARCHAR(100) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, auth_dept_name VARCHAR(100) DEFAULT NULL, end_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, leave_image_path VARCHAR(1000) DEFAULT NULL, leave_long INT DEFAULT NULL, leavetype_id VARCHAR(50) DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_last_name VARCHAR(50) DEFAULT NULL, pers_person_name VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, start_datetime TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_auth_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acc_support_fun_list VARCHAR(300) DEFAULT NULL, auth_flag BOOLEAN NOT NULL, device_name VARCHAR(255) DEFAULT NULL, device_secret VARCHAR(255) DEFAULT NULL, device_type VARCHAR(255) DEFAULT NULL, dns VARCHAR(255) DEFAULT NULL, dns_fun_on VARCHAR(255) DEFAULT NULL, ex_param TEXT DEFAULT NULL, gateway VARCHAR(50) DEFAULT NULL, ip VARCHAR(50) NOT NULL, is_support_ssl VARCHAR(255) DEFAULT NULL, mac_address VARCHAR(50) DEFAULT NULL, master_control_on VARCHAR(255) DEFAULT NULL, mode_type VARCHAR(255) DEFAULT NULL, product_id VARCHAR(255) DEFAULT NULL, product_key VARCHAR(255) DEFAULT NULL, protype VARCHAR(255) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, server_url VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, sub_control_on VARCHAR(255) DEFAULT NULL, subnet_mask VARCHAR(50) DEFAULT NULL, ver VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_shift (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, attendance_mode SMALLINT DEFAULT NULL, is_shift_within_month BOOLEAN DEFAULT NULL, overtime_mode SMALLINT DEFAULT NULL, overtime_sign SMALLINT DEFAULT NULL, period_number SMALLINT DEFAULT NULL, period_start_mode VARCHAR(255) DEFAULT NULL, periodic_unit SMALLINT DEFAULT NULL, shift_color VARCHAR(255) DEFAULT NULL, shift_name VARCHAR(50) DEFAULT NULL, shift_no VARCHAR(50) DEFAULT NULL, shift_type SMALLINT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, time_slot_detail_ids TEXT DEFAULT NULL, shift_worktype VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_permission (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, action_link VARCHAR(255) DEFAULT NULL, available VARCHAR(10) DEFAULT NULL, code VARCHAR(50) DEFAULT NULL, img VARCHAR(120) DEFAULT NULL, img_hover VARCHAR(150) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, order_no INT DEFAULT NULL, permission VARCHAR(128) DEFAULT NULL, resource_type VARCHAR(255) DEFAULT NULL, auth_permission_parent_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_combopen_door (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_id BIGINT DEFAULT NULL, name VARCHAR(30) NOT NULL, door_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_timeslot_breaktime (timeslot_id VARCHAR(50) NOT NULL, breaktime_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dev_alias VARCHAR(100) NOT NULL, baudrate INT DEFAULT NULL, com_address SMALLINT DEFAULT NULL, com_port SMALLINT DEFAULT NULL, comm_pwd VARCHAR(32) DEFAULT NULL, comm_type SMALLINT NOT NULL, device_name VARCHAR(50) DEFAULT NULL, enabled BOOLEAN NOT NULL, fw_version VARCHAR(50) DEFAULT NULL, gateway VARCHAR(15) DEFAULT NULL, ip_address VARCHAR(15) DEFAULT NULL, ip_port INT DEFAULT NULL, module VARCHAR(10) DEFAULT NULL, push_version VARCHAR(255) DEFAULT NULL, sn VARCHAR(50) DEFAULT NULL, subnet_mask VARCHAR(15) DEFAULT NULL, parent_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_day_card_detail (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, att_date VARCHAR(50) DEFAULT NULL, att_times VARCHAR(255) DEFAULT NULL, card_count INT DEFAULT NULL, auth_dept_code VARCHAR(50) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, auth_dept_name VARCHAR(50) DEFAULT NULL, earliest_time VARCHAR(20) DEFAULT NULL, latest_time VARCHAR(20) DEFAULT NULL, pers_person_lastname VARCHAR(50) DEFAULT NULL, pers_person_name VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_timeseg (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_id BIGINT DEFAULT NULL, friday_end1 VARCHAR(20) DEFAULT NULL, friday_end2 VARCHAR(20) DEFAULT NULL, friday_end3 VARCHAR(20) DEFAULT NULL, friday_start1 VARCHAR(20) DEFAULT NULL, friday_start2 VARCHAR(20) DEFAULT NULL, friday_start3 VARCHAR(20) DEFAULT NULL, holidaytype1_end1 VARCHAR(20) DEFAULT NULL, holidaytype1_end2 VARCHAR(20) DEFAULT NULL, holidaytype1_end3 VARCHAR(20) DEFAULT NULL, holidaytype1_start1 VARCHAR(20) DEFAULT NULL, holidaytype1_start2 VARCHAR(20) DEFAULT NULL, holidaytype1_start3 VARCHAR(20) DEFAULT NULL, holidaytype2_end1 VARCHAR(20) DEFAULT NULL, holidaytype2_end2 VARCHAR(20) DEFAULT NULL, holidaytype2_end3 VARCHAR(20) DEFAULT NULL, holidaytype2_start1 VARCHAR(20) DEFAULT NULL, holidaytype2_start2 VARCHAR(20) DEFAULT NULL, holidaytype2_start3 VARCHAR(20) DEFAULT NULL, holidaytype3_end1 VARCHAR(20) DEFAULT NULL, holidaytype3_end2 VARCHAR(20) DEFAULT NULL, holidaytype3_end3 VARCHAR(20) DEFAULT NULL, holidaytype3_start1 VARCHAR(20) DEFAULT NULL, holidaytype3_start2 VARCHAR(20) DEFAULT NULL, holidaytype3_start3 VARCHAR(20) DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, monday_end1 VARCHAR(20) DEFAULT NULL, monday_end2 VARCHAR(20) DEFAULT NULL, monday_end3 VARCHAR(20) DEFAULT NULL, monday_start1 VARCHAR(20) DEFAULT NULL, monday_start2 VARCHAR(20) DEFAULT NULL, monday_start3 VARCHAR(20) DEFAULT NULL, name VARCHAR(30) DEFAULT NULL, remark VARCHAR(50) DEFAULT NULL, saturday_end1 VARCHAR(20) DEFAULT NULL, saturday_end2 VARCHAR(20) DEFAULT NULL, saturday_end3 VARCHAR(20) DEFAULT NULL, saturday_start1 VARCHAR(20) DEFAULT NULL, saturday_start2 VARCHAR(20) DEFAULT NULL, saturday_start3 VARCHAR(20) DEFAULT NULL, sunday_end1 VARCHAR(20) DEFAULT NULL, sunday_end2 VARCHAR(20) DEFAULT NULL, sunday_end3 VARCHAR(20) DEFAULT NULL, sunday_start1 VARCHAR(20) DEFAULT NULL, sunday_start2 VARCHAR(20) DEFAULT NULL, sunday_start3 VARCHAR(20) DEFAULT NULL, thursday_end1 VARCHAR(20) DEFAULT NULL, thursday_end2 VARCHAR(20) DEFAULT NULL, thursday_end3 VARCHAR(20) DEFAULT NULL, thursday_start1 VARCHAR(20) DEFAULT NULL, thursday_start2 VARCHAR(20) DEFAULT NULL, thursday_start3 VARCHAR(20) DEFAULT NULL, tuesday_end1 VARCHAR(20) DEFAULT NULL, tuesday_end2 VARCHAR(20) DEFAULT NULL, tuesday_end3 VARCHAR(20) DEFAULT NULL, tuesday_start1 VARCHAR(20) DEFAULT NULL, tuesday_start2 VARCHAR(20) DEFAULT NULL, tuesday_start3 VARCHAR(20) DEFAULT NULL, wednesday_end1 VARCHAR(20) DEFAULT NULL, wednesday_end2 VARCHAR(20) DEFAULT NULL, wednesday_end3 VARCHAR(20) DEFAULT NULL, wednesday_start1 VARCHAR(20) DEFAULT NULL, wednesday_start2 VARCHAR(20) DEFAULT NULL, wednesday_start3 VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_holiday (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, end_date DATE NOT NULL, holiday_type SMALLINT NOT NULL, is_loop_by_year BOOLEAN NOT NULL, name VARCHAR(30) NOT NULL, remark VARCHAR(50) DEFAULT NULL, start_date DATE NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, delay_passage BOOLEAN NOT NULL, disabled BOOLEAN NOT NULL, end_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_set_valid_time BOOLEAN NOT NULL, pers_person_id VARCHAR(255) NOT NULL, privilege SMALLINT DEFAULT NULL, start_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, super_auth SMALLINT DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_dstime (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, bussiness_id BIGINT DEFAULT NULL, dstime_mode SMALLINT NOT NULL, end_time VARCHAR(20) NOT NULL, end_year VARCHAR(20) DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, name VARCHAR(100) NOT NULL, start_time VARCHAR(20) NOT NULL, start_year VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_class (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, adjust_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, auth_adjustdept_id VARCHAR(50) DEFAULT NULL, pers_adjustperson_id VARCHAR(50) DEFAULT NULL, pers_adjustperson_pin VARCHAR(50) DEFAULT NULL, adjust_type SMALLINT DEFAULT NULL, business_key VARCHAR(50) DEFAULT NULL, flow_status VARCHAR(255) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, swap_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, auth_swapdept_id VARCHAR(50) DEFAULT NULL, pers_swapperson_id VARCHAR(50) DEFAULT NULL, pers_swapperson_pin VARCHAR(50) DEFAULT NULL, swapshift_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_custom_rule_org (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, org_id VARCHAR(255) DEFAULT NULL, rule_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_role (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, code VARCHAR(200) NOT NULL, name VARCHAR(30) NOT NULL, remark VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_record (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, absent_days NUMERIC(19, 2) DEFAULT NULL, absent_minute INT DEFAULT NULL, actual_days NUMERIC(19, 2) DEFAULT NULL, actual_minute INT DEFAULT NULL, att_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, attendance_status VARCHAR(255) DEFAULT NULL, card_status VARCHAR(255) DEFAULT NULL, card_valid_count INT DEFAULT NULL, card_valid_data VARCHAR(255) DEFAULT NULL, cross_day VARCHAR(255) DEFAULT NULL, auth_dept_code VARCHAR(100) DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, auth_dept_name VARCHAR(100) DEFAULT NULL, early_count_data VARCHAR(255) DEFAULT NULL, early_count_total INT DEFAULT NULL, early_minute_data VARCHAR(255) DEFAULT NULL, early_minute_total INT DEFAULT NULL, exception_sch_type INT DEFAULT NULL, late_count_data VARCHAR(255) DEFAULT NULL, late_count_total INT DEFAULT NULL, late_minute_data VARCHAR(255) DEFAULT NULL, late_minute_total INT DEFAULT NULL, leave_days NUMERIC(19, 2) DEFAULT NULL, leave_details VARCHAR(255) DEFAULT NULL, leave_minute INT DEFAULT NULL, out_days NUMERIC(19, 2) DEFAULT NULL, out_minute INT DEFAULT NULL, overtime_holiday_minute INT DEFAULT NULL, overtime_minute INT DEFAULT NULL, overtime_rest_minute INT DEFAULT NULL, overtime_usual_minute INT DEFAULT NULL, pers_person_last_name VARCHAR(50) DEFAULT NULL, pers_person_name VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL, shift_name VARCHAR(255) DEFAULT NULL, shift_no VARCHAR(255) DEFAULT NULL, shift_time_data VARCHAR(255) DEFAULT NULL, should_days NUMERIC(19, 2) DEFAULT NULL, should_minute INT DEFAULT NULL, timeslot_name VARCHAR(255) DEFAULT NULL, trip_days NUMERIC(19, 2) DEFAULT NULL, trip_minute INT DEFAULT NULL, valid_days NUMERIC(19, 2) DEFAULT NULL, valid_minute INT DEFAULT NULL, week VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_group_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, group_id VARCHAR(255) DEFAULT NULL, pers_person_id VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_timing (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, job_class VARCHAR(50) DEFAULT NULL, job_cron VARCHAR(50) DEFAULT NULL, job_name VARCHAR(50) DEFAULT NULL, job_status BOOLEAN DEFAULT NULL, time_calc_frequency VARCHAR(1) DEFAULT NULL, time_calc_interval VARCHAR(100) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_device_option (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, option_name VARCHAR(50) NOT NULL, option_type SMALLINT DEFAULT NULL, option_value VARCHAR(200) NOT NULL, dev_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_combopen_person (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_id BIGINT DEFAULT NULL, name VARCHAR(30) NOT NULL, remark VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_tempsch (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, attendance_mode SMALLINT DEFAULT NULL, auth_dept_id VARCHAR(50) DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, group_id VARCHAR(50) DEFAULT NULL, overtime_mode SMALLINT DEFAULT NULL, overtime_remark SMALLINT DEFAULT NULL, pers_person_id VARCHAR(50) DEFAULT NULL, pers_person_pin VARCHAR(50) DEFAULT NULL, schedule_type SMALLINT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, temp_type SMALLINT DEFAULT NULL, shift_worktype VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_group (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, group_name VARCHAR(30) DEFAULT NULL, group_no VARCHAR(5) DEFAULT NULL, remark VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_mail (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, attachments VARCHAR(600) DEFAULT NULL, commit_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, content VARCHAR(600) NOT NULL, receiver VARCHAR(600) NOT NULL, ret SMALLINT DEFAULT NULL, ret_message VARCHAR(200) DEFAULT NULL, send_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, sender VARCHAR(100) DEFAULT NULL, subject VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_door_verifymoderule (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acc_door_id VARCHAR(50) NOT NULL, acc_verifymoderule_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE sessionpers (id SERIAL NOT NULL, first_name VARCHAR(500) NOT NULL, last_name VARCHAR(500) NOT NULL, price DOUBLE PRECISION NOT NULL, datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, id_client INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_reader (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, comm_address SMALLINT DEFAULT NULL, comm_type SMALLINT DEFAULT NULL, ext_dev_id VARCHAR(255) DEFAULT NULL, ip VARCHAR(20) DEFAULT NULL, mac VARCHAR(30) DEFAULT NULL, multicast VARCHAR(30) DEFAULT NULL, name VARCHAR(100) NOT NULL, offline_refuse SMALLINT DEFAULT NULL, port SMALLINT DEFAULT NULL, reader_encrypt BOOLEAN DEFAULT NULL, reader_no SMALLINT NOT NULL, reader_state SMALLINT NOT NULL, rs485_protocol_type SMALLINT DEFAULT NULL, serial_port SMALLINT DEFAULT NULL, user_lock_fun SMALLINT DEFAULT NULL, wg_inputfmt_id VARCHAR(255) DEFAULT NULL, wg_reversed SMALLINT DEFAULT NULL, door_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE base_message (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, business_code VARCHAR(255) DEFAULT NULL, business_id VARCHAR(255) DEFAULT NULL, content VARCHAR(250) DEFAULT NULL, expire_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, extend_json TEXT DEFAULT NULL, href VARCHAR(511) DEFAULT NULL, href_title VARCHAR(50) DEFAULT NULL, receiver_id VARCHAR(50) DEFAULT NULL, remind_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, remind_type VARCHAR(50) DEFAULT NULL, sort_num INT DEFAULT NULL, status VARCHAR(2) DEFAULT NULL, title VARCHAR(50) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_groupsch (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, attendance_mode SMALLINT DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, group_id VARCHAR(50) DEFAULT NULL, overtime_mode SMALLINT DEFAULT NULL, overtime_remark SMALLINT DEFAULT NULL, schedule_type SMALLINT DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE auth_user_role (auth_user_id VARCHAR(50) NOT NULL, auth_role_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_transaction (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acc_zone VARCHAR(30) DEFAULT NULL, acc_zone_code VARCHAR(30) DEFAULT NULL, area_name VARCHAR(100) DEFAULT NULL, card_no VARCHAR(255) DEFAULT NULL, dept_code VARCHAR(100) DEFAULT NULL, dept_name VARCHAR(100) DEFAULT NULL, description VARCHAR(200) DEFAULT NULL, dev_alias VARCHAR(100) DEFAULT NULL, dev_id VARCHAR(255) DEFAULT NULL, dev_sn VARCHAR(30) DEFAULT NULL, event_addr SMALLINT DEFAULT NULL, event_name VARCHAR(100) DEFAULT NULL, event_no SMALLINT NOT NULL, event_point_id VARCHAR(255) DEFAULT NULL, event_point_name VARCHAR(100) DEFAULT NULL, event_point_type SMALLINT DEFAULT NULL, event_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_name VARCHAR(50) DEFAULT NULL, log_id INT DEFAULT NULL, mask_flag VARCHAR(10) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, pin VARCHAR(30) DEFAULT NULL, reader_name VARCHAR(100) DEFAULT NULL, reader_state SMALLINT DEFAULT NULL, temperature VARCHAR(50) DEFAULT NULL, trigger_cond SMALLINT DEFAULT NULL, unique_key VARCHAR(250) DEFAULT NULL, verify_mode_name VARCHAR(100) DEFAULT NULL, verify_mode_no SMALLINT DEFAULT NULL, vid_linkage_handle VARCHAR(256) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_break_time (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, end_time VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, start_time VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE att_leavetype (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, convert_count DOUBLE PRECISION DEFAULT NULL, convert_type VARCHAR(20) DEFAULT NULL, convert_unit VARCHAR(20) DEFAULT NULL, init_flag BOOLEAN DEFAULT NULL, is_deduct_work_long BOOLEAN DEFAULT NULL, leavetype_name VARCHAR(50) DEFAULT NULL, leavetype_no VARCHAR(50) DEFAULT NULL, mark VARCHAR(20) DEFAULT NULL, symbol VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE adms_att_device_log (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, pin VARCHAR(255) DEFAULT NULL, record_status VARCHAR(5) DEFAULT NULL, record_time VARCHAR(255) DEFAULT NULL, sn VARCHAR(255) DEFAULT NULL, verify VARCHAR(5) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE data_source (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, db_name VARCHAR(255) DEFAULT NULL, ip VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, port VARCHAR(255) DEFAULT NULL, soft_version VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_combopendoor_bid (id BIGINT NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_combopenperson_bid (id BIGINT NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_device (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, acpanel_type SMALLINT NOT NULL, dev_alias VARCHAR(100) NOT NULL, auth_area_id VARCHAR(255) DEFAULT NULL, baudrate INT DEFAULT NULL, business_id BIGINT DEFAULT NULL, com_address SMALLINT DEFAULT NULL, com_port SMALLINT DEFAULT NULL, comm_pwd VARCHAR(255) DEFAULT NULL, comm_type SMALLINT NOT NULL, device_name VARCHAR(30) DEFAULT NULL, enabled BOOLEAN NOT NULL, four_to_two BOOLEAN DEFAULT NULL, fw_version VARCHAR(50) DEFAULT NULL, gateway VARCHAR(15) DEFAULT NULL, icon_type SMALLINT DEFAULT NULL, ip_address VARCHAR(15) DEFAULT NULL, ip_port INT DEFAULT NULL, is_registrationdevice BOOLEAN NOT NULL, mac_address VARCHAR(30) DEFAULT NULL, machine_type SMALLINT NOT NULL, sn VARCHAR(30) NOT NULL, subnet_mask VARCHAR(15) DEFAULT NULL, time_zone VARCHAR(10) DEFAULT NULL, wg_reader_id VARCHAR(255) DEFAULT NULL, dstime_id VARCHAR(50) DEFAULT NULL, parent_id VARCHAR(50) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE acc_level_dept (id VARCHAR(50) NOT NULL, app_id VARCHAR(255) DEFAULT NULL, bio_tbl_id VARCHAR(255) DEFAULT NULL, company_id VARCHAR(255) DEFAULT NULL, create_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creater_code VARCHAR(100) DEFAULT NULL, creater_id VARCHAR(50) DEFAULT NULL, creater_name VARCHAR(100) DEFAULT NULL, op_version INT DEFAULT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updater_code VARCHAR(100) DEFAULT NULL, updater_id VARCHAR(100) DEFAULT NULL, updater_name VARCHAR(100) DEFAULT NULL, dept_id VARCHAR(255) NOT NULL, level_id VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE session_pers
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE file_execution_id_seq
        SQL);
        $this->addSql(<<<'SQL'
            SELECT setval('file_execution_id_seq', (SELECT MAX(id) FROM file_execution))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file_execution ALTER id SET DEFAULT nextval('file_execution_id_seq')
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file_execution ALTER is_deleted SET DEFAULT false
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE file_import_id_seq
        SQL);
        $this->addSql(<<<'SQL'
            SELECT setval('file_import_id_seq', (SELECT MAX(id) FROM file_import))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE file_import ALTER id SET DEFAULT nextval('file_import_id_seq')
        SQL);
    }
}
