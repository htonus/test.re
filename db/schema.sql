SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;


CREATE SEQUENCE city_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE "city" (
    id 			BIGINT PRIMARY KEY DEFAULT nextval('city_id'::regclass) NOT NULL,
    name 		VARCHAR(64) NOT NULL,
	latitude 	NUMERIC(10,4) NULL,
	longitude 	NUMERIC(10,4) NULL,
	parent_id 	BIGINT NULL REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE SEQUENCE user_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE "user" ( 
    id 			BIGINT PRIMARY KEY DEFAULT nextval('user_id'::regclass) NOT NULL, 
    "name"		VARCHAR(64) NOT NULL, 
    "surname" 	VARCHAR(64) NULL, 
    "email" 	VARCHAR(128) NOT NULL, 
    "password" 	VARCHAR(40) NULL, 
	"phone"		CHARACTER VARYING(64) NULL, 
	"created"	TIMESTAMP NOT NULL DEFAULT now(), 
	"activated" TIMESTAMP NULL, 
	"code"		CHARACTER VARYING(32) NULL, 
	"auto_login" CHARACTER VARYING(32) NULL 
);
CREATE UNIQUE INDEX user_email_uidx ON "user"(email); 
CREATE UNIQUE INDEX user_code_uidx ON "user"(code); 


CREATE SEQUENCE offer_type_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE offer_type (
    id		BIGINT PRIMARY KEY DEFAULT nextval('offer_type_id'::regclass) NOT NULL,
    name	VARCHAR(32) NOT NULL
);



CREATE SEQUENCE property_type_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE property_type (
    id		BIGINT PRIMARY KEY DEFAULT nextval('property_type_id'::regclass) NOT NULL,
    name	VARCHAR(32) NOT NULL
);


CREATE SEQUENCE property_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE property (
    id			BIGINT PRIMARY KEY DEFAULT nextval('property_id'::regclass) NOT NULL,
    name		VARCHAR(128) NOT NULL,
    description VARCHAR(512),
    user_id				BIGINT NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    property_type_id	BIGINT NOT NULL REFERENCES property_type(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    offer_type_id		BIGINT NOT NULL REFERENCES offer_type(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    city_id				BIGINT NOT NULL REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT
);
CREATE INDEX property_user_id_idx ON property USING btree (user_id);
CREATE INDEX property_type_id_idx ON property USING btree (property_type_id);
CREATE INDEX property_offer_id_idx ON property USING btree (offer_type_id);
CREATE INDEX property_city_id_idx ON property USING btree (city_id);


CREATE SEQUENCE unit_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE unit (
    id		BIGINT PRIMARY KEY DEFAULT nextval('unit_id'::regclass) NOT NULL,
    name	VARCHAR(32) NOT NULL,
    value	VARCHAR(32) NOT NULL
);
CREATE UNIQUE INDEX unit_name_uidx ON unit("name");

CREATE TABLE feature_type (
    id 			BIGINT PRIMARY KEY NOT NULL,
    "name" 		VARCHAR(32) NOT NULL,
	"group"  	INTEGER NULL DEFAULT 0,
    weight 		INTEGER NOT NULL DEFAULT 1,
    unit_id bigint NULL REFERENCES unit(id) ON UPDATE CASCADE ON DELETE SET NULL
);
CREATE INDEX feature_type_unit_id_idx ON feature_type USING btree (unit_id);


CREATE SEQUENCE feature_id
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
CREATE TABLE feature (
    id			BIGINT PRIMARY KEY DEFAULT nextval('feature_id'::regclass) NOT NULL,
    content		VARCHAR(128),
    value		INTEGER NULL,
    type_id		BIGINT NOT NULL REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE CASCADE,
    property_id BIGINT NOT NULL REFERENCES property(id) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE INDEX feature_property_id_idx ON feature USING btree (property_id);
CREATE INDEX feature_type_id_idx ON feature USING btree (type_id);


CREATE TABLE image_type (
    id 		INTEGER PRIMARY KEY NOT NULL,
    name 	VARCHAR(4)
);

CREATE SEQUENCE picture_id;
CREATE TABLE picture (
    id 			BIGINT PRIMARY KEY DEFAULT nextval('picture_id'::regclass) NOT NULL,
    name 		VARCHAR(128),
    main 		BOOLEAN NOT NULL DEFAULT FALSE,
	width 		INTEGER NOT NULL,
	height 		INTEGER NOT NULL,
	comment		CHARACTER VARYING(64) NULL,
    type_id 	INTEGER NOT NULL REFERENCES image_type(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    property_id BIGINT NOT NULL REFERENCES property(id) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE INDEX picture_property_id_idx ON picture USING btree (property_id);
ALTER TABLE "property" ADD COLUMN "image_id" BIGINT NULL REFERENCES "picture"("id") ON DELETE RESTRICT ON UPDATE REStRICT;

-- CREATE INDEX "image_id_idx" ON "property"("image_id");

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
--     name VARCHAR(32) NOT NULL,
-- );
