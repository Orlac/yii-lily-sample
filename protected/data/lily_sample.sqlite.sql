PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE 'tbl_migration' (
	"version" varchar(255) NOT NULL PRIMARY KEY,
	"apply_time" integer
);
INSERT INTO "tbl_migration" VALUES('m000000_000000_base',1329929588);
INSERT INTO "tbl_migration" VALUES('m120131_112629_lily_tables_create',1329929590);
INSERT INTO "tbl_migration" VALUES('m120206_173608_create_profile_table',1329929590);
INSERT INTO "tbl_migration" VALUES('m120207_125421_create_user_tag_tables',1329929590);
CREATE TABLE 'tbl_lily_user' (
	"uid" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"deleted" integer,
	"active" tinyint(1),
	"inited" tinyint(1)
);
CREATE TABLE 'tbl_lily_account' (
	"aid" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"uid" integer,
	"service" varchar(255) NOT NULL,
	"id" varchar(255) NOT NULL,
	"hidden" tinyint(1),
	"data" blob,
	"created" integer
);
CREATE TABLE 'tbl_lily_email_account_activation' (
	"code_id" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"uid" integer,
	"email" varchar(255) NOT NULL,
	"password" varchar(255) NOT NULL,
	"code" varchar(255) NOT NULL,
	"created" integer
);
CREATE TABLE 'tbl_lily_session' (
	"sid" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"aid" integer,
	"data" blob,
	"ssid" varchar(255) NOT NULL,
	"created" integer
);
CREATE TABLE 'tbl_lily_onetime' (
	"tid" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"uid" integer,
	"token" varchar(255) NOT NULL,
	"created" integer
);
CREATE TABLE 'tbl_profile' (
	"pid" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"uid" integer,
	"name" varchar(255),
	"birthday" date,
	"sex" tinyint(1)
);
CREATE TABLE 'tbl_tag' (
	"tid" integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	"name" varchar(255)
);
CREATE TABLE 'tbl_tag_relation' (
	"tid" integer,
	"uid" integer
);
CREATE UNIQUE INDEX 'service_id' ON 'tbl_lily_account' ("service", "id");
COMMIT;

/**
 * Database schema required by CDbAuthManager.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @since 1.0
 */

drop table if exists 'AuthAssignment';
drop table if exists 'AuthItemChild';
drop table if exists 'AuthItem';

create table 'AuthItem'
(
   "name"                 varchar(64) not null,
   "type"                 integer not null,
   "description"          text,
   "bizrule"              text,
   "data"                 text,
   primary key ("name")
);

create table 'AuthItemChild'
(
   "parent"               varchar(64) not null,
   "child"                varchar(64) not null,
   primary key ("parent","child"),
   foreign key ("parent") references 'AuthItem' ("name") on delete cascade on update cascade,
   foreign key ("child") references 'AuthItem' ("name") on delete cascade on update cascade
);

create table 'AuthAssignment'
(
   "itemname"             varchar(64) not null,
   "userid"               varchar(64) not null,
   "bizrule"              text,
   "data"                 text,
   primary key ("itemname","userid"),
   foreign key ("itemname") references 'AuthItem' ("name") on delete cascade on update cascade
);
