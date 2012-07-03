SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;


CREATE SEQUENCE user_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE "user" (
    id			bigint PRIMARY KEY DEFAULT nextval('user_id'::regclass) NOT NULL,
    name		character varying(64) NOT NULL,
    surname		character varying(64) NOT NULL,
    email		character varying(128) NOT NULL,
    username	character varying(64) NOT NULL,
    password	character varying(32) NOT NULL
);


CREATE SEQUENCE offer_type_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE offer_type (
    id		bigint PRIMARY KEY DEFAULT nextval('offer_type_id'::regclass) NOT NULL,
    name	character varying(32) NOT NULL
);



CREATE SEQUENCE property_type_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE property_type (
    id		bigint PRIMARY KEY DEFAULT nextval('property_type_id'::regclass) NOT NULL
    name	character varying(32) NOT NULL
);


CREATE SEQUENCE property_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE property (
    id			bigint PRIMARY KEY DEFAULT nextval('property_id'::regclass) NOT NULL,
    name		character varying(128) NOT NULL,
    description character varying(512),
    price		numeric(10,2) NULL,
    user_id				bigint NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    property_type_id	bigint NOT NULL REFERENCES property_type(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    offer_type_id		bigint NOT NULL REFERENCES offer_type(id) ON UPDATE CASCADE ON DELETE RESTRICT
);
CREATE INDEX property_user_id_idx ON property USING btree (user_id);
CREATE INDEX property_type_id_idx ON property USING btree (property_type_id);
CREATE INDEX property_offer_id_idx ON property USING btree (offer_type_id);


CREATE SEQUENCE unit_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE unit (
    id		bigint PRIMARY KEY DEFAULT nextval('unit_id'::regclass) NOT NULL,
    name	character varying(32) NOT NULL
);


CREATE SEQUENCE feature_type_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE feature_type (
    id		bigint PRIMARY KEY DEFAULT nextval('feature_type_id'::regclass) NOT NULL,
    name	character varying(32) NOT NULL,
    unit_id bigint NULL REFERENCES unit(id) ON UPDATE CASCADE ON DELETE SET NULL
);
CREATE INDEX feature_type_unit_id_idx ON feature_type USING btree (unit_id);


CREATE SEQUENCE feature_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE feature (
    id bigint	PRIMARY KEY DEFAULT nextval('feature_id'::regclass) NOT NULL,
    content		character varying(128),
    value		numeric(20,2),
    type_id		bigint NOT NULL REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE CASCADE,
    property_id bigint NOT NULL REFERENCES property(id) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE INDEX feature_property_id_idx ON feature USING btree (property_id);
CREATE INDEX feature_type_id_idx ON feature USING btree (type_id);




--
-- PostgreSQL database dump complete
--



-- CREATE SEQUENCE language_id
--     START WITH 1
--     INCREMENT BY 1
--     NO MINVALUE
--     NO MAXVALUE
--     CACHE 1;
--
-- CREATE TABLE language (
--     id bigint DEFAULT nextval('feature_type_id'::regclass) NOT NULL,
--     name character varying(32) NOT NULL,
-- );
