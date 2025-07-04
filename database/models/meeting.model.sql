create table if not exists meeting (
   id           serial primary key,
   title        varchar(255) not null,
   description  text,
   scheduled_at timestamp not null,
   created_by   integer
      references users ( id ),
   created_at   timestamp default current_timestamp
);