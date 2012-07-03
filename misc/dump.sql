--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: feature_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: feature_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_id', 1, false);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: feature; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature (
    id bigint DEFAULT nextval('feature_id'::regclass) NOT NULL,
    content character varying(128),
    value numeric(20,2),
    type_id bigint NOT NULL,
    property_id bigint NOT NULL
);


--
-- Name: feature_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE feature_type_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: feature_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('feature_type_id', 1, false);


--
-- Name: feature_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature_type (
    id bigint DEFAULT nextval('feature_type_id'::regclass) NOT NULL,
    name character varying(32) NOT NULL,
    unit_id bigint
);


--
-- Name: language; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE language (
);


--
-- Name: language_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE language_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: language_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('language_id', 1, false);


--
-- Name: offer_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE offer_type_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: offer_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('offer_type_id', 1, false);


--
-- Name: offer_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE offer_type (
    id bigint DEFAULT nextval('offer_type_id'::regclass) NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Name: property_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE property_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: property_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('property_id', 1, false);


--
-- Name: property; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE property (
    id bigint DEFAULT nextval('property_id'::regclass) NOT NULL,
    name character varying(128) NOT NULL,
    description character varying(512),
    user_id bigint NOT NULL,
    price numeric(10,2),
    property_type_id bigint NOT NULL,
    offer_type_id bigint NOT NULL
);


--
-- Name: property_type_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE property_type_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: property_type_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('property_type_id', 1, false);


--
-- Name: property_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE property_type (
    id bigint DEFAULT nextval('property_type_id'::regclass) NOT NULL
);


--
-- Name: unit_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE unit_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: unit_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('unit_id', 1, false);


--
-- Name: unit; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit (
    id bigint DEFAULT nextval('unit_id'::regclass) NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Name: user_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE user_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: user_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('user_id', 1, false);


--
-- Name: user; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE "user" (
    id bigint DEFAULT nextval('user_id'::regclass) NOT NULL,
    name character varying(64) NOT NULL,
    surname character varying(64) NOT NULL,
    email character varying(128) NOT NULL,
    username character varying(64) NOT NULL,
    password character varying(32) NOT NULL
);


--
-- Data for Name: feature; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature (id, content, value, type_id, property_id) FROM stdin;
\.


--
-- Data for Name: feature_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type (id, name, unit_id) FROM stdin;
\.


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: -
--

COPY language  FROM stdin;
\.


--
-- Data for Name: offer_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY offer_type (id, name) FROM stdin;
\.


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: -
--

COPY property (id, name, description, user_id, price, property_type_id, offer_type_id) FROM stdin;
\.


--
-- Data for Name: property_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY property_type (id) FROM stdin;
\.


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit (id, name) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY "user" (id, name, surname, email, username, password) FROM stdin;
\.


--
-- Name: feature_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_pkey PRIMARY KEY (id);


--
-- Name: feature_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY feature_type
    ADD CONSTRAINT feature_type_pkey PRIMARY KEY (id);


--
-- Name: offer_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY offer_type
    ADD CONSTRAINT offer_type_pkey PRIMARY KEY (id);


--
-- Name: property_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_pkey PRIMARY KEY (id);


--
-- Name: property_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY property_type
    ADD CONSTRAINT property_type_pkey PRIMARY KEY (id);


--
-- Name: unit_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY unit
    ADD CONSTRAINT unit_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: property_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX property_id_idx ON feature USING btree (property_id);


--
-- Name: unit_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX unit_id_idx ON feature_type USING btree (unit_id);


--
-- Name: user_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX user_id_idx ON property USING btree (user_id);


--
-- Name: feature_property_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_property_id_fkey FOREIGN KEY (property_id) REFERENCES property(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: feature_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_type_id_fkey FOREIGN KEY (type_id) REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: feature_type_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature_type
    ADD CONSTRAINT feature_type_unit_id_fkey FOREIGN KEY (unit_id) REFERENCES unit(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: property_offer_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_offer_type_id_fkey FOREIGN KEY (offer_type_id) REFERENCES offer_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: property_property_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_property_type_id_fkey FOREIGN KEY (property_type_id) REFERENCES property_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: property_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_user_id_fkey FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

