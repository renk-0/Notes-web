create database if not exists notes;
use notes;
create table if not exists boxes (
	id int not null auto_increment,
	primary key(id),
	name varchar(30) not null,
	creation datetime not null default current_timestamp
);

create table if not exists notes (
	id int not null auto_increment,
	primary key(id),
	name varchar(30) not null,
	content text not null,
	creation datetime not null default current_timestamp,
	box int not null,
	foreign key (box) references boxes(id)
);

delimiter $$

create or replace trigger -- if not exists
del_box before delete on boxes
for each row begin
	delete from notes where box=old.id;
end$$

delimiter ;
