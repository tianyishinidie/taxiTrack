drop index taxi_id_index on taxi_info;

drop table if exists taxi_info;

/*==============================================================*/
/* Table: taxi_info                                             */
/*==============================================================*/
create table taxi_info
(
   id                   int not null auto_increment,
   taxi_id              varchar(10) not null,
   full_load            int not null,
   actual_load          int not null,
   info_date            datetime not null,
   lon                  float not null,
   lat                  float not null,
   attr1                int not null,
   attr2                int not null,
   attr3                int not null,
   primary key (id),
   unique key AK_UNQ_taxi_info_taxi_id_date (taxi_id, info_date)
);

/*==============================================================*/
/* Index: taxi_id_index                                         */
/*==============================================================*/
create index taxi_id_index on taxi_info
(
   taxi_id
);
