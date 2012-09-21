insert into "role" (id, name) values (1, 'guest');
insert into "role" (id, name) values (2, 'user');
insert into "role" (id, name) values (3, 'moderator');
insert into "role" (id, name) values (4, 'administrator');


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

insert into feature_type (id, "name", "cast") values (1, 'price', 2);
insert into feature_type (id, "name", "cast") values (2, 'area', 2);
insert into feature_type (id, "name", "cast") values (3, 'bedrooms', 2);
insert into feature_type (id, "name", "cast") values (4, 'toylets', 2);
insert into feature_type (id, "name", "cast") values (5, 'Levels', 2);
insert into feature_type (id, "name", "cast") values (6, 'floor', 2);
insert into feature_type (id, "name", "cast") values (7, 'car places', 2);
-- indoor types
insert into feature_type (id, "group", "name", "cast") values (101, 1, 'alarm system', 1);
insert into feature_type (id, "group", "name", "cast") values (102, 1, 'intercom', 1);
insert into feature_type (id, "group", "name", "cast") values (103, 1, 'ensuite', 1);
insert into feature_type (id, "group", "name", "cast") values (104, 1, 'built-in wardrobes', 1);
insert into feature_type (id, "group", "name", "cast") values (105, 1, 'ducted vacuum system', 1);
insert into feature_type (id, "group", "name", "cast") values (106, 1, 'gym', 1);
insert into feature_type (id, "group", "name", "cast") values (107, 1, 'workshop', 1);
insert into feature_type (id, "group", "name", "cast") values (108, 1, 'indoor SPA', 1);
insert into feature_type (id, "group", "name", "cast") values (109, 1, 'rumpus room', 1); -- play room
insert into feature_type (id, "group", "name", "cast") values (110, 1, 'floorboards', 1); -- wooden floor
insert into feature_type (id, "group", "name", "cast") values (111, 1, 'broadband internet', 1);
insert into feature_type (id, "group", "name", "cast") values (112, 1, 'pay TV access', 1);
insert into feature_type (id, "group", "name", "cast") values (101, 1, 'open fireplace', 1);
insert into feature_type (id, "group", "name", "cast") values (114, 1, 'ducted cooling', 1);
insert into feature_type (id, "group", "name", "cast") values (115, 1, 'air conditioning', 1);
insert into feature_type (id, "group", "name", "cast") values (116, 1, 'split-system air conditioning', 1);
insert into feature_type (id, "group", "name", "cast") values (117, 1, 'ducted heating', 1);
insert into feature_type (id, "group", "name", "cast") values (118, 1, 'storage heaters', 1);
insert into feature_type (id, "group", "name", "cast") values (119, 1, 'split-system heating', 1);
insert into feature_type (id, "group", "name", "cast") values (120, 1, 'hydronic heating', 1);
insert into feature_type (id, "group", "name", "cast") values (121, 1, 'gas heating', 1);
-- indoor types
insert into feature_type (id, "group", "name", "cast") values (201, 2, 'carport', 1);
insert into feature_type (id, "group", "name", "cast") values (202, 2, 'garage', 1);
insert into feature_type (id, "group", "name", "cast") values (203, 2, 'open car spaces', 1);
insert into feature_type (id, "group", "name", "cast") values (204, 2, 'remote garage', 1);
insert into feature_type (id, "group", "name", "cast") values (205, 2, 'secure Parking', 1);
insert into feature_type (id, "group", "name", "cast") values (206, 2,'swimming pool', 1);
insert into feature_type (id, "group", "name", "cast") values (207, 2, 'outside SPA', 1);
insert into feature_type (id, "group", "name", "cast") values (208, 2, 'tennis court', 1);
insert into feature_type (id, "group", "name", "cast") values (209, 2, 'balcony', 1);
insert into feature_type (id, "group", "name", "cast") values (210, 2, 'deck', 1);
insert into feature_type (id, "group", "name", "cast") values (211, 2, 'courtyard', 1);
insert into feature_type (id, "group", "name", "cast") values (212, 2, 'playground', 1);
insert into feature_type (id, "group", "name", "cast") values (213, 2, 'shed', 1);
insert into feature_type (id, "group", "name", "cast") values (214, 2, 'fully fenced', 1);


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

