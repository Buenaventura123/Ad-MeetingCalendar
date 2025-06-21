create table if not exists meeting_users (
   meeting_id integer not null
      references meeting ( id ),
   user_id    integer not null
      references users ( id ),
   role       varchar(50) not null,
   primary key ( meeting_id,
                 user_id )
);