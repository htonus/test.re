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
-- Name: city_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE city_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: city_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('city_id', 5, true);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: city; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE city (
    id bigint DEFAULT nextval('city_id'::regclass) NOT NULL,
    name character varying(64) NOT NULL,
    latitude numeric(10,4),
    longitude numeric(10,4),
    parent_id bigint
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

SELECT pg_catalog.setval('feature_id', 44, true);


--
-- Name: feature; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE feature (
    id bigint DEFAULT nextval('feature_id'::regclass) NOT NULL,
    content character varying(128),
    value integer,
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
    required boolean DEFAULT true NOT NULL,
    unit_id bigint,
    priority integer DEFAULT 1 NOT NULL
);


--
-- Name: image_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE image_type (
    id integer NOT NULL,
    name character varying(4)
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
-- Name: offer_type; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE offer_type (
    id bigint DEFAULT nextval('offer_type_id'::regclass) NOT NULL,
    name character varying(32) NOT NULL
);


--
-- Name: picture_id; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE picture_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: picture_id; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('picture_id', 1, false);


--
-- Name: picture; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE picture (
    id bigint DEFAULT nextval('picture_id'::regclass) NOT NULL,
    name character varying(128),
    main boolean DEFAULT false NOT NULL,
    width integer NOT NULL,
    height integer NOT NULL,
    type_id bigint NOT NULL,
    property_id bigint NOT NULL
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

SELECT pg_catalog.setval('property_id', 9, true);


--
-- Name: property; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE property (
    id bigint DEFAULT nextval('property_id'::regclass) NOT NULL,
    name character varying(128) NOT NULL,
    description character varying(512),
    user_id bigint NOT NULL,
    property_type_id bigint NOT NULL,
    offer_type_id bigint NOT NULL,
    image_id bigint,
    location_id bigint DEFAULT 1 NOT NULL
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
    id bigint DEFAULT nextval('property_type_id'::regclass) NOT NULL,
    name character varying(32) NOT NULL
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
    name character varying(32) NOT NULL,
    value character varying(32) NOT NULL
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

SELECT pg_catalog.setval('user_id', 2, true);


--
-- Name: user; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE "user" (
    id bigint DEFAULT nextval('user_id'::regclass) NOT NULL,
    name character varying(64) NOT NULL,
    surname character varying(64) NOT NULL,
    email character varying(128) NOT NULL,
    username character varying(64) NOT NULL,
    password character varying(40) NOT NULL
);


--
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: -
--

COPY city (id, name, latitude, longitude, parent_id) FROM stdin;
1	Nicosia	44.1235	46.1235	\N
2	Larnaka	\N	\N	\N
3	Limassol	\N	\N	\N
4	Paphos	\N	\N	\N
5	Ayanapa	\N	\N	\N
\.


--
-- Data for Name: feature; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature (id, content, value, type_id, property_id) FROM stdin;
1		100	10	1
2		100000	20	1
4		2	40	1
13	\N	2	40	2
18	\N	2	30	3
20	\N	100	10	3
21	\N	2	40	4
23	\N	100000	20	4
24	\N	100	10	4
26	\N	2	30	5
32	\N	100	10	6
33	\N	2	40	7
34	\N	2	30	7
37	\N	2	40	8
38	\N	2	30	8
40	\N	100	10	8
42	\N	2	30	9
43	\N	100000	20	9
44	\N	100	10	9
19	\N	200000	20	3
27	\N	200000	20	5
35	\N	200000	20	7
15	\N	150000	20	2
14	\N	3	30	2
22	\N	3	30	4
30	\N	3	30	6
17	\N	1	40	3
25	\N	1	40	5
29	\N	1	40	6
16	\N	200	10	2
28	\N	200	10	5
36	\N	200	10	7
39	\N	250000	20	8
31	\N	300000	20	6
41	\N	3	40	9
3		3	30	1
\.


--
-- Data for Name: feature_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY feature_type (id, name, required, unit_id, priority) FROM stdin;
10	AREA	t	\N	1
20	PRICE	t	\N	1
30	BEDROOMS	t	\N	1
40	TOYLETS	t	\N	1
50	BALCONS	t	\N	1
60	LEVELS	t	\N	1
70	PARKING	t	\N	1
80	COVERED_PARKING	t	\N	1
90	GARDEN	t	\N	1
100	BARBEQUE	t	\N	1
110	POOL	t	\N	1
120	GARAGE	t	\N	1
130	KITCHENS	t	\N	1
150	STORAGE	t	\N	1
160	LAUNDRY	t	\N	1
170	FURNITURE	t	\N	1
180	FIREPLACE	t	\N	1
190	CELLAR	t	\N	1
200	ATTIC	t	\N	1
210	ELEVATOR	t	\N	1
220	FLOOR	t	\N	1
230	SEA_VIEW	t	\N	1
240	MOUNTAIN_VIEW	t	\N	1
\.


--
-- Data for Name: image_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY image_type (id, name) FROM stdin;
1	gif
2	jpeg
3	png
4	swf
5	psd
6	bmp
7	tif
8	tif
9	jpc
10	jp2
11	jpx
12	jb2
13	swc
14	iff
15	bmp
16	xbm
100	jpeg
\.


--
-- Data for Name: offer_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY offer_type (id, name) FROM stdin;
1	buy
2	sell
3	rent
4	lease
\.


--
-- Data for Name: picture; Type: TABLE DATA; Schema: public; Owner: -
--

COPY picture (id, name, main, width, height, type_id, property_id) FROM stdin;
\.


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: -
--

COPY property (id, name, description, user_id, property_type_id, offer_type_id, image_id, location_id) FROM stdin;
1	House 1	\N	2	4	1	\N	1
2	House 	\N	2	4	1	\N	1
3	House 3	\N	2	4	1	\N	1
4	House 4	\N	2	4	1	\N	1
5	House 5	\N	2	4	1	\N	1
6	House 6	\N	2	4	1	\N	1
7	House 7	\N	2	4	1	\N	1
8	House 8	\N	2	4	1	\N	1
9	House 9	\N	2	4	1	\N	1
\.


--
-- Data for Name: property_type; Type: TABLE DATA; Schema: public; Owner: -
--

COPY property_type (id, name) FROM stdin;
1	room
2	flat
3	appartment
4	house
\.


--
-- Data for Name: unit; Type: TABLE DATA; Schema: public; Owner: -
--

COPY unit (id, name, value) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY "user" (id, name, surname, email, username, password) FROM stdin;
2	Mikhail 	Cherviakov	htonus@gmail.com	htonus	9ac20922b054316be23842a5bca7d69f29f69d77
\.


--
-- Name: city_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY city
    ADD CONSTRAINT city_pkey PRIMARY KEY (id);


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
-- Name: image_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY image_type
    ADD CONSTRAINT image_type_pkey PRIMARY KEY (id);


--
-- Name: offer_type_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY offer_type
    ADD CONSTRAINT offer_type_pkey PRIMARY KEY (id);


--
-- Name: picture_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT picture_pkey PRIMARY KEY (id);


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
-- Name: feature_property_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_property_id_idx ON feature USING btree (property_id);


--
-- Name: feature_type_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_type_id_idx ON feature USING btree (type_id);


--
-- Name: feature_type_unit_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX feature_type_unit_id_idx ON feature_type USING btree (unit_id);


--
-- Name: location_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX location_id_idx ON property USING btree (location_id);


--
-- Name: picture_property_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX picture_property_id_idx ON picture USING btree (property_id);


--
-- Name: property_offer_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX property_offer_id_idx ON property USING btree (offer_type_id);


--
-- Name: property_type_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX property_type_id_idx ON property USING btree (property_type_id);


--
-- Name: property_user_id_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX property_user_id_idx ON property USING btree (user_id);


--
-- Name: unit_name_uidx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX unit_name_uidx ON unit USING btree (name);


--
-- Name: city_parent_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY city
    ADD CONSTRAINT city_parent_id_fkey FOREIGN KEY (parent_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: feature_property_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_property_id_fkey FOREIGN KEY (property_id) REFERENCES property(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: feature_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature
    ADD CONSTRAINT feature_type_id_fkey FOREIGN KEY (type_id) REFERENCES feature_type(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: feature_type_unit_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY feature_type
    ADD CONSTRAINT feature_type_unit_id_fkey FOREIGN KEY (unit_id) REFERENCES unit(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: picture_property_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT picture_property_id_fkey FOREIGN KEY (property_id) REFERENCES property(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: picture_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT picture_type_id_fkey FOREIGN KEY (type_id) REFERENCES image_type(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: property_image_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_image_id_fkey FOREIGN KEY (image_id) REFERENCES picture(id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: property_location_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_location_id_fkey FOREIGN KEY (location_id) REFERENCES city(id) ON UPDATE CASCADE ON DELETE RESTRICT;


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

