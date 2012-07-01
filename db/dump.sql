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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: feature; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature (
);


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
-- Name: offer_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE offer_type (
);


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
-- Name: property; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE property (
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
-- Name: property_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE property_type (
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
-- Name: unit; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE unit (
    name character varying(16) NOT NULL,
    id bigint NOT NULL
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

COPY feature  FROM stdin;
\.


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: -
--

COPY language  FROM stdin;
\.


--
-- Data for Name: offer_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY offer_type  FROM stdin;
\.


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: -
--

COPY property  FROM stdin;
\.


--
-- Data for Name: property_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY property_type  FROM stdin;
\.


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit (name, id) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY "user" (id, name, surname, email, username, password) FROM stdin;
\.


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

