-- $Id$

-- i18n
create sequence language_id;
create table "language" (
	"id"		smallint not null PRIMARY KEY default nextval('language_id'),
	"name"		varchar(16) not null,
	"native"	varchar(16) null,
	"code"		varchar(2) not null
);

create sequence name_id;
create table "name" (
	"id"			bigint not null PRIMARY KEY default nextval('name_id'),
	"value"			varchar(64) not null,
	language_id		bigint not null references "language"(id) on update cascade on delete restrict,
	bean_name		varchar(32) not null,
	bean_attr		varchar(32) not null,
	bean_id			bigint not null
);
create index name_language_idx on "name"(language_id);
create index name_bean_name_id_idx on "name"(bean_name, bean_id);
create unique index name_language_bean_name_id_uidx on "name"(language_id, bean_name, bean_id);


-- common

create sequence user_id;
create table "user" (
	"id"		bigint not null PRIMARY KEY default nextval('user_id'),
	"name"		varchar(64) not null,
	"surname"	varchar(64) not null,
	"email"		varchar(128) not null,
	"username" 	varchar(64) not null,
	"password"	varchar(32) not null
);

create sequence offer_type_id;
create table "offer_type" (
	"id"		bigint not null PRIMARY KEY default nextval('offer_type_id'),
	"name_id"	bigint not null references "language"(id) on update cascade on delete restrict
);
create index type_parent_idx on type(parent_id);


create sequence offer_id;
create table "offer" (
	"id"			bigint not null PRIMARY KEY default nextval('offer_id'),
	"name"			varchar(64) not null,
	"description"	varchar(512) null,
	"user_id"		bigint not null references "user"(id) on update cascade on delete cascade
);
create index sale_user_idx on sale(user_id);

create sequence item_id;
create table item (
	"id"			bigint not null PRIMARY KEY default nextval('item_id'),
	"name"			varchar(64) not null,
	"description"	varchar(512) null,
	"type_id"		bigint null references "type"(id) on update cascade on delete cascade,
	"sale_id"		bigint not null references "sale"(id) on update cascade on delete cascade,
	"price"			numeric(20,2) null
);
create index item_sale_idx on item(sale_id);
create index item_type_idx on item(type_id);
