create table if not exists users (
   id         serial primary key,
   username   varchar(100) unique not null,
   password   varchar(255) not null,
   email      varchar(150) unique not null,
   full_name  varchar(150),
   group_name varchar(100),
   role       varchar(50) default 'member',
   created_at timestamp default current_timestamp
);