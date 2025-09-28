--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5
-- Dumped by pg_dump version 17.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: admin
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO admin;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: acc_alarm_monitor; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_alarm_monitor (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    dev_alias character varying(255),
    event_name character varying(255),
    event_no smallint,
    event_point_name character varying(255),
    event_time timestamp without time zone,
    name character varying(255),
    pin character varying(255),
    reader_name character varying(255),
    status smallint
);


ALTER TABLE public.acc_alarm_monitor OWNER TO admin;

--
-- Name: acc_antipassback; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_antipassback (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    apb_rule smallint NOT NULL,
    dev_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_antipassback OWNER TO admin;

--
-- Name: acc_auxin; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_auxin (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    aux_no smallint NOT NULL,
    disable boolean,
    ext_dev_id character varying(255),
    input_mode character varying(255),
    name character varying(100) NOT NULL,
    printer_number character varying(20) NOT NULL,
    remark character varying(50),
    supervised_resistor character varying(255),
    timeseg_id character varying(255),
    dev_id character varying(50)
);


ALTER TABLE public.acc_auxin OWNER TO admin;

--
-- Name: acc_auxout; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_auxout (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    aux_no smallint NOT NULL,
    ext_dev_id character varying(255),
    name character varying(100) NOT NULL,
    printer_number character varying(20) NOT NULL,
    remark character varying(50),
    timeseg_id character varying(255),
    dev_id character varying(50)
);


ALTER TABLE public.acc_auxout OWNER TO admin;

--
-- Name: acc_combopen_comb; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_combopen_comb (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    opener_number smallint NOT NULL,
    sort smallint NOT NULL,
    combopen_door_id character varying(50) NOT NULL,
    combopen_person_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_combopen_comb OWNER TO admin;

--
-- Name: acc_combopen_door; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_combopen_door (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_id bigint,
    name character varying(30) NOT NULL,
    door_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_combopen_door OWNER TO admin;

--
-- Name: acc_combopen_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_combopen_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_id bigint,
    name character varying(30) NOT NULL,
    remark character varying(50)
);


ALTER TABLE public.acc_combopen_person OWNER TO admin;

--
-- Name: acc_combopendoor_bid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_combopendoor_bid (
    id bigint NOT NULL
);


ALTER TABLE public.acc_combopendoor_bid OWNER TO admin;

--
-- Name: acc_combopenperson_bid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_combopenperson_bid (
    id bigint NOT NULL
);


ALTER TABLE public.acc_combopenperson_bid OWNER TO admin;

--
-- Name: acc_device; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_device (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    acpanel_type smallint NOT NULL,
    dev_alias character varying(100) NOT NULL,
    auth_area_id character varying(255),
    baudrate integer,
    business_id bigint,
    com_address smallint,
    com_port smallint,
    comm_pwd character varying(255),
    comm_type smallint NOT NULL,
    device_name character varying(30),
    enabled boolean NOT NULL,
    four_to_two boolean,
    fw_version character varying(50),
    gateway character varying(15),
    icon_type smallint,
    ip_address character varying(15),
    ip_port integer,
    is_registrationdevice boolean NOT NULL,
    mac_address character varying(30),
    machine_type smallint NOT NULL,
    sn character varying(30) NOT NULL,
    subnet_mask character varying(15),
    time_zone character varying(10),
    wg_reader_id character varying(255),
    dstime_id character varying(50),
    parent_id character varying(50)
);


ALTER TABLE public.acc_device OWNER TO admin;

--
-- Name: acc_device_bid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_device_bid (
    id bigint NOT NULL
);


ALTER TABLE public.acc_device_bid OWNER TO admin;

--
-- Name: acc_device_event; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_device_event (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    base_media_file_id character varying(255),
    event_level smallint NOT NULL,
    event_no smallint NOT NULL,
    event_priority smallint,
    name character varying(100) NOT NULL,
    dev_id character varying(50)
);


ALTER TABLE public.acc_device_event OWNER TO admin;

--
-- Name: acc_device_option; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_device_option (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    option_name character varying(50) NOT NULL,
    option_type smallint NOT NULL,
    option_value character varying(150) NOT NULL,
    dev_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_device_option OWNER TO admin;

--
-- Name: acc_device_verifymode; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_device_verifymode (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    name character varying(100) NOT NULL,
    verify_no smallint NOT NULL,
    dev_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_device_verifymode OWNER TO admin;

--
-- Name: acc_door; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_door (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_interval smallint NOT NULL,
    active_timeseg_id character varying(255),
    allow_suaccess_lock character varying(255),
    back_lock boolean NOT NULL,
    combopen_interval smallint,
    delay_open_time smallint,
    door_no smallint NOT NULL,
    door_sensor_status smallint NOT NULL,
    enabled boolean,
    ext_delay_drivertime smallint,
    ext_dev_id character varying(255),
    force_pwd character varying(255),
    host_status smallint,
    in_apb_duration smallint,
    is_disable_audio boolean,
    latch_door_type smallint,
    latch_time_out smallint,
    latch_timeseg_id character varying(255),
    lock_delay smallint NOT NULL,
    name character varying(100) NOT NULL,
    passmode_timeseg_id character varying(255),
    reader_type smallint,
    sex_input_mode character varying(255),
    sex_supervised_resistor character varying(255),
    sen_input_mode character varying(255),
    sen_supervised_resistor character varying(255),
    sensor_delay smallint,
    supper_pwd character varying(255),
    verify_mode smallint NOT NULL,
    wg_input_id character varying(255),
    wg_input_type smallint,
    wg_output_id character varying(255),
    wg_output_type smallint,
    wg_reversed smallint,
    dev_id character varying(50)
);


ALTER TABLE public.acc_door OWNER TO admin;

--
-- Name: acc_door_verifymoderule; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_door_verifymoderule (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    acc_door_id character varying(50) NOT NULL,
    acc_verifymoderule_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_door_verifymoderule OWNER TO admin;

--
-- Name: acc_dstime; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_dstime (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    bussiness_id bigint,
    dstime_mode smallint NOT NULL,
    end_time character varying(20) NOT NULL,
    end_year character varying(20),
    init_flag boolean,
    name character varying(100) NOT NULL,
    start_time character varying(20) NOT NULL,
    start_year character varying(20)
);


ALTER TABLE public.acc_dstime OWNER TO admin;

--
-- Name: acc_dstime_bid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_dstime_bid (
    id bigint NOT NULL
);


ALTER TABLE public.acc_dstime_bid OWNER TO admin;

--
-- Name: acc_ext_device; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_ext_device (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    alias character varying(100) NOT NULL,
    comm_address smallint,
    dev_id character varying(255),
    dev_protocol_type smallint,
    ext_board_no smallint,
    ext_board_type smallint NOT NULL,
    serial_port smallint
);


ALTER TABLE public.acc_ext_device OWNER TO admin;

--
-- Name: acc_firstin_lastout; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_firstin_lastout (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    dept_code character varying(100),
    dept_name character varying(100),
    first_in_time timestamp without time zone,
    last_name character varying(50),
    last_out_time timestamp without time zone,
    name character varying(50),
    pin character varying(30),
    reader_name_in character varying(100),
    reader_name_out character varying(100)
);


ALTER TABLE public.acc_firstin_lastout OWNER TO admin;

--
-- Name: acc_firstopen; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_firstopen (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    timeseg_id character varying(255) NOT NULL,
    door_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_firstopen OWNER TO admin;

--
-- Name: acc_holiday; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_holiday (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    end_date date NOT NULL,
    holiday_type smallint NOT NULL,
    is_loop_by_year boolean NOT NULL,
    name character varying(30) NOT NULL,
    remark character varying(50),
    start_date date NOT NULL
);


ALTER TABLE public.acc_holiday OWNER TO admin;

--
-- Name: acc_interlock; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_interlock (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    interlock_rule smallint NOT NULL,
    dev_id character varying(50)
);


ALTER TABLE public.acc_interlock OWNER TO admin;

--
-- Name: acc_level; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_level (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(255),
    business_id bigint,
    end_date timestamp without time zone,
    init_flag boolean,
    name character varying(100),
    start_date timestamp without time zone,
    timeseg_id character varying(255)
);


ALTER TABLE public.acc_level OWNER TO admin;

--
-- Name: acc_level_dept; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_level_dept (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    dept_id character varying(255) NOT NULL,
    level_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_level_dept OWNER TO admin;

--
-- Name: acc_level_door; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_level_door (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    door_id character varying(50) NOT NULL,
    level_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_level_door OWNER TO admin;

--
-- Name: acc_level_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_level_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    pers_person_id character varying(255),
    level_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_level_person OWNER TO admin;

--
-- Name: acc_linkage; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_linkage (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    name character varying(100) NOT NULL,
    dev_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_linkage OWNER TO admin;

--
-- Name: acc_linkage_index; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_linkage_index (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    max_index integer NOT NULL,
    dev_id character varying(50)
);


ALTER TABLE public.acc_linkage_index OWNER TO admin;

--
-- Name: acc_linkage_inout; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_linkage_inout (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_time smallint NOT NULL,
    action_type smallint NOT NULL,
    input_id character varying(255) NOT NULL,
    input_type character varying(30) NOT NULL,
    output_id character varying(255) NOT NULL,
    output_type character varying(30) NOT NULL,
    linkage_id character varying(50)
);


ALTER TABLE public.acc_linkage_inout OWNER TO admin;

--
-- Name: acc_linkage_media; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_linkage_media (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    media_content character varying(255) NOT NULL,
    media_type smallint NOT NULL,
    linkage_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_linkage_media OWNER TO admin;

--
-- Name: acc_linkage_trigger; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_linkage_trigger (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    linkage_index integer NOT NULL,
    trigger_cond smallint NOT NULL,
    linkage_id character varying(50) NOT NULL,
    linkage_inout_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_linkage_trigger OWNER TO admin;

--
-- Name: acc_linkage_vid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_linkage_vid (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_time integer NOT NULL,
    action_type smallint NOT NULL,
    linkage_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_linkage_vid OWNER TO admin;

--
-- Name: acc_map; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_map (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(255),
    height double precision,
    map_path character varying(255) NOT NULL,
    name character varying(50) NOT NULL,
    width double precision
);


ALTER TABLE public.acc_map OWNER TO admin;

--
-- Name: acc_map_pos; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_map_pos (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    entity_id character varying(255) NOT NULL,
    entity_type character varying(30) NOT NULL,
    left_x double precision,
    top_y double precision,
    width double precision,
    map_id character varying(50)
);


ALTER TABLE public.acc_map_pos OWNER TO admin;

--
-- Name: acc_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    delay_passage boolean NOT NULL,
    disabled boolean NOT NULL,
    end_time timestamp without time zone,
    is_set_valid_time boolean NOT NULL,
    pers_person_id character varying(255) NOT NULL,
    privilege smallint,
    start_time timestamp without time zone,
    super_auth smallint
);


ALTER TABLE public.acc_person OWNER TO admin;

--
-- Name: acc_person_combopenperson; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_person_combopenperson (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    pers_person_id character varying(255),
    acc_combopenperson_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_person_combopenperson OWNER TO admin;

--
-- Name: acc_person_firstopen; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_person_firstopen (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    pers_person_id character varying(255),
    acc_firstopen_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_person_firstopen OWNER TO admin;

--
-- Name: acc_person_lastaddr; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_person_lastaddr (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    acc_zone character varying(30),
    area_name character varying(100),
    card_no character varying(255),
    dept_code character varying(100),
    dept_name character varying(100),
    description character varying(200),
    dev_alias character varying(100),
    dev_id character varying(255),
    dev_sn character varying(30),
    event_name character varying(100) NOT NULL,
    event_no smallint NOT NULL,
    event_point_id character varying(255),
    event_point_name character varying(100),
    event_point_type smallint,
    event_time timestamp without time zone,
    last_name character varying(50),
    name character varying(50),
    pin character varying(30),
    reader_name character varying(100),
    reader_state smallint,
    trigger_cond smallint,
    verify_mode_name character varying(100),
    verify_mode_no smallint,
    vid_linkage_handle character varying(256)
);


ALTER TABLE public.acc_person_lastaddr OWNER TO admin;

--
-- Name: acc_person_verifymoderule; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_person_verifymoderule (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    pers_person_id character varying(255),
    acc_verifymoderule_id character varying(50) NOT NULL
);


ALTER TABLE public.acc_person_verifymoderule OWNER TO admin;

--
-- Name: acc_reader; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_reader (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    comm_address smallint,
    comm_type smallint,
    ext_dev_id character varying(255),
    ip character varying(20),
    mac character varying(30),
    multicast character varying(30),
    name character varying(100) NOT NULL,
    offline_refuse smallint,
    port smallint,
    reader_encrypt boolean,
    reader_no smallint NOT NULL,
    reader_state smallint NOT NULL,
    rs485_protocol_type smallint,
    serial_port smallint,
    user_lock_fun smallint,
    wg_inputfmt_id character varying(255),
    wg_reversed smallint,
    door_id character varying(50)
);


ALTER TABLE public.acc_reader OWNER TO admin;

--
-- Name: acc_reader_option; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_reader_option (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    option_name character varying(50) NOT NULL,
    option_type smallint NOT NULL,
    option_value character varying(150) NOT NULL,
    reader_id character varying(50)
);


ALTER TABLE public.acc_reader_option OWNER TO admin;

--
-- Name: acc_timeseg; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_timeseg (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_id bigint,
    friday_end1 character varying(20),
    friday_end2 character varying(20),
    friday_end3 character varying(20),
    friday_start1 character varying(20),
    friday_start2 character varying(20),
    friday_start3 character varying(20),
    holidaytype1_end1 character varying(20),
    holidaytype1_end2 character varying(20),
    holidaytype1_end3 character varying(20),
    holidaytype1_start1 character varying(20),
    holidaytype1_start2 character varying(20),
    holidaytype1_start3 character varying(20),
    holidaytype2_end1 character varying(20),
    holidaytype2_end2 character varying(20),
    holidaytype2_end3 character varying(20),
    holidaytype2_start1 character varying(20),
    holidaytype2_start2 character varying(20),
    holidaytype2_start3 character varying(20),
    holidaytype3_end1 character varying(20),
    holidaytype3_end2 character varying(20),
    holidaytype3_end3 character varying(20),
    holidaytype3_start1 character varying(20),
    holidaytype3_start2 character varying(20),
    holidaytype3_start3 character varying(20),
    init_flag boolean,
    monday_end1 character varying(20),
    monday_end2 character varying(20),
    monday_end3 character varying(20),
    monday_start1 character varying(20),
    monday_start2 character varying(20),
    monday_start3 character varying(20),
    name character varying(30),
    remark character varying(50),
    saturday_end1 character varying(20),
    saturday_end2 character varying(20),
    saturday_end3 character varying(20),
    saturday_start1 character varying(20),
    saturday_start2 character varying(20),
    saturday_start3 character varying(20),
    sunday_end1 character varying(20),
    sunday_end2 character varying(20),
    sunday_end3 character varying(20),
    sunday_start1 character varying(20),
    sunday_start2 character varying(20),
    sunday_start3 character varying(20),
    thursday_end1 character varying(20),
    thursday_end2 character varying(20),
    thursday_end3 character varying(20),
    thursday_start1 character varying(20),
    thursday_start2 character varying(20),
    thursday_start3 character varying(20),
    tuesday_end1 character varying(20),
    tuesday_end2 character varying(20),
    tuesday_end3 character varying(20),
    tuesday_start1 character varying(20),
    tuesday_start2 character varying(20),
    tuesday_start3 character varying(20),
    wednesday_end1 character varying(20),
    wednesday_end2 character varying(20),
    wednesday_end3 character varying(20),
    wednesday_start1 character varying(20),
    wednesday_start2 character varying(20),
    wednesday_start3 character varying(20)
);


ALTER TABLE public.acc_timeseg OWNER TO admin;

--
-- Name: acc_timeseg_bid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_timeseg_bid (
    id bigint NOT NULL
);


ALTER TABLE public.acc_timeseg_bid OWNER TO admin;

--
-- Name: acc_topdoor_by_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_topdoor_by_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    door_id character varying(255) NOT NULL,
    person_id character varying(255) NOT NULL
);


ALTER TABLE public.acc_topdoor_by_person OWNER TO admin;

--
-- Name: acc_transaction; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_transaction (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    acc_zone character varying(30),
    acc_zone_code character varying(30),
    area_name character varying(100),
    card_no character varying(255),
    dept_code character varying(100),
    dept_name character varying(100),
    description character varying(200),
    dev_alias character varying(100),
    dev_id character varying(255),
    dev_sn character varying(30),
    event_addr smallint,
    event_name character varying(100),
    event_no smallint NOT NULL,
    event_point_id character varying(255),
    event_point_name character varying(100),
    event_point_type smallint,
    event_time timestamp without time zone NOT NULL,
    last_name character varying(50),
    log_id integer,
    mask_flag character varying(10),
    name character varying(50),
    pin character varying(30),
    reader_name character varying(100),
    reader_state smallint,
    temperature character varying(50),
    trigger_cond smallint,
    unique_key character varying(250),
    verify_mode_name character varying(100),
    verify_mode_no smallint,
    vid_linkage_handle character varying(256)
);


ALTER TABLE public.acc_transaction OWNER TO admin;

--
-- Name: acc_verifymode_rule; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.acc_verifymode_rule (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    friday_time1_vs_door smallint,
    friday_time1_vs_person smallint,
    friday_time2_vs_door smallint,
    friday_time2_vs_person smallint,
    friday_time3_vs_door smallint,
    friday_time3_vs_person smallint,
    holidaytype1_time1_vs_door smallint,
    holidaytype1_time1_vs_person smallint,
    holidaytype1_time2_vs_door smallint,
    holidaytype1_time2_vs_person smallint,
    holidaytype1_time3_vs_door smallint,
    holidaytype1_time3_vs_person smallint,
    holidaytype2_time1_vs_door smallint,
    holidaytype2_time1_vs_person smallint,
    holidaytype2_time2_vs_door smallint,
    holidaytype2_time2_vs_person smallint,
    holidaytype2_time3_vs_door smallint,
    holidaytype2_time3_vs_person smallint,
    holidaytype3_time1_vs_door smallint,
    holidaytype3_time1_vs_person smallint,
    holidaytype3_time2_vs_door smallint,
    holidaytype3_time2_vs_person smallint,
    holidaytype3_time3_vs_door smallint,
    holidaytype3_time3_vs_person smallint,
    monday_time1_vs_door smallint,
    monday_time1_vs_person smallint,
    monday_time2_vs_door smallint,
    monday_time2_vs_person smallint,
    monday_time3_vs_door smallint,
    monday_time3_vs_person smallint,
    name character varying(30) NOT NULL,
    new_verify_mode smallint,
    saturday_time1_vs_door smallint,
    saturday_time1_vs_person smallint,
    saturday_time2_vs_door smallint,
    saturday_time2_vs_person smallint,
    saturday_time3_vs_door smallint,
    saturday_time3_vs_person smallint,
    sunday_time1_vs_door smallint,
    sunday_time1_vs_person smallint,
    sunday_time2_vs_door smallint,
    sunday_time2_vs_person smallint,
    sunday_time3_vs_door smallint,
    sunday_time3_vs_person smallint,
    thursday_time1_vs_door smallint,
    thursday_time1_vs_person smallint,
    thursday_time2_vs_door smallint,
    thursday_time2_vs_person smallint,
    thursday_time3_vs_door smallint,
    thursday_time3_vs_person smallint,
    tuesday_time1_vs_door smallint,
    tuesday_time1_vs_person smallint,
    tuesday_time2_vs_door smallint,
    tuesday_time2_vs_person smallint,
    tuesday_time3_vs_door smallint,
    tuesday_time3_vs_person smallint,
    wednesday_time1_vs_door smallint,
    wednesday_time1_vs_person smallint,
    wednesday_time2_vs_door smallint,
    wednesday_time2_vs_person smallint,
    wednesday_time3_vs_door smallint,
    wednesday_time3_vs_person smallint,
    timeseg_id character varying(50)
);


ALTER TABLE public.acc_verifymode_rule OWNER TO admin;

--
-- Name: adms_acc_device_log; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_acc_device_log (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    card_no character varying(255),
    event_addr character varying(255),
    event_desc character varying(255),
    event_no character varying(255),
    event_time character varying(255),
    inout_status character varying(255),
    log_index character varying(255),
    open_mode character varying(255),
    pin character varying(255),
    sn character varying(255),
    verify_type character varying(255)
);


ALTER TABLE public.adms_acc_device_log OWNER TO admin;

--
-- Name: adms_att_device_log; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_att_device_log (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    pin character varying(255),
    record_status character varying(5),
    record_time character varying(255),
    sn character varying(255),
    verify character varying(5)
);


ALTER TABLE public.adms_att_device_log OWNER TO admin;

--
-- Name: adms_auth_device; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_auth_device (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    acc_support_fun_list character varying(300),
    auth_flag boolean NOT NULL,
    device_name character varying(255),
    device_secret character varying(255),
    device_type character varying(255),
    dns character varying(255),
    dns_fun_on character varying(255),
    ex_param text,
    gateway character varying(50),
    ip character varying(50) NOT NULL,
    is_support_ssl character varying(255),
    mac_address character varying(50),
    master_control_on character varying(255),
    mode_type character varying(255),
    product_id character varying(255),
    product_key character varying(255),
    protype character varying(255),
    remark character varying(255),
    server_url character varying(255),
    sn character varying(255),
    sub_control_on character varying(255),
    subnet_mask character varying(50),
    ver character varying(255)
);


ALTER TABLE public.adms_auth_device OWNER TO admin;

--
-- Name: adms_cmd_id; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_cmd_id (
    id bigint NOT NULL
);


ALTER TABLE public.adms_cmd_id OWNER TO admin;

--
-- Name: adms_devcmd; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_devcmd (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    app_name character varying(10),
    cmd_id bigint,
    comm_type smallint,
    commit_time timestamp without time zone NOT NULL,
    content text NOT NULL,
    is_imme boolean,
    remark text,
    return_time timestamp without time zone,
    return_value integer,
    sn character varying(50),
    sync boolean
);


ALTER TABLE public.adms_devcmd OWNER TO admin;

--
-- Name: adms_device; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_device (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    dev_alias character varying(100) NOT NULL,
    baudrate integer,
    com_address smallint,
    com_port smallint,
    comm_pwd character varying(32),
    comm_type smallint NOT NULL,
    device_name character varying(50),
    enabled boolean NOT NULL,
    fw_version character varying(50),
    gateway character varying(15),
    ip_address character varying(15),
    ip_port integer,
    module character varying(10),
    push_version character varying(255),
    sn character varying(50),
    subnet_mask character varying(15),
    parent_id character varying(50)
);


ALTER TABLE public.adms_device OWNER TO admin;

--
-- Name: adms_device_option; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_device_option (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    option_name character varying(50) NOT NULL,
    option_type smallint,
    option_value character varying(200) NOT NULL,
    dev_id character varying(50)
);


ALTER TABLE public.adms_device_option OWNER TO admin;

--
-- Name: adms_pos_allow_log; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_pos_allow_log (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    allow_money double precision,
    allow_time character varying(255),
    balance double precision,
    base_batch character varying(255),
    batch character varying(255),
    card_no character varying(255),
    card_rec_id character varying(255),
    rec_no character varying(255),
    sn character varying(255),
    state character varying(255),
    sys_id character varying(255)
);


ALTER TABLE public.adms_pos_allow_log OWNER TO admin;

--
-- Name: adms_pos_buy_log; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_pos_buy_log (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    balance double precision,
    card_no character varying(255),
    card_rec_id character varying(255),
    meal_date character varying(255),
    meal_type character varying(255),
    op_id character varying(255),
    pos_money double precision,
    pos_time character varying(255),
    rec_no character varying(255),
    sn character varying(255),
    state character varying(255),
    sys_id character varying(255)
);


ALTER TABLE public.adms_pos_buy_log OWNER TO admin;

--
-- Name: adms_pos_full_log; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_pos_full_log (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    balance double precision,
    card_no character varying(255),
    log_type character varying(255),
    op_id character varying(255),
    rec_no character varying(255),
    sn character varying(255),
    sup_money double precision,
    sup_time character varying(255),
    sys_id character varying(255)
);


ALTER TABLE public.adms_pos_full_log OWNER TO admin;

--
-- Name: adms_product; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.adms_product (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    name character varying(50) NOT NULL,
    product_key character varying(50) NOT NULL,
    remark character varying(255)
);


ALTER TABLE public.adms_product OWNER TO admin;

--
-- Name: att_adjust; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_adjust (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    adjust_date timestamp without time zone,
    adjust_type smallint,
    business_key character varying(50),
    auth_dept_id character varying(50),
    flow_status character varying(255),
    pers_person_id character varying(50),
    pers_person_pin character varying(30),
    remark character varying(255),
    shift_id character varying(50)
);


ALTER TABLE public.att_adjust OWNER TO admin;

--
-- Name: att_area_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_area_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(50),
    pers_person_id character varying(50)
);


ALTER TABLE public.att_area_person OWNER TO admin;

--
-- Name: att_autoexport; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_autoexport (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(50),
    auth_dept_id character varying(50),
    email_content character varying(255),
    email_recipients character varying(500),
    email_subject character varying(255),
    email_type character varying(30),
    file_content_format character varying(255),
    file_date_format character varying(30),
    file_field_convert character varying(255),
    file_name character varying(50),
    file_time_format character varying(50),
    file_type character varying(30),
    ftp_password character varying(250),
    ftp_port integer,
    ftp_url character varying(30),
    ftp_username character varying(30),
    job_class character varying(50),
    job_cron character varying(50),
    job_name character varying(50),
    job_status character varying(30),
    report_type character varying(30),
    send_format character varying(30),
    time_send_frequency character varying(30),
    time_send_interval character varying(50)
);


ALTER TABLE public.att_autoexport OWNER TO admin;

--
-- Name: att_break_time; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_break_time (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    end_time character varying(255),
    name character varying(255),
    start_time character varying(255)
);


ALTER TABLE public.att_break_time OWNER TO admin;

--
-- Name: att_class; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_class (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    adjust_date timestamp without time zone,
    auth_adjustdept_id character varying(50),
    pers_adjustperson_id character varying(50),
    pers_adjustperson_pin character varying(50),
    adjust_type smallint,
    business_key character varying(50),
    flow_status character varying(255),
    remark character varying(255),
    swap_date timestamp without time zone,
    auth_swapdept_id character varying(50),
    pers_swapperson_id character varying(50),
    pers_swapperson_pin character varying(50),
    swapshift_id character varying(255)
);


ALTER TABLE public.att_class OWNER TO admin;

--
-- Name: att_custom_rule; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_custom_rule (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    count_overtime character varying(255),
    cross_day character varying(255),
    late_and_early character varying(255),
    maxovertime_minutes character varying(255),
    maxovertime_type character varying(255),
    rule_name character varying(255),
    rule_type character varying(4),
    shortest_overtime_minutes character varying(255),
    sign_break_time character varying(255),
    sign_in character varying(255),
    sign_out character varying(255),
    smart_find_class character varying(255)
);


ALTER TABLE public.att_custom_rule OWNER TO admin;

--
-- Name: att_custom_rule_org; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_custom_rule_org (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    org_id character varying(255),
    rule_id character varying(255)
);


ALTER TABLE public.att_custom_rule_org OWNER TO admin;

--
-- Name: att_cyclesch; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_cyclesch (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    cycle_type smallint,
    auth_dept_id character varying(50),
    end_date timestamp without time zone,
    group_id character varying(50),
    pers_person_id character varying(50),
    pers_person_pin character varying(50),
    schedule_type smallint,
    start_date timestamp without time zone
);


ALTER TABLE public.att_cyclesch OWNER TO admin;

--
-- Name: att_cyclesch_shift; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_cyclesch_shift (
    shift_id character varying(50) NOT NULL,
    cyclesch_id character varying(50) NOT NULL
);


ALTER TABLE public.att_cyclesch_shift OWNER TO admin;

--
-- Name: att_day_card_detail; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_day_card_detail (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    att_date character varying(50),
    att_times character varying(255),
    card_count integer,
    auth_dept_code character varying(50),
    auth_dept_id character varying(50),
    auth_dept_name character varying(50),
    earliest_time character varying(20),
    latest_time character varying(20),
    pers_person_lastname character varying(50),
    pers_person_name character varying(50),
    pers_person_pin character varying(50)
);


ALTER TABLE public.att_day_card_detail OWNER TO admin;

--
-- Name: att_deptsch; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_deptsch (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attendance_mode smallint,
    auth_dept_id character varying(50),
    end_date timestamp without time zone,
    overtime_mode smallint,
    overtime_remark smallint,
    schedule_type smallint,
    start_date timestamp without time zone
);


ALTER TABLE public.att_deptsch OWNER TO admin;

--
-- Name: att_deptsch_shift; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_deptsch_shift (
    shift_id character varying(50) NOT NULL,
    deptsch_id character varying(50) NOT NULL
);


ALTER TABLE public.att_deptsch_shift OWNER TO admin;

--
-- Name: att_device; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_device (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(255),
    cmd_count smallint,
    comm_port integer,
    data_down_flag character varying(255),
    dev_model character varying(50),
    dev_name character varying(50),
    dev_sn character varying(50),
    dev_status smallint,
    face_count integer,
    face_version character varying(50),
    fp_count integer,
    fp_version character varying(50),
    fw_version character varying(50),
    ip_address character varying(50),
    is_reg_device boolean,
    person_count integer,
    protocol character varying(50),
    push_commkey character varying(50),
    real_time boolean,
    record_count integer,
    search_interval smallint,
    status boolean,
    time_zone character varying(50),
    trans_interval smallint,
    trans_times character varying(255),
    update_flag character varying(50)
);


ALTER TABLE public.att_device OWNER TO admin;

--
-- Name: att_device_op_log; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_device_op_log (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(50),
    dev_sn character varying(50),
    op_content character varying(100),
    op_time timestamp without time zone,
    op_type character varying(50),
    op_value1 character varying(50),
    op_value2 character varying(50),
    op_value3 character varying(50),
    op_value_content1 character varying(100),
    op_value_content2 character varying(100),
    op_value_content3 character varying(100),
    op_who_content character varying(100),
    op_who_value character varying(50),
    operator_pin character varying(50),
    operator_name character varying(50)
);


ALTER TABLE public.att_device_op_log OWNER TO admin;

--
-- Name: att_device_option; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_device_option (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    option_name character varying(50),
    option_value character varying(150),
    dev_id character varying(50)
);


ALTER TABLE public.att_device_option OWNER TO admin;

--
-- Name: att_group; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_group (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    group_name character varying(30),
    group_no character varying(5),
    remark character varying(255)
);


ALTER TABLE public.att_group OWNER TO admin;

--
-- Name: att_group_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_group_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    group_id character varying(255),
    pers_person_id character varying(255)
);


ALTER TABLE public.att_group_person OWNER TO admin;

--
-- Name: att_groupsch; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_groupsch (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attendance_mode smallint,
    end_date timestamp without time zone,
    group_id character varying(50),
    overtime_mode smallint,
    overtime_remark smallint,
    schedule_type smallint,
    start_date timestamp without time zone
);


ALTER TABLE public.att_groupsch OWNER TO admin;

--
-- Name: att_groupsch_shift; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_groupsch_shift (
    shift_id character varying(50) NOT NULL,
    groupsch_id character varying(50) NOT NULL
);


ALTER TABLE public.att_groupsch_shift OWNER TO admin;

--
-- Name: att_holiday; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_holiday (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    day_number smallint,
    end_datetime timestamp without time zone,
    holiday_name character varying(30),
    holiday_no character varying(10),
    is_all_the_holidays boolean,
    remark character varying(255),
    start_datetime timestamp without time zone
);


ALTER TABLE public.att_holiday OWNER TO admin;

--
-- Name: att_leave; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_leave (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_key character varying(50),
    days real,
    auth_dept_code character varying(100),
    auth_dept_id character varying(50),
    auth_dept_name character varying(100),
    end_datetime timestamp without time zone,
    flow_status character varying(255),
    leave_image_path character varying(1000),
    leave_long integer,
    leavetype_id character varying(50),
    pers_person_id character varying(50),
    pers_person_last_name character varying(50),
    pers_person_name character varying(50),
    pers_person_pin character varying(50),
    remark character varying(255),
    start_datetime timestamp without time zone
);


ALTER TABLE public.att_leave OWNER TO admin;

--
-- Name: att_leavetype; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_leavetype (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    convert_count double precision,
    convert_type character varying(20),
    convert_unit character varying(20),
    init_flag boolean,
    is_deduct_work_long boolean,
    leavetype_name character varying(50),
    leavetype_no character varying(50),
    mark character varying(20),
    symbol character varying(20)
);


ALTER TABLE public.att_leavetype OWNER TO admin;

--
-- Name: att_out; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_out (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_key character varying(50),
    auth_dept_id character varying(50),
    end_datetime timestamp without time zone,
    flow_status character varying(255),
    out_long integer,
    pers_person_id character varying(50),
    pers_person_pin character varying(50),
    remark character varying(255),
    start_datetime timestamp without time zone
);


ALTER TABLE public.att_out OWNER TO admin;

--
-- Name: att_overtime; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_overtime (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_key character varying(50),
    auth_dept_id character varying(50),
    end_datetime timestamp without time zone,
    flow_status character varying(255),
    overtime_long integer,
    overtime_sign smallint,
    pers_person_id character varying(50),
    pers_person_pin character varying(50),
    remark character varying(255),
    start_datetime timestamp without time zone
);


ALTER TABLE public.att_overtime OWNER TO admin;

--
-- Name: att_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    annual_leave_days integer,
    annual_valid_date timestamp without time zone,
    auth_dept_code character varying(100),
    auth_dept_id character varying(50),
    auth_dept_name character varying(100),
    group_id character varying(50),
    hire_date date,
    is_attendance boolean,
    per_dev_auth smallint,
    pers_person_id character varying(50),
    pers_person_lastname character varying(50),
    pers_person_name character varying(50),
    pers_person_pin character varying(30),
    verify_mode smallint
);


ALTER TABLE public.att_person OWNER TO admin;

--
-- Name: att_personsch; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_personsch (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    end_date timestamp without time zone,
    pers_person_id character varying(50),
    schedule_id character varying(50),
    schedule_type smallint,
    start_date timestamp without time zone
);


ALTER TABLE public.att_personsch OWNER TO admin;

--
-- Name: att_personsch_shift; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_personsch_shift (
    shift_id character varying(50) NOT NULL,
    personsch_id character varying(50) NOT NULL
);


ALTER TABLE public.att_personsch_shift OWNER TO admin;

--
-- Name: att_point; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_point (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    area_id character varying(50),
    device_id character varying(50),
    device_module character varying(10),
    device_sn character varying(50),
    door_no smallint,
    ip_address character varying(50),
    point_name character varying(50),
    status smallint
);


ALTER TABLE public.att_point OWNER TO admin;

--
-- Name: att_record; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_record (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    absent_days numeric(19,2),
    absent_minute integer,
    actual_days numeric(19,2),
    actual_minute integer,
    att_date timestamp without time zone,
    attendance_status character varying(255),
    card_status character varying(255),
    card_valid_count integer,
    card_valid_data character varying(255),
    cross_day character varying(255),
    auth_dept_code character varying(100),
    auth_dept_id character varying(50),
    auth_dept_name character varying(100),
    early_count_data character varying(255),
    early_count_total integer,
    early_minute_data character varying(255),
    early_minute_total integer,
    exception_sch_type integer,
    late_count_data character varying(255),
    late_count_total integer,
    late_minute_data character varying(255),
    late_minute_total integer,
    leave_days numeric(19,2),
    leave_details character varying(255),
    leave_minute integer,
    out_days numeric(19,2),
    out_minute integer,
    overtime_holiday_minute integer,
    overtime_minute integer,
    overtime_rest_minute integer,
    overtime_usual_minute integer,
    pers_person_last_name character varying(50),
    pers_person_name character varying(50),
    pers_person_pin character varying(50),
    remark character varying(255),
    shift_name character varying(255),
    shift_no character varying(255),
    shift_time_data character varying(255),
    should_days numeric(19,2),
    should_minute integer,
    timeslot_name character varying(255),
    trip_days numeric(19,2),
    trip_minute integer,
    valid_days numeric(19,2),
    valid_minute integer,
    week character varying(255)
);


ALTER TABLE public.att_record OWNER TO admin;

--
-- Name: att_shift; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_shift (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attendance_mode smallint,
    is_shift_within_month boolean,
    overtime_mode smallint,
    overtime_sign smallint,
    period_number smallint,
    period_start_mode character varying(255),
    periodic_unit smallint,
    shift_color character varying(255),
    shift_name character varying(50),
    shift_no character varying(50),
    shift_type smallint,
    start_date timestamp without time zone,
    time_slot_detail_ids text,
    shift_worktype character varying(255)
);


ALTER TABLE public.att_shift OWNER TO admin;

--
-- Name: att_shift_timeslot; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_shift_timeslot (
    timeslot_id character varying(50) NOT NULL,
    shift_id character varying(50) NOT NULL
);


ALTER TABLE public.att_shift_timeslot OWNER TO admin;

--
-- Name: att_sign; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_sign (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    after_sign_record character varying(255),
    before_sign_record character varying(255),
    business_key character varying(50),
    auth_dept_id character varying(50),
    flow_status character varying(255),
    pers_person_id character varying(50),
    pers_person_pin character varying(30),
    remark character varying(255),
    sign_datetime timestamp without time zone
);


ALTER TABLE public.att_sign OWNER TO admin;

--
-- Name: att_sign_address; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_sign_address (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    address character varying(255),
    latitude character varying(255),
    longitude character varying(255),
    valid_range integer
);


ALTER TABLE public.att_sign_address OWNER TO admin;

--
-- Name: att_sign_address_area; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_sign_address_area (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    area_id character varying(255),
    sign_address_id character varying(255)
);


ALTER TABLE public.att_sign_address_area OWNER TO admin;

--
-- Name: att_tempsch; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_tempsch (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attendance_mode smallint,
    auth_dept_id character varying(50),
    end_date timestamp without time zone,
    group_id character varying(50),
    overtime_mode smallint,
    overtime_remark smallint,
    pers_person_id character varying(50),
    pers_person_pin character varying(50),
    schedule_type smallint,
    start_date timestamp without time zone,
    temp_type smallint,
    shift_worktype character varying(255)
);


ALTER TABLE public.att_tempsch OWNER TO admin;

--
-- Name: att_tempsch_timeslot; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_tempsch_timeslot (
    tempsch_id character varying(50) NOT NULL,
    timeslot_id character varying(50) NOT NULL
);


ALTER TABLE public.att_tempsch_timeslot OWNER TO admin;

--
-- Name: att_timeslot; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_timeslot (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    advance_work_minutes integer,
    after_off_work_minutes integer,
    after_to_work_minutes integer,
    after_work_overtime_minutes integer,
    allow_early_minutes smallint,
    allow_late_minutes smallint,
    before_off_work_minutes integer,
    before_to_work_minutes integer,
    before_work_overtime_minutes integer,
    delayed_work_minutes integer,
    elastic_cal character varying(4),
    enable_flexible_work character varying(10),
    enable_working_hours character varying(255),
    end_segment_time character varying(20),
    end_sign_in_time character varying(20),
    end_sign_off_time character varying(20),
    inter_segment_deduction smallint,
    is_advance_count_overtime boolean,
    is_count_overtime boolean,
    is_delay_count_overtime boolean,
    is_must_sign_in boolean,
    is_must_sign_off boolean,
    is_postpone_count_overtime boolean,
    is_segment_deduction boolean,
    mark_working_days character varying(20),
    max_after_overtime_minutes integer,
    max_before_overtime_minutes integer,
    min_after_overtime_minutes integer,
    min_before_overtime_minutes integer,
    off_work_time character varying(20),
    period_name character varying(50),
    period_no character varying(50),
    period_type smallint,
    sign_in_advance_time character varying(20),
    sign_out_pospone_time character varying(20),
    start_overtime character varying(20),
    start_segment_time character varying(20),
    start_sign_in_time character varying(20),
    start_sign_off_time character varying(20),
    to_work_time character varying(20),
    working_hours smallint
);


ALTER TABLE public.att_timeslot OWNER TO admin;

--
-- Name: att_timeslot_breaktime; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_timeslot_breaktime (
    timeslot_id character varying(50) NOT NULL,
    breaktime_id character varying(50) NOT NULL
);


ALTER TABLE public.att_timeslot_breaktime OWNER TO admin;

--
-- Name: att_timing; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_timing (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    job_class character varying(50),
    job_cron character varying(50),
    job_name character varying(50),
    job_status boolean,
    time_calc_frequency character varying(1),
    time_calc_interval character varying(100)
);


ALTER TABLE public.att_timing OWNER TO admin;

--
-- Name: att_transaction; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_transaction (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(50),
    auth_area_name character varying(100),
    auth_area_no character varying(50),
    att_date character varying(30),
    att_datetime timestamp without time zone,
    att_photo_url character varying(255),
    att_place character varying(250),
    att_state character varying(20),
    att_time character varying(30),
    att_verify character varying(10),
    auth_dept_code character varying(100),
    auth_dept_id character varying(50),
    auth_dept_name character varying(100),
    device_id character varying(50),
    device_name character varying(50),
    device_sn character varying(50),
    door_no smallint,
    mark character varying(10),
    mask_flag character varying(255),
    pers_person_last_name character varying(50),
    pers_person_name character varying(50),
    pers_person_pin character varying(50),
    temperature character varying(255)
);


ALTER TABLE public.att_transaction OWNER TO admin;

--
-- Name: att_trip; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.att_trip (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_key character varying(50),
    auth_dept_id character varying(50),
    end_datetime timestamp without time zone,
    flow_status character varying(255),
    pers_person_id character varying(50),
    pers_person_pin character varying(50),
    remark character varying(255),
    start_datetime timestamp without time zone,
    trip_long integer
);


ALTER TABLE public.att_trip OWNER TO admin;

--
-- Name: auth_api_token; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_api_token (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    client_name character varying(50),
    client_token character varying(255)
);


ALTER TABLE public.auth_api_token OWNER TO admin;

--
-- Name: auth_app; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_app (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    app_key character varying(100),
    app_secret character varying(500),
    application_id character varying(100),
    license_id character varying(200),
    name character varying(100),
    remark character varying(100),
    status integer,
    token character varying(200),
    auth_app_type character varying(200)
);


ALTER TABLE public.auth_app OWNER TO admin;

--
-- Name: auth_appmenus; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_appmenus (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(30) NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.auth_appmenus OWNER TO admin;

--
-- Name: auth_appmenus_children; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_appmenus_children (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    color character varying(100),
    icon character varying(100),
    name character varying(100) NOT NULL,
    text character varying(100) NOT NULL,
    app_menus_id character varying(50) NOT NULL
);


ALTER TABLE public.auth_appmenus_children OWNER TO admin;

--
-- Name: auth_area; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_area (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(30) NOT NULL,
    init_flag boolean,
    name character varying(100) NOT NULL,
    remark character varying(50),
    parent_id character varying(50)
);


ALTER TABLE public.auth_area OWNER TO admin;

--
-- Name: auth_biotemplate; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_biotemplate (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    bio_type smallint NOT NULL,
    template character varying(3000) NOT NULL,
    template_no smallint NOT NULL,
    version character varying(20) NOT NULL,
    user_id character varying(50)
);


ALTER TABLE public.auth_biotemplate OWNER TO admin;

--
-- Name: auth_company; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_company (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    admin_name character varying(50),
    admin_pwd character varying(50),
    att_distance integer,
    company_address character varying(255),
    company_name character varying(200),
    contact_name character varying(50),
    email character varying(200),
    latitude character varying(50),
    longitude character varying(50),
    status character varying(2),
    telephone character varying(50)
);


ALTER TABLE public.auth_company OWNER TO admin;

--
-- Name: auth_department; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_department (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(30) NOT NULL,
    init_code character varying(30),
    name character varying(100) NOT NULL,
    sort integer,
    parent_id character varying(50)
);


ALTER TABLE public.auth_department OWNER TO admin;

--
-- Name: auth_permission; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_permission (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_link character varying(255),
    available character varying(10),
    code character varying(50),
    img character varying(120),
    img_hover character varying(150),
    name character varying(50),
    order_no integer,
    permission character varying(128),
    resource_type character varying(255),
    auth_permission_parent_id character varying(50)
);


ALTER TABLE public.auth_permission OWNER TO admin;

--
-- Name: auth_role; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_role (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(200) NOT NULL,
    name character varying(30) NOT NULL,
    remark character varying(50)
);


ALTER TABLE public.auth_role OWNER TO admin;

--
-- Name: auth_role_permission; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_role_permission (
    auth_role_id character varying(50) NOT NULL,
    auth_permission_id character varying(50) NOT NULL
);


ALTER TABLE public.auth_role_permission OWNER TO admin;

--
-- Name: auth_security_param; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_security_param (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    date_value timestamp without time zone,
    name character varying(255),
    type character varying(255),
    value character varying(255)
);


ALTER TABLE public.auth_security_param OWNER TO admin;

--
-- Name: auth_user; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_user (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    email character varying(100),
    init_flag boolean,
    is_active boolean,
    is_staff boolean,
    is_superuser boolean,
    last_name character varying(50),
    login_pwd character varying(128),
    name character varying(50),
    phone character varying(100),
    pwd_create_time timestamp without time zone,
    pwd_init_flag character varying(10),
    salt character varying(50),
    user_login_limit integer,
    user_type character varying(2),
    username character varying(30)
);


ALTER TABLE public.auth_user OWNER TO admin;

--
-- Name: auth_user_area; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_user_area (
    auth_user_id character varying(50) NOT NULL,
    auth_area_id character varying(50) NOT NULL
);


ALTER TABLE public.auth_user_area OWNER TO admin;

--
-- Name: auth_user_dept; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_user_dept (
    auth_user_id character varying(50) NOT NULL,
    auth_dept_id character varying(50) NOT NULL
);


ALTER TABLE public.auth_user_dept OWNER TO admin;

--
-- Name: auth_user_role; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.auth_user_role (
    auth_user_id character varying(50) NOT NULL,
    auth_role_id character varying(50) NOT NULL
);


ALTER TABLE public.auth_user_role OWNER TO admin;

--
-- Name: base_dbbackup; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_dbbackup (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    backup_path character varying(200),
    backup_result smallint,
    db_version character varying(20),
    is_imme boolean,
    start_time timestamp without time zone
);


ALTER TABLE public.base_dbbackup OWNER TO admin;

--
-- Name: base_dictionary; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_dictionary (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    is_allow_modify boolean,
    code character varying(60) NOT NULL,
    module_name character varying(50),
    name character varying(60) NOT NULL
);


ALTER TABLE public.base_dictionary OWNER TO admin;

--
-- Name: base_dictionary_value; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_dictionary_value (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(60) NOT NULL,
    dict_value character varying(100) NOT NULL,
    remark character varying(50),
    sort integer,
    dict_id character varying(50)
);


ALTER TABLE public.base_dictionary_value OWNER TO admin;

--
-- Name: base_lang_res; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_lang_res (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    content text,
    is_unconformity boolean,
    module_code character varying(50),
    name character varying(100),
    pro_order integer,
    lang_id character varying(50)
);


ALTER TABLE public.base_lang_res OWNER TO admin;

--
-- Name: base_language; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_language (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    build_in_flag boolean,
    code character varying(30) NOT NULL
);


ALTER TABLE public.base_language OWNER TO admin;

--
-- Name: base_mail; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_mail (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attachments character varying(600),
    commit_time timestamp without time zone,
    content character varying(600) NOT NULL,
    receiver character varying(600) NOT NULL,
    ret smallint,
    ret_message character varying(200),
    send_time timestamp without time zone,
    sender character varying(100),
    subject character varying(50) NOT NULL
);


ALTER TABLE public.base_mail OWNER TO admin;

--
-- Name: base_media_file; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_media_file (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    file_size character varying(100) NOT NULL,
    init_flag boolean,
    name character varying(255) NOT NULL,
    path character varying(100) NOT NULL,
    suffix character varying(15) NOT NULL
);


ALTER TABLE public.base_media_file OWNER TO admin;

--
-- Name: base_message; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_message (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_code character varying(255),
    business_id character varying(255),
    content character varying(250),
    expire_time timestamp without time zone,
    extend_json text,
    href character varying(511),
    href_title character varying(50),
    receiver_id character varying(50),
    remind_time timestamp without time zone,
    remind_type character varying(50),
    sort_num integer,
    status character varying(2),
    title character varying(50),
    type character varying(50)
);


ALTER TABLE public.base_message OWNER TO admin;

--
-- Name: base_oplog; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_oplog (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    content text,
    cost_time integer,
    op_ip character varying(40),
    op_object character varying(200),
    op_result smallint,
    op_sys character varying(40),
    op_time timestamp without time zone,
    op_type character varying(200),
    op_user_id character varying(50),
    op_username character varying(30),
    remark character varying(50)
);


ALTER TABLE public.base_oplog OWNER TO admin;

--
-- Name: base_print_param; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_print_param (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    align character varying(50),
    cell character varying(100),
    color character varying(50),
    direction character varying(50),
    font_family character varying(50),
    font_size character varying(50),
    height character varying(50),
    left_point character varying(50),
    print_type character varying(50),
    print_value character varying(100),
    style character varying(50),
    top_point character varying(50),
    width character varying(50),
    template_id character varying(50)
);


ALTER TABLE public.base_print_param OWNER TO admin;

--
-- Name: base_print_template; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_print_template (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(50),
    height integer,
    init_flag boolean,
    module_code character varying(50),
    name character varying(100),
    orientation smallint,
    width integer
);


ALTER TABLE public.base_print_template OWNER TO admin;

--
-- Name: base_register; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_register (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    authorization_time timestamp without time zone,
    authorized_validtime timestamp without time zone,
    client_name character varying(100),
    client_type character varying(2),
    is_activation smallint,
    registration_code character varying(50) NOT NULL,
    registration_key character varying(50)
);


ALTER TABLE public.base_register OWNER TO admin;

--
-- Name: base_sysparam; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.base_sysparam (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    description character varying(255),
    param_name character varying(50),
    param_value character varying(300),
    is_visible boolean
);


ALTER TABLE public.base_sysparam OWNER TO admin;

--
-- Name: data_source; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.data_source (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    db_name character varying(255),
    ip character varying(255),
    password character varying(255),
    port character varying(255),
    soft_version character varying(255),
    type character varying(255),
    username character varying(255)
);


ALTER TABLE public.data_source OWNER TO admin;

--
-- Name: hep_autoexport; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.hep_autoexport (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    auth_area_id character varying(50),
    auth_dept_id character varying(50),
    email_content character varying(255),
    email_recipients character varying(500),
    email_subject character varying(255),
    email_type character varying(30),
    file_content_format character varying(255),
    file_date_format character varying(30),
    file_name character varying(50),
    file_time_format character varying(50),
    file_type character varying(30),
    job_class character varying(50),
    job_cron character varying(50),
    job_name character varying(50),
    job_status character varying(30),
    report_type character varying(30),
    send_format character varying(30),
    time_send_frequency character varying(30),
    time_send_interval character varying(50)
);


ALTER TABLE public.hep_autoexport OWNER TO admin;

--
-- Name: hep_transaction; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.hep_transaction (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    area_name character varying(100),
    dept_code character varying(100),
    auth_dept_id character varying(50),
    dept_name character varying(100),
    dev_alias character varying(100),
    dev_sn character varying(100),
    event_date character varying(200),
    event_name character varying(50),
    event_point_name character varying(100),
    event_time timestamp without time zone,
    has_temperature character varying(255),
    is_from character varying(255),
    last_name character varying(50),
    mask_flag character varying(10),
    name character varying(50),
    operate_method character varying(255),
    operate_name character varying(255),
    operate_status character varying(255),
    operate_time timestamp without time zone,
    photo_path character varying(255),
    pin character varying(50),
    record_no character varying(50),
    remark character varying(255),
    status character varying(50),
    temperature double precision,
    temperature_back double precision
);


ALTER TABLE public.hep_transaction OWNER TO admin;

--
-- Name: pers_attribute; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_attribute (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attr_name character varying(100),
    value_list character varying(2000),
    control_type character varying(30),
    filed_index integer,
    person_type smallint,
    position_x integer,
    position_y integer,
    show_table boolean,
    sql_str character varying(200)
);


ALTER TABLE public.pers_attribute OWNER TO admin;

--
-- Name: pers_attribute_ext; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_attribute_ext (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    attr_value1 character varying(255),
    attr_value10 character varying(255),
    attr_value11 character varying(255),
    attr_value12 character varying(255),
    attr_value13 character varying(255),
    attr_value14 character varying(255),
    attr_value15 character varying(255),
    attr_value16 character varying(255),
    attr_value17 character varying(255),
    attr_value18 character varying(255),
    attr_value19 character varying(255),
    attr_value2 character varying(255),
    attr_value20 character varying(255),
    attr_value21 character varying(255),
    attr_value22 character varying(255),
    attr_value23 character varying(255),
    attr_value24 character varying(255),
    attr_value25 character varying(255),
    attr_value26 character varying(255),
    attr_value27 character varying(255),
    attr_value28 character varying(255),
    attr_value29 character varying(255),
    attr_value3 character varying(255),
    attr_value30 character varying(255),
    attr_value31 character varying(255),
    attr_value32 character varying(255),
    attr_value4 character varying(255),
    attr_value5 character varying(255),
    attr_value6 character varying(255),
    attr_value7 character varying(255),
    attr_value8 character varying(255),
    attr_value9 character varying(255),
    person_id character varying(255)
);


ALTER TABLE public.pers_attribute_ext OWNER TO admin;

--
-- Name: pers_biotemplate; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_biotemplate (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    bio_type smallint,
    duress boolean,
    person_id character varying(50),
    person_pin character varying(50),
    template text,
    template_no smallint,
    template_no_index smallint,
    valid_type smallint,
    version character varying(20)
);


ALTER TABLE public.pers_biotemplate OWNER TO admin;

--
-- Name: pers_card; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_card (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    card_no character varying(250) NOT NULL,
    card_op_type smallint,
    card_state smallint NOT NULL,
    card_type smallint NOT NULL,
    end_time timestamp without time zone,
    is_from character varying(100),
    issue_time timestamp without time zone NOT NULL,
    logical_card_no character varying(50),
    person_id character varying(50) NOT NULL,
    person_pin character varying(50) NOT NULL,
    start_time timestamp without time zone
);


ALTER TABLE public.pers_card OWNER TO admin;

--
-- Name: pers_certificate; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_certificate (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    cert_number character varying(250),
    cert_status smallint,
    cert_type character varying(20),
    person_id character varying(50)
);


ALTER TABLE public.pers_certificate OWNER TO admin;

--
-- Name: pers_identity_card_info; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_identity_card_info (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    address character varying(255),
    birthday date,
    end_date date,
    gender character varying(10),
    id_card character varying(255),
    issued_organ character varying(255),
    name character varying(20),
    nation character varying(255),
    photo_path character varying(200),
    physical_no character varying(255),
    start_date date,
    template1 character varying(3000),
    template2 character varying(3000)
);


ALTER TABLE public.pers_identity_card_info OWNER TO admin;

--
-- Name: pers_issuecard; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_issuecard (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    card_no character varying(250) NOT NULL,
    last_name character varying(50),
    name character varying(50),
    operate_type smallint NOT NULL,
    pin character varying(30)
);


ALTER TABLE public.pers_issuecard OWNER TO admin;

--
-- Name: pers_leaveperson; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_leaveperson (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    group_id character varying(255),
    auth_dept_code character varying(30) NOT NULL,
    auth_dept_id character varying(50) NOT NULL,
    auth_dept_name character varying(100) NOT NULL,
    hire_date date,
    is_attendance boolean,
    last_name character varying(50),
    leave_date date NOT NULL,
    leave_reason character varying(200),
    leavetype_id integer NOT NULL,
    name character varying(50),
    pin character varying(30) NOT NULL
);


ALTER TABLE public.pers_leaveperson OWNER TO admin;

--
-- Name: pers_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    birthday date,
    car_plate character varying(20),
    auth_dept_id character varying(50) NOT NULL,
    email character varying(250),
    exception_flag smallint,
    gender character varying(1),
    hire_date date,
    id_card character varying(250),
    id_card_physical_no character varying(250),
    is_from character varying(100),
    is_sendmail boolean,
    last_name character varying(50),
    mobile_phone character varying(250),
    name character varying(50),
    name_spell character varying(420),
    number_pin bigint,
    pers_login_limit integer,
    person_pwd character varying(250),
    person_type smallint,
    photo_path character varying(200),
    pin character varying(30) NOT NULL,
    pin_letter boolean,
    self_pwd character varying(250),
    send_sms boolean,
    ssn character varying(20),
    status smallint,
    position_id character varying(50)
);


ALTER TABLE public.pers_person OWNER TO admin;

--
-- Name: pers_person_link; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_person_link (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    link_id character varying(50),
    person_id character varying(50),
    type character varying(30)
);


ALTER TABLE public.pers_person_link OWNER TO admin;

--
-- Name: pers_personchange; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_personchange (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    change_reason character varying(100),
    auth_dept_id character varying(100),
    person_id character varying(50)
);


ALTER TABLE public.pers_personchange OWNER TO admin;

--
-- Name: pers_position; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_position (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    code character varying(30) NOT NULL,
    name character varying(100) NOT NULL,
    sort integer,
    parent_id character varying(50)
);


ALTER TABLE public.pers_position OWNER TO admin;

--
-- Name: pers_temp_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_temp_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    acc_level_ids character varying(255),
    birthday timestamp without time zone,
    card_nos character varying(255),
    cert_number character varying(255),
    cert_type character varying(255),
    company_name character varying(100),
    crop_photo_path character varying(255),
    auth_dept_id character varying(50),
    device_pwd character varying(250),
    email character varying(255),
    family_address character varying(255),
    gender character varying(1),
    hire_date date,
    is_from character varying(100),
    last_name character varying(50),
    mobile_phone character varying(250),
    name character varying(50),
    person_pwd character varying(250),
    photo_path character varying(200),
    pin character varying(30),
    position_code character varying(255),
    status smallint
);


ALTER TABLE public.pers_temp_person OWNER TO admin;

--
-- Name: pers_wiegandfmt; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_wiegandfmt (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    business_id bigint,
    card_fmt character varying(200),
    init_flag boolean,
    is_default_fmt boolean,
    name character varying(30) NOT NULL,
    parity_fmt character varying(200),
    site_code character varying(100),
    wiegand_count smallint NOT NULL,
    wiegand_mode smallint
);


ALTER TABLE public.pers_wiegandfmt OWNER TO admin;

--
-- Name: pers_wiegandfmt_bid; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.pers_wiegandfmt_bid (
    id bigint NOT NULL
);


ALTER TABLE public.pers_wiegandfmt_bid OWNER TO admin;

--
-- Name: seq_acc_combopendoorid; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_acc_combopendoorid
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_acc_combopendoorid OWNER TO admin;

--
-- Name: seq_acc_combopenpersonid; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_acc_combopenpersonid
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_acc_combopenpersonid OWNER TO admin;

--
-- Name: seq_acc_deviceid; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_acc_deviceid
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_acc_deviceid OWNER TO admin;

--
-- Name: seq_acc_dstimeid; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_acc_dstimeid
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_acc_dstimeid OWNER TO admin;

--
-- Name: seq_acc_timesegid; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_acc_timesegid
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_acc_timesegid OWNER TO admin;

--
-- Name: seq_adms_devcmd; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_adms_devcmd
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_adms_devcmd OWNER TO admin;

--
-- Name: seq_pers_wiegandfmtbid; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.seq_pers_wiegandfmtbid
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.seq_pers_wiegandfmtbid OWNER TO admin;

--
-- Name: system_client_info; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.system_client_info (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    address character varying(255),
    city character varying(255),
    contacts character varying(255),
    country_name character varying(255),
    database_version character varying(255),
    email character varying(255),
    industry character varying(255),
    license_id character varying(255),
    company_name character varying(255),
    persons character varying(255),
    products_suppliers character varying(255),
    realmobile character varying(255),
    real_phone character varying(255),
    system_version character varying(255)
);


ALTER TABLE public.system_client_info OWNER TO admin;

--
-- Name: system_module_info; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.system_module_info (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    active_info character varying(255),
    code character varying(255),
    name character varying(255),
    system_client_info_id character varying(255),
    until_time character varying(255),
    version character varying(255)
);


ALTER TABLE public.system_module_info OWNER TO admin;

--
-- Name: vms_area; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_area (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    bio_areaid character varying(255),
    bio_areaparentid character varying(255),
    vms_area character varying(100) NOT NULL,
    vms_areaparent character varying(100)
);


ALTER TABLE public.vms_area OWNER TO admin;

--
-- Name: vms_blackwhite; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_blackwhite (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    blackwhite_type character varying(255),
    blackwhite_name character varying(255)
);


ALTER TABLE public.vms_blackwhite OWNER TO admin;

--
-- Name: vms_blackwhite_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_blackwhite_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    blackwhite_id character varying(50) NOT NULL,
    person_id character varying(50) NOT NULL
);


ALTER TABLE public.vms_blackwhite_person OWNER TO admin;

--
-- Name: vms_capture; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_capture (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    capture_photopath character varying(255),
    capture_channel_name character varying(255),
    capture_channel smallint,
    capture_device character varying(255),
    capture_device_name character varying(255),
    capture_last_name character varying(255),
    capture_name character varying(255),
    person_photopath character varying(255),
    capture_pin character varying(255),
    capture_type character varying(255),
    capture_remark character varying(255),
    capture_serialnumber character varying(255),
    capture_time timestamp without time zone,
    capture_time_str character varying(255),
    capture_verify boolean,
    capture_verifystr character varying(255)
);


ALTER TABLE public.vms_capture OWNER TO admin;

--
-- Name: vms_channel; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_channel (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    channel_no smallint,
    enabled boolean,
    iscmsrecord boolean,
    is_device_record boolean,
    is_intercom_right boolean,
    is_playback_right boolean,
    is_record_right boolean,
    name character varying(100),
    ptz_level smallint,
    dev_id character varying(50)
);


ALTER TABLE public.vms_channel OWNER TO admin;

--
-- Name: vms_channel2entity; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_channel2entity (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    entity_classname character varying(50),
    entity_id character varying(255),
    channel_id character varying(50)
);


ALTER TABLE public.vms_channel2entity OWNER TO admin;

--
-- Name: vms_device; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_device (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    alarm_in_count smallint,
    alarm_out_count smallint,
    dev_alias character varying(100),
    auth_area_id character varying(255),
    channel_count smallint,
    comm_pwd character varying(250),
    devicetype smallint,
    enabled boolean,
    host character varying(50),
    is_online boolean,
    original_protocol smallint,
    port integer,
    protocol smallint,
    server_address character varying(100),
    sn character varying(70),
    username character varying(30)
);


ALTER TABLE public.vms_device OWNER TO admin;

--
-- Name: vms_distribute; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_distribute (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    distribute_group_ids character varying(255),
    distribute_group_names character varying(255),
    distribute_device_ip character varying(255),
    distribute_device_names character varying(255),
    distribute_group_type character varying(255),
    distribute_hit_alarm character varying(255),
    distribute_name character varying(255),
    distribute_verify_time character varying(255),
    distribute_verify_remote character varying(255)
);


ALTER TABLE public.vms_distribute OWNER TO admin;

--
-- Name: vms_distribute_record; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_distribute_record (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    dev_alias character varying(100),
    dev_ip character varying(50),
    group_name character varying(255),
    pers_person_id character varying(255),
    person_last_name character varying(255),
    person_name character varying(255),
    person_pin character varying(255),
    remark character varying(255),
    sn character varying(255),
    status boolean,
    type smallint
);


ALTER TABLE public.vms_distribute_record OWNER TO admin;

--
-- Name: vms_globallinkage; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    enabled boolean NOT NULL,
    is_apply_to_all smallint,
    name character varying(50) NOT NULL
);


ALTER TABLE public.vms_globallinkage OWNER TO admin;

--
-- Name: vms_globallinkage_accout; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_accout (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_time smallint NOT NULL,
    action_type smallint NOT NULL,
    output_id character varying(255) NOT NULL,
    output_type character varying(30) NOT NULL,
    linkage_id character varying(50)
);


ALTER TABLE public.vms_globallinkage_accout OWNER TO admin;

--
-- Name: vms_globallinkage_eleout; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_eleout (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_delay smallint NOT NULL,
    action_time smallint NOT NULL,
    action_type smallint NOT NULL,
    output_id character varying(255) NOT NULL,
    output_type character varying(30) NOT NULL,
    linkage_id character varying(50)
);


ALTER TABLE public.vms_globallinkage_eleout OWNER TO admin;

--
-- Name: vms_globallinkage_in; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_in (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    input_id character varying(255) NOT NULL,
    linkage_id character varying(50)
);


ALTER TABLE public.vms_globallinkage_in OWNER TO admin;

--
-- Name: vms_globallinkage_media; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_media (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    media_content character varying(255) NOT NULL,
    media_type smallint NOT NULL,
    linkage_id character varying(50) NOT NULL
);


ALTER TABLE public.vms_globallinkage_media OWNER TO admin;

--
-- Name: vms_globallinkage_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    vms_person_id character varying(255) NOT NULL,
    linkage_id character varying(50) NOT NULL
);


ALTER TABLE public.vms_globallinkage_person OWNER TO admin;

--
-- Name: vms_globallinkage_trigger; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_trigger (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    trigger_cond smallint NOT NULL,
    trigger_cond_name character varying(100) NOT NULL,
    linkage_id character varying(50)
);


ALTER TABLE public.vms_globallinkage_trigger OWNER TO admin;

--
-- Name: vms_globallinkage_vidout; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_globallinkage_vidout (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    action_time integer NOT NULL,
    action_type smallint NOT NULL,
    linkage_id character varying(50)
);


ALTER TABLE public.vms_globallinkage_vidout OWNER TO admin;

--
-- Name: vms_link; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_link (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    client_type smallint,
    ip character varying(50),
    link_name character varying(50),
    port integer
);


ALTER TABLE public.vms_link OWNER TO admin;

--
-- Name: vms_linkage_event; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_linkage_event (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    vms_linkage_handle character varying(42),
    transaction_id character varying(50)
);


ALTER TABLE public.vms_linkage_event OWNER TO admin;

--
-- Name: vms_monotoring; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_monotoring (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    device_name character varying(255),
    device_sn character varying(255),
    task_name character varying(255),
    operation_type smallint
);


ALTER TABLE public.vms_monotoring OWNER TO admin;

--
-- Name: vms_person; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_person (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    mobile_phone character varying(20),
    pers_person_id character varying(255),
    person_update_time timestamp without time zone,
    person_last_name character varying(255),
    person_name character varying(255),
    person_pin character varying(255),
    person_type character varying(20),
    photo_path character varying(200)
);


ALTER TABLE public.vms_person OWNER TO admin;

--
-- Name: vms_report; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_report (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    report_name character varying(255),
    capture_id character varying(255),
    report_channel_name character varying(255),
    report_channel smallint,
    report_device character varying(255),
    end_time timestamp without time zone,
    photo_path character varying(255),
    report_pin character varying(255),
    report_remark character varying(255),
    report_serialnumber character varying(255),
    start_time timestamp without time zone,
    report_time character varying(255),
    report_type character varying(255),
    verify_flag character varying(255)
);


ALTER TABLE public.vms_report OWNER TO admin;

--
-- Name: vms_search_image; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_search_image (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    channel character varying(255),
    dev_alias character varying(255),
    blackwhite_group_name character varying(255),
    name character varying(255),
    search_photo character varying(255),
    person_pin character varying(255),
    similarity integer,
    search_time character varying(255)
);


ALTER TABLE public.vms_search_image OWNER TO admin;

--
-- Name: vms_transaction; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_transaction (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    dev_alias character varying(100),
    auth_area_id character varying(255),
    area_name character varying(100),
    channel_name character varying(100),
    channel_no smallint,
    description character varying(400),
    end_time timestamp without time zone,
    event_name character varying(255),
    event_no smallint,
    event_type character varying(255),
    file_path character varying(200),
    file_type smallint,
    person_last_name character varying(255),
    person_name character varying(255),
    person_pin character varying(255),
    sn character varying(50),
    start_time timestamp without time zone,
    status smallint
);


ALTER TABLE public.vms_transaction OWNER TO admin;

--
-- Name: vms_user; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_user (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    bio_userid character varying(255),
    vms_loginpwd character varying(128) NOT NULL,
    vms_username character varying(30) NOT NULL,
    vms_usertype character varying(2)
);


ALTER TABLE public.vms_user OWNER TO admin;

--
-- Name: vms_videointercom_transaction; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.vms_videointercom_transaction (
    id character varying(50) NOT NULL,
    app_id character varying(255),
    bio_tbl_id character varying(255),
    company_id character varying(255),
    create_time timestamp without time zone,
    creater_code character varying(100),
    creater_id character varying(50),
    creater_name character varying(100),
    op_version integer,
    update_time timestamp without time zone,
    updater_code character varying(100),
    updater_id character varying(100),
    updater_name character varying(100),
    area_name character varying(100),
    call_time timestamp without time zone,
    call_type smallint,
    dev_alias character varying(100),
    dev_id character varying(255),
    dev_sn character varying(30),
    duration_time integer,
    end_time timestamp without time zone,
    operator character varying(255),
    start_capture_path character varying(200),
    start_time timestamp without time zone
);


ALTER TABLE public.vms_videointercom_transaction OWNER TO admin;

--
-- Name: acc_alarm_monitor acc_alarm_monitor_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_alarm_monitor
    ADD CONSTRAINT acc_alarm_monitor_pkey PRIMARY KEY (id);


--
-- Name: acc_antipassback acc_antipassback_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_antipassback
    ADD CONSTRAINT acc_antipassback_pkey PRIMARY KEY (id);


--
-- Name: acc_auxin acc_auxin_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_auxin
    ADD CONSTRAINT acc_auxin_pkey PRIMARY KEY (id);


--
-- Name: acc_auxout acc_auxout_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_auxout
    ADD CONSTRAINT acc_auxout_pkey PRIMARY KEY (id);


--
-- Name: acc_combopen_comb acc_combopen_comb_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_comb
    ADD CONSTRAINT acc_combopen_comb_pkey PRIMARY KEY (id);


--
-- Name: acc_combopen_door acc_combopen_door_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_door
    ADD CONSTRAINT acc_combopen_door_pkey PRIMARY KEY (id);


--
-- Name: acc_combopen_person acc_combopen_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_person
    ADD CONSTRAINT acc_combopen_person_pkey PRIMARY KEY (id);


--
-- Name: acc_combopendoor_bid acc_combopendoor_bid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopendoor_bid
    ADD CONSTRAINT acc_combopendoor_bid_pkey PRIMARY KEY (id);


--
-- Name: acc_combopenperson_bid acc_combopenperson_bid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopenperson_bid
    ADD CONSTRAINT acc_combopenperson_bid_pkey PRIMARY KEY (id);


--
-- Name: acc_device_bid acc_device_bid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_bid
    ADD CONSTRAINT acc_device_bid_pkey PRIMARY KEY (id);


--
-- Name: acc_device_event acc_device_event_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_event
    ADD CONSTRAINT acc_device_event_pkey PRIMARY KEY (id);


--
-- Name: acc_device_option acc_device_option_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_option
    ADD CONSTRAINT acc_device_option_pkey PRIMARY KEY (id);


--
-- Name: acc_device acc_device_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device
    ADD CONSTRAINT acc_device_pkey PRIMARY KEY (id);


--
-- Name: acc_device_verifymode acc_device_verifymode_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_verifymode
    ADD CONSTRAINT acc_device_verifymode_pkey PRIMARY KEY (id);


--
-- Name: acc_door acc_door_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_door
    ADD CONSTRAINT acc_door_pkey PRIMARY KEY (id);


--
-- Name: acc_door_verifymoderule acc_door_verifymoderule_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_door_verifymoderule
    ADD CONSTRAINT acc_door_verifymoderule_pkey PRIMARY KEY (id);


--
-- Name: acc_dstime_bid acc_dstime_bid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_dstime_bid
    ADD CONSTRAINT acc_dstime_bid_pkey PRIMARY KEY (id);


--
-- Name: acc_dstime acc_dstime_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_dstime
    ADD CONSTRAINT acc_dstime_pkey PRIMARY KEY (id);


--
-- Name: acc_ext_device acc_ext_device_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_ext_device
    ADD CONSTRAINT acc_ext_device_pkey PRIMARY KEY (id);


--
-- Name: acc_firstin_lastout acc_firstin_lastout_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_firstin_lastout
    ADD CONSTRAINT acc_firstin_lastout_pkey PRIMARY KEY (id);


--
-- Name: acc_firstopen acc_firstopen_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_firstopen
    ADD CONSTRAINT acc_firstopen_pkey PRIMARY KEY (id);


--
-- Name: acc_holiday acc_holiday_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_holiday
    ADD CONSTRAINT acc_holiday_pkey PRIMARY KEY (id);


--
-- Name: acc_interlock acc_interlock_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_interlock
    ADD CONSTRAINT acc_interlock_pkey PRIMARY KEY (id);


--
-- Name: acc_level_dept acc_level_dept_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_dept
    ADD CONSTRAINT acc_level_dept_pkey PRIMARY KEY (id);


--
-- Name: acc_level_door acc_level_door_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_door
    ADD CONSTRAINT acc_level_door_pkey PRIMARY KEY (id);


--
-- Name: acc_level_person acc_level_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_person
    ADD CONSTRAINT acc_level_person_pkey PRIMARY KEY (id);


--
-- Name: acc_level acc_level_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level
    ADD CONSTRAINT acc_level_pkey PRIMARY KEY (id);


--
-- Name: acc_linkage_index acc_linkage_index_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_index
    ADD CONSTRAINT acc_linkage_index_pkey PRIMARY KEY (id);


--
-- Name: acc_linkage_inout acc_linkage_inout_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_inout
    ADD CONSTRAINT acc_linkage_inout_pkey PRIMARY KEY (id);


--
-- Name: acc_linkage_media acc_linkage_media_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_media
    ADD CONSTRAINT acc_linkage_media_pkey PRIMARY KEY (id);


--
-- Name: acc_linkage acc_linkage_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage
    ADD CONSTRAINT acc_linkage_pkey PRIMARY KEY (id);


--
-- Name: acc_linkage_trigger acc_linkage_trigger_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_trigger
    ADD CONSTRAINT acc_linkage_trigger_pkey PRIMARY KEY (id);


--
-- Name: acc_linkage_vid acc_linkage_vid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_vid
    ADD CONSTRAINT acc_linkage_vid_pkey PRIMARY KEY (id);


--
-- Name: acc_map acc_map_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_map
    ADD CONSTRAINT acc_map_pkey PRIMARY KEY (id);


--
-- Name: acc_map_pos acc_map_pos_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_map_pos
    ADD CONSTRAINT acc_map_pos_pkey PRIMARY KEY (id);


--
-- Name: acc_person_combopenperson acc_person_combopenperson_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_combopenperson
    ADD CONSTRAINT acc_person_combopenperson_pkey PRIMARY KEY (id);


--
-- Name: acc_person_firstopen acc_person_firstopen_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_firstopen
    ADD CONSTRAINT acc_person_firstopen_pkey PRIMARY KEY (id);


--
-- Name: acc_person_lastaddr acc_person_lastaddr_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_lastaddr
    ADD CONSTRAINT acc_person_lastaddr_pkey PRIMARY KEY (id);


--
-- Name: acc_person acc_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person
    ADD CONSTRAINT acc_person_pkey PRIMARY KEY (id);


--
-- Name: acc_person_verifymoderule acc_person_verifymoderule_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_verifymoderule
    ADD CONSTRAINT acc_person_verifymoderule_pkey PRIMARY KEY (id);


--
-- Name: acc_reader_option acc_reader_option_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_reader_option
    ADD CONSTRAINT acc_reader_option_pkey PRIMARY KEY (id);


--
-- Name: acc_reader acc_reader_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_reader
    ADD CONSTRAINT acc_reader_pkey PRIMARY KEY (id);


--
-- Name: acc_timeseg_bid acc_timeseg_bid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_timeseg_bid
    ADD CONSTRAINT acc_timeseg_bid_pkey PRIMARY KEY (id);


--
-- Name: acc_timeseg acc_timeseg_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_timeseg
    ADD CONSTRAINT acc_timeseg_pkey PRIMARY KEY (id);


--
-- Name: acc_topdoor_by_person acc_topdoor_by_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_topdoor_by_person
    ADD CONSTRAINT acc_topdoor_by_person_pkey PRIMARY KEY (id);


--
-- Name: acc_transaction acc_transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_transaction
    ADD CONSTRAINT acc_transaction_pkey PRIMARY KEY (id);


--
-- Name: acc_verifymode_rule acc_verifymode_rule_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_verifymode_rule
    ADD CONSTRAINT acc_verifymode_rule_pkey PRIMARY KEY (id);


--
-- Name: adms_acc_device_log adms_acc_device_log_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_acc_device_log
    ADD CONSTRAINT adms_acc_device_log_pkey PRIMARY KEY (id);


--
-- Name: adms_att_device_log adms_att_device_log_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_att_device_log
    ADD CONSTRAINT adms_att_device_log_pkey PRIMARY KEY (id);


--
-- Name: adms_auth_device adms_auth_device_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_auth_device
    ADD CONSTRAINT adms_auth_device_pkey PRIMARY KEY (id);


--
-- Name: adms_cmd_id adms_cmd_id_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_cmd_id
    ADD CONSTRAINT adms_cmd_id_pkey PRIMARY KEY (id);


--
-- Name: adms_devcmd adms_devcmd_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_devcmd
    ADD CONSTRAINT adms_devcmd_pkey PRIMARY KEY (id);


--
-- Name: adms_device_option adms_device_option_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_device_option
    ADD CONSTRAINT adms_device_option_pkey PRIMARY KEY (id);


--
-- Name: adms_device adms_device_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_device
    ADD CONSTRAINT adms_device_pkey PRIMARY KEY (id);


--
-- Name: adms_pos_allow_log adms_pos_allow_log_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_pos_allow_log
    ADD CONSTRAINT adms_pos_allow_log_pkey PRIMARY KEY (id);


--
-- Name: adms_pos_buy_log adms_pos_buy_log_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_pos_buy_log
    ADD CONSTRAINT adms_pos_buy_log_pkey PRIMARY KEY (id);


--
-- Name: adms_pos_full_log adms_pos_full_log_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_pos_full_log
    ADD CONSTRAINT adms_pos_full_log_pkey PRIMARY KEY (id);


--
-- Name: adms_product adms_product_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_product
    ADD CONSTRAINT adms_product_pkey PRIMARY KEY (id);


--
-- Name: att_adjust att_adjust_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_adjust
    ADD CONSTRAINT att_adjust_pkey PRIMARY KEY (id);


--
-- Name: att_area_person att_area_person_area_pers; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_area_person
    ADD CONSTRAINT att_area_person_area_pers UNIQUE (auth_area_id, pers_person_id);


--
-- Name: att_area_person att_area_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_area_person
    ADD CONSTRAINT att_area_person_pkey PRIMARY KEY (id);


--
-- Name: att_autoexport att_autoexport_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_autoexport
    ADD CONSTRAINT att_autoexport_pkey PRIMARY KEY (id);


--
-- Name: att_break_time att_break_time_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_break_time
    ADD CONSTRAINT att_break_time_pkey PRIMARY KEY (id);


--
-- Name: att_class att_class_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_class
    ADD CONSTRAINT att_class_pkey PRIMARY KEY (id);


--
-- Name: att_custom_rule_org att_custom_rule_org_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_custom_rule_org
    ADD CONSTRAINT att_custom_rule_org_pkey PRIMARY KEY (id);


--
-- Name: att_custom_rule att_custom_rule_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_custom_rule
    ADD CONSTRAINT att_custom_rule_pkey PRIMARY KEY (id);


--
-- Name: att_cyclesch att_cyclesch_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_cyclesch
    ADD CONSTRAINT att_cyclesch_pkey PRIMARY KEY (id);


--
-- Name: att_cyclesch_shift att_cyclesch_shift_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_cyclesch_shift
    ADD CONSTRAINT att_cyclesch_shift_pkey PRIMARY KEY (cyclesch_id, shift_id);


--
-- Name: att_day_card_detail att_day_card_detail_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_day_card_detail
    ADD CONSTRAINT att_day_card_detail_pkey PRIMARY KEY (id);


--
-- Name: att_deptsch att_deptsch_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_deptsch
    ADD CONSTRAINT att_deptsch_pkey PRIMARY KEY (id);


--
-- Name: att_deptsch_shift att_deptsch_shift_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_deptsch_shift
    ADD CONSTRAINT att_deptsch_shift_pkey PRIMARY KEY (deptsch_id, shift_id);


--
-- Name: att_device_op_log att_device_op_log_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_device_op_log
    ADD CONSTRAINT att_device_op_log_pkey PRIMARY KEY (id);


--
-- Name: att_device_option att_device_option_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_device_option
    ADD CONSTRAINT att_device_option_pkey PRIMARY KEY (id);


--
-- Name: att_device att_device_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_device
    ADD CONSTRAINT att_device_pkey PRIMARY KEY (id);


--
-- Name: att_group_person att_group_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_group_person
    ADD CONSTRAINT att_group_person_pkey PRIMARY KEY (id);


--
-- Name: att_group att_group_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_group
    ADD CONSTRAINT att_group_pkey PRIMARY KEY (id);


--
-- Name: att_groupsch att_groupsch_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_groupsch
    ADD CONSTRAINT att_groupsch_pkey PRIMARY KEY (id);


--
-- Name: att_groupsch_shift att_groupsch_shift_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_groupsch_shift
    ADD CONSTRAINT att_groupsch_shift_pkey PRIMARY KEY (groupsch_id, shift_id);


--
-- Name: att_holiday att_holiday_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_holiday
    ADD CONSTRAINT att_holiday_pkey PRIMARY KEY (id);


--
-- Name: att_leave att_leave_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_leave
    ADD CONSTRAINT att_leave_pkey PRIMARY KEY (id);


--
-- Name: att_leavetype att_leavetype_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_leavetype
    ADD CONSTRAINT att_leavetype_pkey PRIMARY KEY (id);


--
-- Name: att_out att_out_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_out
    ADD CONSTRAINT att_out_pkey PRIMARY KEY (id);


--
-- Name: att_overtime att_overtime_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_overtime
    ADD CONSTRAINT att_overtime_pkey PRIMARY KEY (id);


--
-- Name: att_person att_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_person
    ADD CONSTRAINT att_person_pkey PRIMARY KEY (id);


--
-- Name: att_personsch att_personsch_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_personsch
    ADD CONSTRAINT att_personsch_pkey PRIMARY KEY (id);


--
-- Name: att_personsch_shift att_personsch_shift_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_personsch_shift
    ADD CONSTRAINT att_personsch_shift_pkey PRIMARY KEY (shift_id, personsch_id);


--
-- Name: att_point att_point_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_point
    ADD CONSTRAINT att_point_pkey PRIMARY KEY (id);


--
-- Name: att_record att_record_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_record
    ADD CONSTRAINT att_record_pkey PRIMARY KEY (id);


--
-- Name: att_shift att_shift_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_shift
    ADD CONSTRAINT att_shift_pkey PRIMARY KEY (id);


--
-- Name: att_shift_timeslot att_shift_timeslot_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_shift_timeslot
    ADD CONSTRAINT att_shift_timeslot_pkey PRIMARY KEY (shift_id, timeslot_id);


--
-- Name: att_sign_address_area att_sign_address_area_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_sign_address_area
    ADD CONSTRAINT att_sign_address_area_pkey PRIMARY KEY (id);


--
-- Name: att_sign_address att_sign_address_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_sign_address
    ADD CONSTRAINT att_sign_address_pkey PRIMARY KEY (id);


--
-- Name: att_sign att_sign_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_sign
    ADD CONSTRAINT att_sign_pkey PRIMARY KEY (id);


--
-- Name: att_tempsch att_tempsch_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_tempsch
    ADD CONSTRAINT att_tempsch_pkey PRIMARY KEY (id);


--
-- Name: att_tempsch_timeslot att_tempsch_timeslot_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_tempsch_timeslot
    ADD CONSTRAINT att_tempsch_timeslot_pkey PRIMARY KEY (tempsch_id, timeslot_id);


--
-- Name: att_timeslot_breaktime att_timeslot_breaktime_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_timeslot_breaktime
    ADD CONSTRAINT att_timeslot_breaktime_pkey PRIMARY KEY (breaktime_id, timeslot_id);


--
-- Name: att_timeslot att_timeslot_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_timeslot
    ADD CONSTRAINT att_timeslot_pkey PRIMARY KEY (id);


--
-- Name: att_timing att_timing_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_timing
    ADD CONSTRAINT att_timing_pkey PRIMARY KEY (id);


--
-- Name: att_transaction att_transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_transaction
    ADD CONSTRAINT att_transaction_pkey PRIMARY KEY (id);


--
-- Name: att_trip att_trip_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_trip
    ADD CONSTRAINT att_trip_pkey PRIMARY KEY (id);


--
-- Name: auth_api_token auth_api_token_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_api_token
    ADD CONSTRAINT auth_api_token_pkey PRIMARY KEY (id);


--
-- Name: auth_app auth_app_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_app
    ADD CONSTRAINT auth_app_pkey PRIMARY KEY (id);


--
-- Name: auth_appmenus_children auth_appmenus_children_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_appmenus_children
    ADD CONSTRAINT auth_appmenus_children_pkey PRIMARY KEY (id);


--
-- Name: auth_appmenus auth_appmenus_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_appmenus
    ADD CONSTRAINT auth_appmenus_pkey PRIMARY KEY (id);


--
-- Name: auth_area auth_area_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_area
    ADD CONSTRAINT auth_area_pkey PRIMARY KEY (id);


--
-- Name: auth_biotemplate auth_biotemplate_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_biotemplate
    ADD CONSTRAINT auth_biotemplate_pkey PRIMARY KEY (id);


--
-- Name: auth_company auth_company_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_company
    ADD CONSTRAINT auth_company_pkey PRIMARY KEY (id);


--
-- Name: auth_department auth_department_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_department
    ADD CONSTRAINT auth_department_pkey PRIMARY KEY (id);


--
-- Name: auth_permission auth_permission_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_permission
    ADD CONSTRAINT auth_permission_pkey PRIMARY KEY (id);


--
-- Name: auth_role_permission auth_role_permission_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_role_permission
    ADD CONSTRAINT auth_role_permission_pkey PRIMARY KEY (auth_permission_id, auth_role_id);


--
-- Name: auth_role auth_role_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_role
    ADD CONSTRAINT auth_role_pkey PRIMARY KEY (id);


--
-- Name: auth_security_param auth_security_param_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_security_param
    ADD CONSTRAINT auth_security_param_pkey PRIMARY KEY (id);


--
-- Name: auth_user_area auth_user_area_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_area
    ADD CONSTRAINT auth_user_area_pkey PRIMARY KEY (auth_area_id, auth_user_id);


--
-- Name: auth_user_dept auth_user_dept_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_dept
    ADD CONSTRAINT auth_user_dept_pkey PRIMARY KEY (auth_dept_id, auth_user_id);


--
-- Name: auth_user auth_user_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user
    ADD CONSTRAINT auth_user_pkey PRIMARY KEY (id);


--
-- Name: auth_user_role auth_user_role_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_role
    ADD CONSTRAINT auth_user_role_pkey PRIMARY KEY (auth_role_id, auth_user_id);


--
-- Name: base_dbbackup base_dbbackup_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_dbbackup
    ADD CONSTRAINT base_dbbackup_pkey PRIMARY KEY (id);


--
-- Name: base_dictionary base_dictionary_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_dictionary
    ADD CONSTRAINT base_dictionary_pkey PRIMARY KEY (id);


--
-- Name: base_dictionary_value base_dictionary_value_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_dictionary_value
    ADD CONSTRAINT base_dictionary_value_pkey PRIMARY KEY (id);


--
-- Name: base_lang_res base_lang_res_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_lang_res
    ADD CONSTRAINT base_lang_res_pkey PRIMARY KEY (id);


--
-- Name: base_language base_language_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_language
    ADD CONSTRAINT base_language_pkey PRIMARY KEY (id);


--
-- Name: base_mail base_mail_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_mail
    ADD CONSTRAINT base_mail_pkey PRIMARY KEY (id);


--
-- Name: base_media_file base_media_file_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_media_file
    ADD CONSTRAINT base_media_file_pkey PRIMARY KEY (id);


--
-- Name: base_message base_message_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_message
    ADD CONSTRAINT base_message_pkey PRIMARY KEY (id);


--
-- Name: base_oplog base_oplog_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_oplog
    ADD CONSTRAINT base_oplog_pkey PRIMARY KEY (id);


--
-- Name: base_print_param base_print_param_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_print_param
    ADD CONSTRAINT base_print_param_pkey PRIMARY KEY (id);


--
-- Name: base_print_template base_print_template_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_print_template
    ADD CONSTRAINT base_print_template_pkey PRIMARY KEY (id);


--
-- Name: base_register base_register_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_register
    ADD CONSTRAINT base_register_pkey PRIMARY KEY (id);


--
-- Name: base_sysparam base_sysparam_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_sysparam
    ADD CONSTRAINT base_sysparam_pkey PRIMARY KEY (id);


--
-- Name: data_source data_source_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.data_source
    ADD CONSTRAINT data_source_pkey PRIMARY KEY (id);


--
-- Name: hep_autoexport hep_autoexport_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.hep_autoexport
    ADD CONSTRAINT hep_autoexport_pkey PRIMARY KEY (id);


--
-- Name: hep_transaction hep_transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.hep_transaction
    ADD CONSTRAINT hep_transaction_pkey PRIMARY KEY (id);


--
-- Name: pers_attribute_ext pers_attribute_ext_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_attribute_ext
    ADD CONSTRAINT pers_attribute_ext_pkey PRIMARY KEY (id);


--
-- Name: pers_attribute pers_attribute_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_attribute
    ADD CONSTRAINT pers_attribute_pkey PRIMARY KEY (id);


--
-- Name: pers_biotemplate pers_biotemplate_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_biotemplate
    ADD CONSTRAINT pers_biotemplate_pkey PRIMARY KEY (id);


--
-- Name: pers_card pers_card_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_card
    ADD CONSTRAINT pers_card_pkey PRIMARY KEY (id);


--
-- Name: pers_certificate pers_certificate_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_certificate
    ADD CONSTRAINT pers_certificate_pkey PRIMARY KEY (id);


--
-- Name: pers_biotemplate pers_id_type_ver_no_index_uq; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_biotemplate
    ADD CONSTRAINT pers_id_type_ver_no_index_uq UNIQUE (person_id, bio_type, version, template_no, template_no_index);


--
-- Name: pers_identity_card_info pers_identity_card_info_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_identity_card_info
    ADD CONSTRAINT pers_identity_card_info_pkey PRIMARY KEY (id);


--
-- Name: pers_issuecard pers_issuecard_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_issuecard
    ADD CONSTRAINT pers_issuecard_pkey PRIMARY KEY (id);


--
-- Name: pers_leaveperson pers_leaveperson_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_leaveperson
    ADD CONSTRAINT pers_leaveperson_pkey PRIMARY KEY (id);


--
-- Name: pers_person_link pers_person_link_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_person_link
    ADD CONSTRAINT pers_person_link_pkey PRIMARY KEY (id);


--
-- Name: pers_person pers_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_person
    ADD CONSTRAINT pers_person_pkey PRIMARY KEY (id);


--
-- Name: pers_personchange pers_personchange_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_personchange
    ADD CONSTRAINT pers_personchange_pkey PRIMARY KEY (id);


--
-- Name: pers_person_link pers_pid_type_link_id_uq; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_person_link
    ADD CONSTRAINT pers_pid_type_link_id_uq UNIQUE (person_id, type, link_id);


--
-- Name: pers_position pers_position_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_position
    ADD CONSTRAINT pers_position_pkey PRIMARY KEY (id);


--
-- Name: pers_temp_person pers_temp_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_temp_person
    ADD CONSTRAINT pers_temp_person_pkey PRIMARY KEY (id);


--
-- Name: pers_wiegandfmt_bid pers_wiegandfmt_bid_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_wiegandfmt_bid
    ADD CONSTRAINT pers_wiegandfmt_bid_pkey PRIMARY KEY (id);


--
-- Name: pers_wiegandfmt pers_wiegandfmt_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_wiegandfmt
    ADD CONSTRAINT pers_wiegandfmt_pkey PRIMARY KEY (id);


--
-- Name: system_client_info system_client_info_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.system_client_info
    ADD CONSTRAINT system_client_info_pkey PRIMARY KEY (id);


--
-- Name: system_module_info system_module_info_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.system_module_info
    ADD CONSTRAINT system_module_info_pkey PRIMARY KEY (id);


--
-- Name: pers_attribute uk_1ignxhqi9dks8htttog87lxgb; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_attribute
    ADD CONSTRAINT uk_1ignxhqi9dks8htttog87lxgb UNIQUE (attr_name);


--
-- Name: acc_combopen_person uk_1wv0p53g9b2yucywittx2kodi; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_person
    ADD CONSTRAINT uk_1wv0p53g9b2yucywittx2kodi UNIQUE (name);


--
-- Name: acc_combopen_door uk_45qg7eyjsse4du0iek4x935ih; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_door
    ADD CONSTRAINT uk_45qg7eyjsse4du0iek4x935ih UNIQUE (name);


--
-- Name: acc_ext_device uk_4a25gboc68vkyln9ust82g0m1; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_ext_device
    ADD CONSTRAINT uk_4a25gboc68vkyln9ust82g0m1 UNIQUE (alias);


--
-- Name: adms_device uk_4htmckwchmjk0jpqcr1jaudms; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_device
    ADD CONSTRAINT uk_4htmckwchmjk0jpqcr1jaudms UNIQUE (sn);


--
-- Name: acc_combopen_person uk_4nlhvlcg0rl27av22qg9uf0hl; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_person
    ADD CONSTRAINT uk_4nlhvlcg0rl27av22qg9uf0hl UNIQUE (business_id);


--
-- Name: vms_area uk_62fl6ar8mcrgpplsl54annj; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_area
    ADD CONSTRAINT uk_62fl6ar8mcrgpplsl54annj UNIQUE (vms_area);


--
-- Name: acc_transaction uk_6b0x8u1iijbubj0jol10j9hp9; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_transaction
    ADD CONSTRAINT uk_6b0x8u1iijbubj0jol10j9hp9 UNIQUE (unique_key);


--
-- Name: adms_auth_device uk_6mxpbo7wi85ohfvq3d3mqthp2; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_auth_device
    ADD CONSTRAINT uk_6mxpbo7wi85ohfvq3d3mqthp2 UNIQUE (sn);


--
-- Name: pers_person uk_9978vgq9hn4maey4p7qgeveuu; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_person
    ADD CONSTRAINT uk_9978vgq9hn4maey4p7qgeveuu UNIQUE (pin);


--
-- Name: acc_interlock uk_a9ndse24x6wt65yb3nxhl18a9; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_interlock
    ADD CONSTRAINT uk_a9ndse24x6wt65yb3nxhl18a9 UNIQUE (dev_id);


--
-- Name: pers_attribute_ext uk_bj1elop932qr3tapsa9mvwbfb; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_attribute_ext
    ADD CONSTRAINT uk_bj1elop932qr3tapsa9mvwbfb UNIQUE (person_id);


--
-- Name: adms_devcmd uk_cierhu13xc1fnkjk0x4q6a3e5; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_devcmd
    ADD CONSTRAINT uk_cierhu13xc1fnkjk0x4q6a3e5 UNIQUE (cmd_id);


--
-- Name: vms_device uk_d2763vekyoaccyl0i01mftve7; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_device
    ADD CONSTRAINT uk_d2763vekyoaccyl0i01mftve7 UNIQUE (sn);


--
-- Name: acc_device uk_d8a4xa2owwf0jqwujfuy6u792; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device
    ADD CONSTRAINT uk_d8a4xa2owwf0jqwujfuy6u792 UNIQUE (sn);


--
-- Name: acc_verifymode_rule uk_e6qhn2tjje3dfmm23qjoj84m7; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_verifymode_rule
    ADD CONSTRAINT uk_e6qhn2tjje3dfmm23qjoj84m7 UNIQUE (name);


--
-- Name: auth_appmenus_children uk_ep9nn3yiec9rr86ioj867av9d; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_appmenus_children
    ADD CONSTRAINT uk_ep9nn3yiec9rr86ioj867av9d UNIQUE (name);


--
-- Name: acc_device uk_fmtd6p858bsk1ji0fewp9abbt; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device
    ADD CONSTRAINT uk_fmtd6p858bsk1ji0fewp9abbt UNIQUE (business_id);


--
-- Name: base_sysparam uk_g08ppis9a0u7vpbj80ntlfgub; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_sysparam
    ADD CONSTRAINT uk_g08ppis9a0u7vpbj80ntlfgub UNIQUE (param_name);


--
-- Name: acc_combopen_door uk_h148fwstgj00d1wlt139h5h0h; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_door
    ADD CONSTRAINT uk_h148fwstgj00d1wlt139h5h0h UNIQUE (business_id);


--
-- Name: acc_timeseg uk_hfqc9813m08be9g0ux6iysii3; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_timeseg
    ADD CONSTRAINT uk_hfqc9813m08be9g0ux6iysii3 UNIQUE (business_id);


--
-- Name: adms_product uk_hnawxfb2d0g93j90kgjfoktqy; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_product
    ADD CONSTRAINT uk_hnawxfb2d0g93j90kgjfoktqy UNIQUE (product_key);


--
-- Name: base_print_template uk_ie7bwyfnnve31rn9rx18cx97e; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_print_template
    ADD CONSTRAINT uk_ie7bwyfnnve31rn9rx18cx97e UNIQUE (code);


--
-- Name: auth_appmenus uk_k7xpxqqlj7vauwkijm5jou30l; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_appmenus
    ADD CONSTRAINT uk_k7xpxqqlj7vauwkijm5jou30l UNIQUE (code);


--
-- Name: auth_role uk_k8dhmc0q3l9h59gv9gjeokib0; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_role
    ADD CONSTRAINT uk_k8dhmc0q3l9h59gv9gjeokib0 UNIQUE (code);


--
-- Name: vms_user uk_khcsnnhb4huw25s64heqqf4v4; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_user
    ADD CONSTRAINT uk_khcsnnhb4huw25s64heqqf4v4 UNIQUE (vms_username);


--
-- Name: auth_role uk_lc1sij60969nsgl5cy8bfgbsm; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_role
    ADD CONSTRAINT uk_lc1sij60969nsgl5cy8bfgbsm UNIQUE (name);


--
-- Name: att_device uk_lecu7g79dnliep6acav6syi2k; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_device
    ADD CONSTRAINT uk_lecu7g79dnliep6acav6syi2k UNIQUE (dev_sn);


--
-- Name: adms_product uk_prajknbeu36wyvs24gow7ke4; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_product
    ADD CONSTRAINT uk_prajknbeu36wyvs24gow7ke4 UNIQUE (name);


--
-- Name: acc_linkage uk_s23p1gv638qvvrmvuir9wo734; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage
    ADD CONSTRAINT uk_s23p1gv638qvvrmvuir9wo734 UNIQUE (name);


--
-- Name: auth_permission uk_somba37al7jncqwbq818vx13e; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_permission
    ADD CONSTRAINT uk_somba37al7jncqwbq818vx13e UNIQUE (code);


--
-- Name: base_dictionary uk_t12cl0q8u2dybvlcqrprd5o4x; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_dictionary
    ADD CONSTRAINT uk_t12cl0q8u2dybvlcqrprd5o4x UNIQUE (code);


--
-- Name: auth_user uk_t1iph3dfc25ukwcl9xemtnojn; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user
    ADD CONSTRAINT uk_t1iph3dfc25ukwcl9xemtnojn UNIQUE (username);


--
-- Name: auth_biotemplate ukmre3ab7lhqg077xv3hil86drs; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_biotemplate
    ADD CONSTRAINT ukmre3ab7lhqg077xv3hil86drs UNIQUE (user_id, bio_type, version, template_no);


--
-- Name: vms_area vms_area_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_area
    ADD CONSTRAINT vms_area_pkey PRIMARY KEY (id);


--
-- Name: vms_blackwhite_person vms_blackwhite_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_blackwhite_person
    ADD CONSTRAINT vms_blackwhite_person_pkey PRIMARY KEY (id);


--
-- Name: vms_blackwhite vms_blackwhite_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_blackwhite
    ADD CONSTRAINT vms_blackwhite_pkey PRIMARY KEY (id);


--
-- Name: vms_capture vms_capture_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_capture
    ADD CONSTRAINT vms_capture_pkey PRIMARY KEY (id);


--
-- Name: vms_channel2entity vms_channel2entity_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_channel2entity
    ADD CONSTRAINT vms_channel2entity_pkey PRIMARY KEY (id);


--
-- Name: vms_channel vms_channel_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_channel
    ADD CONSTRAINT vms_channel_pkey PRIMARY KEY (id);


--
-- Name: vms_device vms_device_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_device
    ADD CONSTRAINT vms_device_pkey PRIMARY KEY (id);


--
-- Name: vms_distribute vms_distribute_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_distribute
    ADD CONSTRAINT vms_distribute_pkey PRIMARY KEY (id);


--
-- Name: vms_distribute_record vms_distribute_record_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_distribute_record
    ADD CONSTRAINT vms_distribute_record_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_accout vms_globallinkage_accout_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_accout
    ADD CONSTRAINT vms_globallinkage_accout_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_eleout vms_globallinkage_eleout_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_eleout
    ADD CONSTRAINT vms_globallinkage_eleout_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_in vms_globallinkage_in_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_in
    ADD CONSTRAINT vms_globallinkage_in_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_media vms_globallinkage_media_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_media
    ADD CONSTRAINT vms_globallinkage_media_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_person vms_globallinkage_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_person
    ADD CONSTRAINT vms_globallinkage_person_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage vms_globallinkage_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage
    ADD CONSTRAINT vms_globallinkage_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_trigger vms_globallinkage_trigger_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_trigger
    ADD CONSTRAINT vms_globallinkage_trigger_pkey PRIMARY KEY (id);


--
-- Name: vms_globallinkage_vidout vms_globallinkage_vidout_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_vidout
    ADD CONSTRAINT vms_globallinkage_vidout_pkey PRIMARY KEY (id);


--
-- Name: vms_link vms_link_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_link
    ADD CONSTRAINT vms_link_pkey PRIMARY KEY (id);


--
-- Name: vms_linkage_event vms_linkage_event_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_linkage_event
    ADD CONSTRAINT vms_linkage_event_pkey PRIMARY KEY (id);


--
-- Name: vms_monotoring vms_monotoring_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_monotoring
    ADD CONSTRAINT vms_monotoring_pkey PRIMARY KEY (id);


--
-- Name: vms_person vms_person_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_person
    ADD CONSTRAINT vms_person_pkey PRIMARY KEY (id);


--
-- Name: vms_report vms_report_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_report
    ADD CONSTRAINT vms_report_pkey PRIMARY KEY (id);


--
-- Name: vms_search_image vms_search_image_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_search_image
    ADD CONSTRAINT vms_search_image_pkey PRIMARY KEY (id);


--
-- Name: vms_transaction vms_transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_transaction
    ADD CONSTRAINT vms_transaction_pkey PRIMARY KEY (id);


--
-- Name: vms_user vms_user_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_user
    ADD CONSTRAINT vms_user_pkey PRIMARY KEY (id);


--
-- Name: vms_videointercom_transaction vms_videointercom_transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_videointercom_transaction
    ADD CONSTRAINT vms_videointercom_transaction_pkey PRIMARY KEY (id);


--
-- Name: acc_transaction_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX acc_transaction_crt_idx ON public.acc_transaction USING btree (create_time);


--
-- Name: acc_transaction_evt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX acc_transaction_evt_idx ON public.acc_transaction USING btree (event_time);


--
-- Name: acc_transaction_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX acc_transaction_upt_idx ON public.acc_transaction USING btree (update_time);


--
-- Name: adms_devcmd_create_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX adms_devcmd_create_time_idx ON public.adms_devcmd USING btree (create_time);


--
-- Name: adms_devcmd_update_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX adms_devcmd_update_time_idx ON public.adms_devcmd USING btree (update_time);


--
-- Name: att_ar_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_ar_crt_idx ON public.att_area_person USING btree (create_time);


--
-- Name: att_ar_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_ar_upt_idx ON public.att_area_person USING btree (update_time);


--
-- Name: att_day_card_att_date_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_day_card_att_date_idx ON public.att_day_card_detail USING btree (att_date);


--
-- Name: att_day_card_dept_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_day_card_dept_id_idx ON public.att_day_card_detail USING btree (auth_dept_id);


--
-- Name: att_day_card_person_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_day_card_person_pin_idx ON public.att_day_card_detail USING btree (pers_person_pin);


--
-- Name: att_device_op_log_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_device_op_log_crt_idx ON public.att_device_op_log USING btree (create_time);


--
-- Name: att_device_op_log_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_device_op_log_upt_idx ON public.att_device_op_log USING btree (update_time);


--
-- Name: att_pers_dept_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_pers_dept_id_idx ON public.att_person USING btree (auth_dept_id);


--
-- Name: att_pers_group_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_pers_group_id_idx ON public.att_person USING btree (group_id);


--
-- Name: att_pers_person_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_pers_person_id_idx ON public.att_person USING btree (pers_person_id);


--
-- Name: att_pers_person_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_pers_person_pin_idx ON public.att_person USING btree (pers_person_pin);


--
-- Name: att_record_att_date_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_record_att_date_idx ON public.att_record USING btree (att_date);


--
-- Name: att_record_dept_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_record_dept_id_idx ON public.att_record USING btree (auth_dept_id);


--
-- Name: att_record_pers_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_record_pers_pin_idx ON public.att_record USING btree (pers_person_pin);


--
-- Name: att_tran_att_date_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_tran_att_date_idx ON public.att_transaction USING btree (att_date);


--
-- Name: att_tran_dept_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_tran_dept_id_idx ON public.att_transaction USING btree (auth_dept_id);


--
-- Name: att_tran_device_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_tran_device_id_idx ON public.att_transaction USING btree (device_sn);


--
-- Name: att_tran_pin_datetime_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX att_tran_pin_datetime_idx ON public.att_transaction USING btree (pers_person_pin, att_datetime);


--
-- Name: auth_app_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_app_crt_idx ON public.auth_app USING btree (create_time);


--
-- Name: auth_app_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_app_upt_idx ON public.auth_app USING btree (update_time);


--
-- Name: auth_area_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_area_crt_idx ON public.auth_area USING btree (create_time);


--
-- Name: auth_area_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_area_upt_idx ON public.auth_area USING btree (update_time);


--
-- Name: auth_company_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_company_crt_idx ON public.auth_company USING btree (create_time);


--
-- Name: auth_company_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_company_upt_idx ON public.auth_company USING btree (update_time);


--
-- Name: auth_department_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_department_crt_idx ON public.auth_department USING btree (create_time);


--
-- Name: auth_department_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_department_upt_idx ON public.auth_department USING btree (update_time);


--
-- Name: auth_permission_crt_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_permission_crt_time_idx ON public.auth_permission USING btree (create_time);


--
-- Name: auth_permission_upt_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_permission_upt_time_idx ON public.auth_permission USING btree (update_time);


--
-- Name: auth_role_crt_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_role_crt_time_idx ON public.auth_role USING btree (create_time);


--
-- Name: auth_role_upt_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_role_upt_time_idx ON public.auth_role USING btree (update_time);


--
-- Name: auth_user_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_user_crt_idx ON public.auth_user USING btree (create_time);


--
-- Name: auth_user_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX auth_user_upt_idx ON public.auth_user USING btree (update_time);


--
-- Name: base_oplog_create_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX base_oplog_create_time_idx ON public.base_oplog USING btree (create_time);


--
-- Name: base_oplog_update_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX base_oplog_update_time_idx ON public.base_oplog USING btree (update_time);


--
-- Name: hep_transaction_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX hep_transaction_crt_idx ON public.hep_transaction USING btree (create_time);


--
-- Name: hep_transaction_dept_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX hep_transaction_dept_idx ON public.hep_transaction USING btree (dept_code);


--
-- Name: hep_transaction_evd_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX hep_transaction_evd_idx ON public.hep_transaction USING btree (event_date);


--
-- Name: hep_transaction_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX hep_transaction_pin_idx ON public.hep_transaction USING btree (pin);


--
-- Name: hep_transaction_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX hep_transaction_upt_idx ON public.hep_transaction USING btree (update_time);


--
-- Name: pers_attr_ext_create_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_attr_ext_create_time_idx ON public.pers_attribute_ext USING btree (create_time);


--
-- Name: pers_attribute_attr_name_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_attribute_attr_name_idx ON public.pers_attribute USING btree (attr_name);


--
-- Name: pers_bio_template_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_bio_template_pin_idx ON public.pers_biotemplate USING btree (person_pin);


--
-- Name: pers_card_create_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_card_create_time_idx ON public.pers_card USING btree (create_time);


--
-- Name: pers_card_no_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_card_no_idx ON public.pers_card USING btree (card_no);


--
-- Name: pers_card_person_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_card_person_id_idx ON public.pers_card USING btree (person_id);


--
-- Name: pers_card_person_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_card_person_pin_idx ON public.pers_card USING btree (person_pin);


--
-- Name: pers_card_update_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_card_update_time_idx ON public.pers_card USING btree (update_time);


--
-- Name: pers_identity_card_idcard_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_identity_card_idcard_idx ON public.pers_identity_card_info USING btree (id_card);


--
-- Name: pers_leaveperson_dept_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_leaveperson_dept_id_idx ON public.pers_leaveperson USING btree (auth_dept_id);


--
-- Name: pers_leaveperson_name_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_leaveperson_name_idx ON public.pers_leaveperson USING btree (name);


--
-- Name: pers_leaveperson_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_leaveperson_pin_idx ON public.pers_leaveperson USING btree (pin);


--
-- Name: pers_link_create_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_link_create_time_idx ON public.pers_person_link USING btree (create_time);


--
-- Name: pers_logical_card_no_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_logical_card_no_idx ON public.pers_card USING btree (logical_card_no);


--
-- Name: pers_person_create_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_person_create_time_idx ON public.pers_person USING btree (create_time);


--
-- Name: pers_person_dept_id_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_person_dept_id_idx ON public.pers_person USING btree (auth_dept_id);


--
-- Name: pers_person_name_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_person_name_idx ON public.pers_person USING btree (name);


--
-- Name: pers_person_pin_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_person_pin_idx ON public.pers_person USING btree (pin);


--
-- Name: pers_person_update_time_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_person_update_time_idx ON public.pers_person USING btree (update_time);


--
-- Name: pers_physical_no_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX pers_physical_no_idx ON public.pers_identity_card_info USING btree (physical_no);


--
-- Name: vms_link_crt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX vms_link_crt_idx ON public.vms_link USING btree (create_time);


--
-- Name: vms_link_upt_idx; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX vms_link_upt_idx ON public.vms_link USING btree (update_time);


--
-- Name: auth_user_dept fk17gxgrsc0fh91kbarbwdhr3fp; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_dept
    ADD CONSTRAINT fk17gxgrsc0fh91kbarbwdhr3fp FOREIGN KEY (auth_dept_id) REFERENCES public.auth_department(id);


--
-- Name: pers_certificate fk1gmovwx4rytre52uyitjevjam; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_certificate
    ADD CONSTRAINT fk1gmovwx4rytre52uyitjevjam FOREIGN KEY (person_id) REFERENCES public.pers_person(id);


--
-- Name: acc_device_option fk284w6cip61mpimmfgh11dfhvp; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_option
    ADD CONSTRAINT fk284w6cip61mpimmfgh11dfhvp FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: acc_reader_option fk2sh3f9pm1s14wfdd2aqkoh4ac; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_reader_option
    ADD CONSTRAINT fk2sh3f9pm1s14wfdd2aqkoh4ac FOREIGN KEY (reader_id) REFERENCES public.acc_reader(id);


--
-- Name: acc_level_person fk3cscnldk4c7m3fn9mjvbacyon; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_person
    ADD CONSTRAINT fk3cscnldk4c7m3fn9mjvbacyon FOREIGN KEY (level_id) REFERENCES public.acc_level(id);


--
-- Name: vms_globallinkage_trigger fk3ej97t4tgwheuk3n4rr3qlps6; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_trigger
    ADD CONSTRAINT fk3ej97t4tgwheuk3n4rr3qlps6 FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: adms_device_option fk3vu767epp0m4l4plhyv2wseu6; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_device_option
    ADD CONSTRAINT fk3vu767epp0m4l4plhyv2wseu6 FOREIGN KEY (dev_id) REFERENCES public.adms_device(id);


--
-- Name: acc_map_pos fk41sbaug4prlkwnfajbxi2nm4e; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_map_pos
    ADD CONSTRAINT fk41sbaug4prlkwnfajbxi2nm4e FOREIGN KEY (map_id) REFERENCES public.acc_map(id);


--
-- Name: pers_personchange fk46f95ui8qika6f2dp65dekrm2; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_personchange
    ADD CONSTRAINT fk46f95ui8qika6f2dp65dekrm2 FOREIGN KEY (person_id) REFERENCES public.pers_person(id);


--
-- Name: acc_reader fk4amwipjfr1whp1qij3eoig8ss; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_reader
    ADD CONSTRAINT fk4amwipjfr1whp1qij3eoig8ss FOREIGN KEY (door_id) REFERENCES public.acc_door(id);


--
-- Name: att_cyclesch_shift fk4hp2s7odag0qrkytmwwpw03s8; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_cyclesch_shift
    ADD CONSTRAINT fk4hp2s7odag0qrkytmwwpw03s8 FOREIGN KEY (cyclesch_id) REFERENCES public.att_cyclesch(id);


--
-- Name: auth_user_area fk4jf35nor20xjx9csafgwsok1b; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_area
    ADD CONSTRAINT fk4jf35nor20xjx9csafgwsok1b FOREIGN KEY (auth_area_id) REFERENCES public.auth_area(id);


--
-- Name: att_deptsch_shift fk5d5qgvs1263b15p92w3a2bmh1; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_deptsch_shift
    ADD CONSTRAINT fk5d5qgvs1263b15p92w3a2bmh1 FOREIGN KEY (shift_id) REFERENCES public.att_shift(id);


--
-- Name: acc_combopen_comb fk5kmcm8ah8yq0qygso0fgkgq17; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_comb
    ADD CONSTRAINT fk5kmcm8ah8yq0qygso0fgkgq17 FOREIGN KEY (combopen_person_id) REFERENCES public.acc_combopen_person(id);


--
-- Name: att_timeslot_breaktime fk680qwdp44xp4f0r62lnav0tpv; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_timeslot_breaktime
    ADD CONSTRAINT fk680qwdp44xp4f0r62lnav0tpv FOREIGN KEY (timeslot_id) REFERENCES public.att_timeslot(id);


--
-- Name: acc_combopen_door fk6dsxivrxlaf4fjy1bokvdkgkd; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_door
    ADD CONSTRAINT fk6dsxivrxlaf4fjy1bokvdkgkd FOREIGN KEY (door_id) REFERENCES public.acc_door(id);


--
-- Name: att_timeslot_breaktime fk7dxil57g98naulbvb4iexuln5; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_timeslot_breaktime
    ADD CONSTRAINT fk7dxil57g98naulbvb4iexuln5 FOREIGN KEY (breaktime_id) REFERENCES public.att_break_time(id);


--
-- Name: acc_level_door fk7lcv6jt9umrqpoa8p214y71r4; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_door
    ADD CONSTRAINT fk7lcv6jt9umrqpoa8p214y71r4 FOREIGN KEY (door_id) REFERENCES public.acc_door(id);


--
-- Name: auth_role_permission fk7ndbee91kroysycq5ddjjnipn; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_role_permission
    ADD CONSTRAINT fk7ndbee91kroysycq5ddjjnipn FOREIGN KEY (auth_role_id) REFERENCES public.auth_role(id);


--
-- Name: acc_device_event fk7ujak66jah2h4uj5el9w2gbmn; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_event
    ADD CONSTRAINT fk7ujak66jah2h4uj5el9w2gbmn FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: att_tempsch_timeslot fk8ld2enouyl8uq95qs66xes7ga; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_tempsch_timeslot
    ADD CONSTRAINT fk8ld2enouyl8uq95qs66xes7ga FOREIGN KEY (tempsch_id) REFERENCES public.att_tempsch(id);


--
-- Name: acc_person_verifymoderule fk9fhwk15nfl40mdspl5s6ax0y4; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_verifymoderule
    ADD CONSTRAINT fk9fhwk15nfl40mdspl5s6ax0y4 FOREIGN KEY (acc_verifymoderule_id) REFERENCES public.acc_verifymode_rule(id);


--
-- Name: acc_linkage_index fk9gtnellqindkb4ax2lsdo66b2; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_index
    ADD CONSTRAINT fk9gtnellqindkb4ax2lsdo66b2 FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: base_lang_res fk9lkgvbb025ltfm0yj0sia736s; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_lang_res
    ADD CONSTRAINT fk9lkgvbb025ltfm0yj0sia736s FOREIGN KEY (lang_id) REFERENCES public.base_language(id);


--
-- Name: acc_auxout fk9xf46nfyn58l9mywf6dgnpris; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_auxout
    ADD CONSTRAINT fk9xf46nfyn58l9mywf6dgnpris FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: att_groupsch_shift fka0ejlkrjla6nd77q4udvspe54; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_groupsch_shift
    ADD CONSTRAINT fka0ejlkrjla6nd77q4udvspe54 FOREIGN KEY (groupsch_id) REFERENCES public.att_groupsch(id);


--
-- Name: pers_biotemplate fkahx9s0vyy2xo3krtcx8i7jn32; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_biotemplate
    ADD CONSTRAINT fkahx9s0vyy2xo3krtcx8i7jn32 FOREIGN KEY (person_id) REFERENCES public.pers_person(id);


--
-- Name: auth_permission fkbiyhkakl58d4fh1urfoya49hr; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_permission
    ADD CONSTRAINT fkbiyhkakl58d4fh1urfoya49hr FOREIGN KEY (auth_permission_parent_id) REFERENCES public.auth_permission(id);


--
-- Name: acc_device fkdfv0sd0sw96cqrr7w72eprqpg; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device
    ADD CONSTRAINT fkdfv0sd0sw96cqrr7w72eprqpg FOREIGN KEY (parent_id) REFERENCES public.acc_device(id);


--
-- Name: acc_linkage_trigger fkdmspf0x7clsj6xhfprd8fkvck; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_trigger
    ADD CONSTRAINT fkdmspf0x7clsj6xhfprd8fkvck FOREIGN KEY (linkage_id) REFERENCES public.acc_linkage(id);


--
-- Name: auth_user_area fkdui22g2jpmv5vj6q9rhnaxq0v; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_area
    ADD CONSTRAINT fkdui22g2jpmv5vj6q9rhnaxq0v FOREIGN KEY (auth_user_id) REFERENCES public.auth_user(id);


--
-- Name: acc_level_dept fke3ky6tbwc0d72kdnmqajkb9yc; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_dept
    ADD CONSTRAINT fke3ky6tbwc0d72kdnmqajkb9yc FOREIGN KEY (level_id) REFERENCES public.acc_level(id);


--
-- Name: base_dictionary_value fke5i41ofoctd1bw4fstp1myhk7; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_dictionary_value
    ADD CONSTRAINT fke5i41ofoctd1bw4fstp1myhk7 FOREIGN KEY (dict_id) REFERENCES public.base_dictionary(id);


--
-- Name: acc_auxin fkeg6f6ahwru2hcoxtpjiqiuqa6; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_auxin
    ADD CONSTRAINT fkeg6f6ahwru2hcoxtpjiqiuqa6 FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: vms_blackwhite_person fkeigl5q9ju27s175q5hqw4x4tl; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_blackwhite_person
    ADD CONSTRAINT fkeigl5q9ju27s175q5hqw4x4tl FOREIGN KEY (blackwhite_id) REFERENCES public.vms_blackwhite(id);


--
-- Name: att_tempsch_timeslot fkejj8qcnkvw957jcrt4bqncwk0; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_tempsch_timeslot
    ADD CONSTRAINT fkejj8qcnkvw957jcrt4bqncwk0 FOREIGN KEY (timeslot_id) REFERENCES public.att_timeslot(id);


--
-- Name: vms_globallinkage_media fkf4jv1b7l7tq0qcqgu0q4avtne; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_media
    ADD CONSTRAINT fkf4jv1b7l7tq0qcqgu0q4avtne FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: att_shift_timeslot fkf6qxseej811svj0g2utxxq2k7; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_shift_timeslot
    ADD CONSTRAINT fkf6qxseej811svj0g2utxxq2k7 FOREIGN KEY (shift_id) REFERENCES public.att_shift(id);


--
-- Name: acc_level_door fkfg8k19rdvi7notbbdyjle2t2y; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_level_door
    ADD CONSTRAINT fkfg8k19rdvi7notbbdyjle2t2y FOREIGN KEY (level_id) REFERENCES public.acc_level(id);


--
-- Name: vms_globallinkage_accout fkflv6cuerum11v65sys27ic0iy; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_accout
    ADD CONSTRAINT fkflv6cuerum11v65sys27ic0iy FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: acc_linkage_vid fkfone9gvjojx15lbci28somsvc; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_vid
    ADD CONSTRAINT fkfone9gvjojx15lbci28somsvc FOREIGN KEY (linkage_id) REFERENCES public.acc_linkage(id);


--
-- Name: auth_appmenus_children fkh28dptlcb332ykrxim26nw64d; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_appmenus_children
    ADD CONSTRAINT fkh28dptlcb332ykrxim26nw64d FOREIGN KEY (app_menus_id) REFERENCES public.auth_appmenus(id);


--
-- Name: acc_firstopen fkhrwjmwsu6d5ljc5ihj1iecqst; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_firstopen
    ADD CONSTRAINT fkhrwjmwsu6d5ljc5ihj1iecqst FOREIGN KEY (door_id) REFERENCES public.acc_door(id);


--
-- Name: acc_person_combopenperson fki4pfqhd43k7b4308fioghmoav; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_combopenperson
    ADD CONSTRAINT fki4pfqhd43k7b4308fioghmoav FOREIGN KEY (acc_combopenperson_id) REFERENCES public.acc_combopen_person(id);


--
-- Name: vms_blackwhite_person fki5tu5q57edcmk4mxhxkrib8hm; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_blackwhite_person
    ADD CONSTRAINT fki5tu5q57edcmk4mxhxkrib8hm FOREIGN KEY (person_id) REFERENCES public.vms_person(id);


--
-- Name: att_personsch_shift fki92tc6tx126m4csk1ijxx4vku; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_personsch_shift
    ADD CONSTRAINT fki92tc6tx126m4csk1ijxx4vku FOREIGN KEY (personsch_id) REFERENCES public.att_personsch(id);


--
-- Name: acc_door fkij25hiqkmug371vrk8pb3mwl4; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_door
    ADD CONSTRAINT fkij25hiqkmug371vrk8pb3mwl4 FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: vms_linkage_event fkiqvvcjcumy0tohvf3y3idxmho; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_linkage_event
    ADD CONSTRAINT fkiqvvcjcumy0tohvf3y3idxmho FOREIGN KEY (transaction_id) REFERENCES public.vms_transaction(id);


--
-- Name: acc_linkage_media fkiuxeh5snl5j3ygabl9fd4qky6; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_media
    ADD CONSTRAINT fkiuxeh5snl5j3ygabl9fd4qky6 FOREIGN KEY (linkage_id) REFERENCES public.acc_linkage(id);


--
-- Name: vms_channel2entity fkjf895mds6stgcco75dbl8sr5i; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_channel2entity
    ADD CONSTRAINT fkjf895mds6stgcco75dbl8sr5i FOREIGN KEY (channel_id) REFERENCES public.vms_channel(id);


--
-- Name: acc_device_verifymode fkjqnhk2bud84vch8elqefsfois; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device_verifymode
    ADD CONSTRAINT fkjqnhk2bud84vch8elqefsfois FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: base_print_param fkkmfyytipp8qn4swj3tgsegaym; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.base_print_param
    ADD CONSTRAINT fkkmfyytipp8qn4swj3tgsegaym FOREIGN KEY (template_id) REFERENCES public.base_print_template(id);


--
-- Name: att_cyclesch_shift fkkpv75b1011mwgbf84gux2w7l6; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_cyclesch_shift
    ADD CONSTRAINT fkkpv75b1011mwgbf84gux2w7l6 FOREIGN KEY (shift_id) REFERENCES public.att_shift(id);


--
-- Name: auth_user_dept fkl61mxxa2rq36amgudy9yey1xc; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_dept
    ADD CONSTRAINT fkl61mxxa2rq36amgudy9yey1xc FOREIGN KEY (auth_user_id) REFERENCES public.auth_user(id);


--
-- Name: att_deptsch_shift fkmcdcas14atbtx0dklty112i3n; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_deptsch_shift
    ADD CONSTRAINT fkmcdcas14atbtx0dklty112i3n FOREIGN KEY (deptsch_id) REFERENCES public.att_deptsch(id);


--
-- Name: auth_user_role fkn1lpth3d429d22yj3g9eg7743; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_role
    ADD CONSTRAINT fkn1lpth3d429d22yj3g9eg7743 FOREIGN KEY (auth_role_id) REFERENCES public.auth_role(id);


--
-- Name: acc_combopen_comb fkn1w5dr14cj4pn3dg1at2o2weu; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_combopen_comb
    ADD CONSTRAINT fkn1w5dr14cj4pn3dg1at2o2weu FOREIGN KEY (combopen_door_id) REFERENCES public.acc_combopen_door(id);


--
-- Name: acc_device fknip2dv63uttxi4tvqehuy0abg; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_device
    ADD CONSTRAINT fknip2dv63uttxi4tvqehuy0abg FOREIGN KEY (dstime_id) REFERENCES public.acc_dstime(id);


--
-- Name: adms_device fknjhdx30g2xkxl2tr1shxcjtk5; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.adms_device
    ADD CONSTRAINT fknjhdx30g2xkxl2tr1shxcjtk5 FOREIGN KEY (parent_id) REFERENCES public.adms_device(id);


--
-- Name: att_groupsch_shift fknqdmd20fhmwfvb1h9mc4pfeqq; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_groupsch_shift
    ADD CONSTRAINT fknqdmd20fhmwfvb1h9mc4pfeqq FOREIGN KEY (shift_id) REFERENCES public.att_shift(id);


--
-- Name: acc_linkage_trigger fko9nvqkyikti9xtsje95siqj7c; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_trigger
    ADD CONSTRAINT fko9nvqkyikti9xtsje95siqj7c FOREIGN KEY (linkage_inout_id) REFERENCES public.acc_linkage_inout(id);


--
-- Name: vms_globallinkage_person fkohaj0da1tgythvljmu58y40qd; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_person
    ADD CONSTRAINT fkohaj0da1tgythvljmu58y40qd FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: acc_person_firstopen fkow6oed0lc55057irhs9x2lxw6; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_person_firstopen
    ADD CONSTRAINT fkow6oed0lc55057irhs9x2lxw6 FOREIGN KEY (acc_firstopen_id) REFERENCES public.acc_firstopen(id);


--
-- Name: att_personsch_shift fkox5iyumivlae2y9kxvrpr4nvk; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_personsch_shift
    ADD CONSTRAINT fkox5iyumivlae2y9kxvrpr4nvk FOREIGN KEY (shift_id) REFERENCES public.att_shift(id);


--
-- Name: acc_antipassback fkp2b9odgd8fkun25eukytc14mn; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_antipassback
    ADD CONSTRAINT fkp2b9odgd8fkun25eukytc14mn FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: vms_globallinkage_vidout fkp5ksu8k9ybsfcovddv0q4qgij; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_vidout
    ADD CONSTRAINT fkp5ksu8k9ybsfcovddv0q4qgij FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: acc_linkage fkpte45lm1favcr54897ssfv355; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage
    ADD CONSTRAINT fkpte45lm1favcr54897ssfv355 FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: auth_user_role fkptn1b1vvejcvel3tq402eyl2c; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_user_role
    ADD CONSTRAINT fkptn1b1vvejcvel3tq402eyl2c FOREIGN KEY (auth_user_id) REFERENCES public.auth_user(id);


--
-- Name: acc_linkage_inout fkpww2ns8jcovujs8py6jkjmgm3; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_linkage_inout
    ADD CONSTRAINT fkpww2ns8jcovujs8py6jkjmgm3 FOREIGN KEY (linkage_id) REFERENCES public.acc_linkage(id);


--
-- Name: auth_area fkpybeg1491dud0gkk77rrhboty; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_area
    ADD CONSTRAINT fkpybeg1491dud0gkk77rrhboty FOREIGN KEY (parent_id) REFERENCES public.auth_area(id);


--
-- Name: pers_person fkq4iq5nbcea2g13jur5yanjouf; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_person
    ADD CONSTRAINT fkq4iq5nbcea2g13jur5yanjouf FOREIGN KEY (position_id) REFERENCES public.pers_position(id);


--
-- Name: auth_role_permission fkqgnjvxbqwtepqgvy9bgh37t6p; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_role_permission
    ADD CONSTRAINT fkqgnjvxbqwtepqgvy9bgh37t6p FOREIGN KEY (auth_permission_id) REFERENCES public.auth_permission(id);


--
-- Name: pers_position fkqm2361yu1rkpvd9a7i8wyw6fm; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.pers_position
    ADD CONSTRAINT fkqm2361yu1rkpvd9a7i8wyw6fm FOREIGN KEY (parent_id) REFERENCES public.pers_position(id);


--
-- Name: acc_verifymode_rule fkqnktyyt9infpsdw0p8n1e46mj; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_verifymode_rule
    ADD CONSTRAINT fkqnktyyt9infpsdw0p8n1e46mj FOREIGN KEY (timeseg_id) REFERENCES public.acc_timeseg(id);


--
-- Name: vms_channel fkr16j0u4qgop5xsngbht2ck63a; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_channel
    ADD CONSTRAINT fkr16j0u4qgop5xsngbht2ck63a FOREIGN KEY (dev_id) REFERENCES public.vms_device(id);


--
-- Name: acc_door_verifymoderule fkr1yxqg0q4d8duyo5mn35kx468; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_door_verifymoderule
    ADD CONSTRAINT fkr1yxqg0q4d8duyo5mn35kx468 FOREIGN KEY (acc_door_id) REFERENCES public.acc_door(id);


--
-- Name: auth_department fkr3a1jtk03b8b186kpwqsvu6qc; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_department
    ADD CONSTRAINT fkr3a1jtk03b8b186kpwqsvu6qc FOREIGN KEY (parent_id) REFERENCES public.auth_department(id);


--
-- Name: att_device_option fkr5dehf9o8in0r46a77porhwl1; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_device_option
    ADD CONSTRAINT fkr5dehf9o8in0r46a77porhwl1 FOREIGN KEY (dev_id) REFERENCES public.att_device(id);


--
-- Name: vms_globallinkage_eleout fkragkh17cs90hgcb8vkj1j4fje; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_eleout
    ADD CONSTRAINT fkragkh17cs90hgcb8vkj1j4fje FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: vms_globallinkage_in fkrkxsjv61nmnaxr9qmh2w3ab7m; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.vms_globallinkage_in
    ADD CONSTRAINT fkrkxsjv61nmnaxr9qmh2w3ab7m FOREIGN KEY (linkage_id) REFERENCES public.vms_globallinkage(id);


--
-- Name: acc_door_verifymoderule fks5y3m56mipy09659u342htk2d; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_door_verifymoderule
    ADD CONSTRAINT fks5y3m56mipy09659u342htk2d FOREIGN KEY (acc_verifymoderule_id) REFERENCES public.acc_verifymode_rule(id);


--
-- Name: auth_biotemplate fks8w7jafwatmi8r30drn7s8xbq; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.auth_biotemplate
    ADD CONSTRAINT fks8w7jafwatmi8r30drn7s8xbq FOREIGN KEY (user_id) REFERENCES public.auth_user(id);


--
-- Name: att_shift_timeslot fksurpmhjfwcbxtfc4fx5k8qubl; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.att_shift_timeslot
    ADD CONSTRAINT fksurpmhjfwcbxtfc4fx5k8qubl FOREIGN KEY (timeslot_id) REFERENCES public.att_timeslot(id);


--
-- Name: acc_interlock fkwfqvs3co837rh43gp3gvntqg; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.acc_interlock
    ADD CONSTRAINT fkwfqvs3co837rh43gp3gvntqg FOREIGN KEY (dev_id) REFERENCES public.acc_device(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: admin
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

