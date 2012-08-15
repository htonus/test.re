insert into property_type (id, name) values (1, 'house');
insert into property_type (id, name) values (2, 'appartment');
insert into property_type (id, name) values (3, 'towmhouse');
insert into property_type (id, name) values (4, 'villa');
insert into property_type (id, name) values (5, 'land');
insert into property_type (id, name) values (6, 'acreage');
insert into property_type (id, name) values (7, 'rural');
insert into property_type (id, name) values (8, 'unit');
insert into property_type (id, name) values (9, 'unitsblock');
insert into property_type (id, name) values (10, 'property');

insert into offer_type (id, name) values (1, 'buy');
insert into offer_type (id, name) values (2, 'sell');
insert into offer_type (id, name) values (3, 'rent');
insert into offer_type (id, name) values (4, 'lease');

insert into feature_type (id, name) values (10, 'AREA');
insert into feature_type (id, name) values (20, 'PRICE');
insert into feature_type (id, name) values (30, 'BEDROOMS');
insert into feature_type (id, name) values (40, 'TOYLETS');
insert into feature_type (id, name) values (50, 'BALCONS');
insert into feature_type (id, name) values (60, 'LEVELS');
insert into feature_type (id, name) values (70, 'PARKING');
insert into feature_type (id, name) values (80, 'COVERED_PARKING');
insert into feature_type (id, name) values (90, 'GARDEN');
insert into feature_type (id, name) values (100, 'BARBEQUE');
insert into feature_type (id, name) values (110, 'POOL');
insert into feature_type (id, name) values (120, 'GARAGE');
insert into feature_type (id, name) values (130, 'KITCHENS');
insert into feature_type (id, name) values (150, 'STORAGE');
insert into feature_type (id, name) values (160, 'LAUNDRY');
insert into feature_type (id, name) values (170, 'FURNITURE');
insert into feature_type (id, name) values (180, 'FIREPLACE');
insert into feature_type (id, name) values (190, 'CELLAR');
insert into feature_type (id, name) values (200, 'ATTIC');
insert into feature_type (id, name) values (210, 'ELEVATOR');
insert into feature_type (id, name) values (220, 'FLOOR');
insert into feature_type (id, name) values (230, 'SEA_VIEW');
insert into feature_type (id, name) values (240, 'MOUNTAIN_VIEW');

insert into image_type (id, name) values (1, 'gif');
insert into image_type (id, name) values (2, 'jpeg');
insert into image_type (id, name) values (3, 'png');
insert into image_type (id, name) values (4, 'swf');
insert into image_type (id, name) values (5, 'psd');
insert into image_type (id, name) values (6, 'bmp');
insert into image_type (id, name) values (7, 'tif');
insert into image_type (id, name) values (8, 'tif');
insert into image_type (id, name) values (9, 'jpc');
insert into image_type (id, name) values (10, 'jp2');
insert into image_type (id, name) values (11, 'jpx');
insert into image_type (id, name) values (12, 'jb2');
insert into image_type (id, name) values (13, 'swc');
insert into image_type (id, name) values (14, 'iff');
insert into image_type (id, name) values (15, 'bmp');
insert into image_type (id, name) values (16, 'xbm');
insert into image_type (id, name) values (100, 'jpeg');

insert into city (id, name) values (1, 'Nicosia');
insert into city (id, name) values (2, 'Larnaka');
insert into city (id, name) values (3, 'Limasssol');
insert into city (id, name) values (4, 'Paphos');
insert into city (id, name) values (5, 'Ayanapa');

COPY property (id, name, description, user_id, property_type_id, offer_type_id, image_id) FROM stdin;
1	House 1	\N	2	4	1	\N
2	House 	\N	2	4	1	\N
3	House 3	\N	2	4	1	\N
4	House 4	\N	2	4	1	\N
5	House 5	\N	2	4	1	\N
6	House 6	\N	2	4	1	\N
7	House 7	\N	2	4	1	\N
8	House 8	\N	2	4	1	\N
9	House 9	\N	2	4	1	\N
\.

COPY feature (id, content, value, type_id, property_id) FROM stdin;
1		100	1	1
2		100000	20	1
4		2	4	1
13	\N	2	4	2
18	\N	2	3	3
20	\N	100	1	3
21	\N	2	4	4
23	\N	100000	2	4
24	\N	100	1	4
26	\N	2	3	5
32	\N	100	1	6
33	\N	2	4	7
34	\N	2	3	7
37	\N	2	4	8
38	\N	2	3	8
40	\N	100	1	8
42	\N	2	3	9
43	\N	100000	2	9
44	\N	100	1	9
19	\N	200000	2	3
27	\N	200000	2	5
35	\N	200000	2	7
15	\N	150000	2	2
14	\N	3	3	2
22	\N	3	3	4
30	\N	3	3	6
17	\N	1	4	3
25	\N	1	4	5
29	\N	1	4	6
16	\N	200	1	2
28	\N	200	1	5
36	\N	200	1	7
39	\N	250000	2	8
31	\N	300000	2	6
41	\N	3	4	9
3		3	3	1
\.

