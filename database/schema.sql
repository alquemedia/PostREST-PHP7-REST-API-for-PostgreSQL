create sequence task_id_seq start with 1;

CREATE TABLE task (
  task_id INTEGER PRIMARY KEY NOT NULL DEFAULT nextval('task_id_seq'::regclass),
  sortable_id integer null,
  uuid UUID NOT NULL DEFAULT uuid_in((md5(((random())::text || (now())::text)))::cstring),
  name CHARACTER VARYING(50) NOT NULL,
  is_complete BOOLEAN NOT NULL DEFAULT FALSE,
  description TEXT NOT NULL,
  created_date timestamp without time zone not null default now(),
  last_modified_date TIMESTAMP WITHOUT TIME ZONE

);
CREATE UNIQUE INDEX task_name_uindex ON task USING BTREE (name);
CREATE UNIQUE INDEX task_id ON task USING BTREE (task_id);
