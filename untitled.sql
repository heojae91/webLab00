create table sugang (
	studentid	int(10)	foreign key references user,
	sugangcode	int(4)	foreign key references subject
);

create table user (
	id	int(10)	primary key,
	name	varchar(10) not null,
	password	varchar(50) not null,
	level	int(1) not null,
	point	int(5) not null
	);

create table subject (
	subjectcode	int(4)	primary key,
	subject 	varchar(20) not null
	);

create table subject_prof (
	profid	int(10)	foreign key references user,
	subjectcode	int(4)	foreign key
	);

create table lecture (
	subjectcode	int(4)	foreign key references subject,
	lecturecode	int(4)	not null auto_increment
	);

create table feedback (
	subjectcode	int(4)	foreign key references subject,
	studentid	int(10)	foreign key references user,
	content	text	not null,
	readflag	int(1)	not null,
	lecturecode	int(4)	foreign key
	);

create table question (
	no 	int(5)	primary key auto_increment,
	title 	varchar(50)	not null,
	content	text	not null,
	writtenTime	datetime	not null,
	writerid	int(10)	foreign key references user,
	positionX	int(4)	not null,
	positionY	int(4)	not null
	);

create table answer (
	questionNo	int(5)	foreign key references question,
	no 	int(5)	primary key auto_increment,
	content	text	not null,
	writerid	int(10)	foreign key references user,
	likeit	int(3)	not null,
	report	int(1)	not null
	);

create table report (
	studentid	int(10)	foreign key references user,
	no 	int(5) not null,
	type	int(1)	not null
);

create table likeit (
	studentid	int(10)	foreign	key references user,
	no 	int(5)	not null,
	type	int(1)	not null
	);

create table lecturenote (
	imagepath	varchar(50) not null,
	lecturecode	int(4)	foreign key references lecture,
	page	int(3) not null,
	subjectcode	int(4)	foreign key references subject
	);