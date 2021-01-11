#member(회원), radio(라디오 채널 정보), music(음악 정보) 테이블 생성
CREATE TABLE member(
m_name varchar(10) not null ,
m_id VARCHAR(10) NOT NULL,
m_pw VARCHAR(10) NOT NULL,
age integer not null,
sex char(10) NOT NULL,
m_email char(20),
m_tel varchar(20),
PRIMARY KEY(m_id)
);

CREATE TABLE radio(
rno integer not null ,
r_name VARCHAR(20) NOT NULL,
r_time CHAR(10) NOT NULL,
dj char(10) not null,
r_channel float not null,
PRIMARY KEY(rno)
);

create table music(
mno integer not null,
m_song varchar(30) not null,
m_singer varchar(20) not null,
primary key(mno)
);

insert into radio values(1,'음악의 숲', '1:00','정승환',91.9);
insert into radio values(2,'JUST POP', '2:00','신혜림',95.9);
insert into radio values(3,'비포 선라이즈', '3:00','김수지',95.9);
insert into radio values(4,'세상을 여는 아침', '5:00','김초롱',95.9);
insert into radio values(5,'굿모닝FM', '7:00','김제동',91.9);
insert into radio values(6,'오늘 아침', '9:00','정지영',95.9);
insert into radio values(7,'골든 디스크', '11:00','김현철',91.9);
insert into radio values(8,'정오의 희망곡', '12:00','김신영',95.9);
insert into radio values(9,'2시의 데이트', '14:00','지석진',95.9);
insert into radio values(10,'오후의 발견', '16:00','이지혜',91.9);
insert into radio values(11,'음악캠프', '18:00','배철수',91.9);
insert into radio values(12,'꿈꾸는 라디오', '21:00','박경',95.9);
insert into radio values(13,'푸른밤', '23:00','옥상달빛',95.9);

INSERT INTO MUSIC VALUES
(1,	'작은 것들을 위한 시',	'방탄소년단'),
(2,	'주저하는 연인들을 위해',	'잔나비'),
(3,	'FANCY',	'트와이스'),
(4,	'2002',	'Anne-Marie'),
(5,	'사계',	'Four Seasons'),
(6,	'너에게 못했던 내 마지막 말은',	'다비치'),
(7,	'bad guy',	'Billie Elish'),
(8,	'찬바람이 불면',	'김지연'),
(9,	'먼 훗날',	'박정운'),
(10,	'이별 택시',	'김연우');

insert into member values ("류서진","seojin2","1234",23,"여자","jinn@naver.com","0103232");

#외래키에 의해 이전 테이블 값 삽입 후 테이블 생성
#board(게시판), favorite(라디오 채널 구독)테이블 생성
create table board(
bno integer not null,
rno integer not null ,
b_id VARCHAR(10) NOT NULL,
b_title varchar(60),
b_content varchar(1500),
b_date DATETIME DEFAULT CURRENT_TIMESTAMP,
b_mno integer not null,
primary key(bno),
foreign key(b_id) references member(m_id),
foreign key(rno) references radio(rno),
foreign key(b_mno) references music(mno)
);

create table favorite(
f_id VARCHAR(10) NOT NULL,
f_rno integer not null ,
f_category varchar(20),
foreign key(f_rno) references radio(rno),
foreign key(f_id) references member(m_id)
);


