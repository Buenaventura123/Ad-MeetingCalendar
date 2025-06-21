create table if not exists task (
   id          serial primary key,
   meeting_id  integer
      references meeting ( id ),
   assigned_to integer
      references users ( id ),
   title       varchar(255) not null,
   description text,
   status      varchar(50) default 'pending',
   due_date    timestamp,
   created_at  timestamp default current_timestamp
);