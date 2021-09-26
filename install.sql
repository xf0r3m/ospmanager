CREATE USER 'ospmgmt'@'localhost' IDENTIFIED BY 'Lh7TBLkzNzQv43KP';
CREATE DATABASE ospmgmt;
GRANT ALL ON ospmgmt.* TO 'ospmgmt'@'localhost';

USE ospmgmt;

CREATE TABLE logs (
  id int AUTO_INCREMENT PRIMARY KEY,
  user varchar(30),
  event text,
  eventdt varchar(60)
);

CREATE TABLE user (
  id int AUTO_INCREMENT PRIMARY KEY,
  username varchar(30),
  passwd_hash text,
  role varchar(30)
);

CREATE TABLE str_do (
  id int AUTO_INCREMENT PRIMARY KEY,
  imie varchar(60),
  imie2 varchar(60),
  nazwisko varchar(60),
  data_ur datetime,
  msc_ur varchar(60),
  pesel varchar(11),
  imie_ojca varchar(60),
  plec varchar(1),
  zawod varchar(60),
  wyksztalcenie varchar(1),
  msc_pracy varchar(60),
  nr_tel varchar(9),
	adres varchar(160)
);

CREATE TABLE str_str (
  id int AUTO_INCREMENT PRIMARY KEY,
  rodzaj varchar(60),
  stopien varchar(60),
  funkcja varchar(60),
  nr_legitymacji varchar(30),
  data_wst datetime,
  udzwakc varchar(30)
);

CREATE TABLE str_szk (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(60),
  data_roz datetime,
  data_zak datetime,
  data_exp datetime,
  uwagi varchar(60),
  nr_zaswiadczenia varchar(60),
  personal_id int
);

CREATE TABLE str_odz (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(60),
  data_nad datetime,
  nr_legitymacji varchar(60),
  uwagi varchar(60),
  personal_id int
);

CREATE TABLE str_bad (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(60),
  data_bad datetime,
  data_exp datetime,
  nr_zaswiadczenia varchar(60),
  uwagi varchar(60),
  personal_id int
);

CREATE TABLE str_psl (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(60),
  data_roz datetime,
  data_zak datetime,
  opis text,
  personal_id int
);

CREATE TABLE e_about (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(160),
	rodzaj varchar(60),
	nrmel varchar(30),
	uwagi varchar(60),
	miejscowosc varchar(60),
	ulica varchar(60),
	posesja varchar(10),
	alarm datetime,
	rozpoczecie datetime,
	zakonczenie datetime,
	trwanie varchar(30)
);

CREATE TABLE e_member (
	id int AUTO_INCREMENT PRIMARY KEY,
	funkcja varchar(30),
	rozpoczecie datetime,
	zakonczenie datetime,
	udzial varchar(30),
	pojazd varchar(30),
	personal_id int,
	event_id int
);

CREATE TABLE e_alarm (
	id int AUTO_INCREMENT PRIMARY KEY,
	personal_id int,
	event_id int
);

CREATE TABLE e_eqEngine (
	id int AUTO_INCREMENT PRIMARY KEY,
	czas varchar(30),
	paliwo varchar(30),
	uwagi varchar(30),
	eq_id int,
	personal_id int,
	event_id int
);

CREATE TABLE e_eqManual (
	id int AUTO_INCREMENT PRIMARY KEY,
	czas varchar(30),
	uwagi varchar(30),
	eq_id int,
	personal_id int,
	event_id int
);

CREATE TABLE e_vehicle (
	id int AUTO_INCREMENT PRIMARY KEY,
	kilometry varchar(30),
	praca_postuj varchar(30),
	praca_autopompa varchar(30),
	paliwo varchar(30),
	uwagi varchar(30),
	vehicle_id int,
	event_id int
);

CREATE TABLE e_others (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(60),
	rodzaj varchar(60),
	nroperacyjny varchar(30),
	event_id int
);

CREATE TABLE e_note (
	id int AUTO_INCREMENT PRIMARY KEY,
	note text,
	event_id int
);

CREATE TABLE t_about (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(120),
	rodzaj varchar(60),
	miejscowosc varchar(30),
	ulica varchar(30),
	posesja varchar(10),
	rozpoczecie datetime,
	zakonczenie datetime,
	czas varchar(15)
);

CREATE TABLE t_member (
	id int AUTO_INCREMENT PRIMARY KEY,
	funkcja varchar(30),
	rozpoczecie datetime,
	zakonczenie datetime,
	udzial varchar(30),
	pojazd varchar(30),
	uwagi varchar(60),
	personal_id int,
	trips_id int
);

CREATE TABLE t_eqManual (
	id int AUTO_INCREMENT PRIMARY KEY,
	czas varchar(30),
	uwagi varchar(30),
	eq_id int,
	personal_id int,
	trips_id int
);

CREATE TABLE t_eqEngine (
	id int AUTO_INCREMENT PRIMARY KEY,
	czas varchar(30),
	paliwo varchar(30),
	uwagi varchar(30),
	eq_id int,
	personal_id int,
	trips_id int
);

CREATE TABLE t_vehicle (
	id int AUTO_INCREMENT PRIMARY KEY,
	kilometry varchar(30),
	praca_postuj varchar(30),
	praca_autopompa varchar(30),
	paliwo varchar(30),
	uwagi varchar(30),
	vehicle_id int,
	trips_id int
);

CREATE TABLE t_note (
	id int AUTO_INCREMENT PRIMARY KEY,
	note text,
	trips_id int
);

CREATE TABLE j_about (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(120),
	rozpoczecie datetime,
	zakonczenie datetime,
	czas varchar(15)
);

CREATE TABLE j_member (
	id int AUTO_INCREMENT PRIMARY KEY,
	funkcja varchar(30),
	rozpoczecie datetime,
	zakonczenie datetime,
	udzial varchar(30),
	uwagi varchar(60),
	personal_id int,
	jobs_id int
);

CREATE TABLE eq_about (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(60),
	sn varchar(60),
	rodzaj varchar(60),
	podrodzaj varchar(60),
	dest varchar(60),
	datazak varchar(60),
	marka varchar(60),
	poj int,
	stan varchar(60),
	liczba int,
	CNBOP varchar(60),
	lokalizacja varchar(60),
	finansowanie varchar(60)
);

CREATE TABLE eq_deadlines (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(60),
	termin datetime,
	thng_id int
);

CREATE TABLE vehicle_about (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(160),
	marka varchar(60),
	waga varchar(30),
	typ varchar(30),
	rodzaj varchar(120),
	rejestracja varchar(10),
	numer varchar(10),
	obsada int,
	paliwo varchar(10),
	zbiornik int,
	naped varchar(10)
);

CREATE TABLE vehicle_parameters (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(120),
	value varchar(120),
	jednostka varchar(30),
	vehicle_id int
);

CREATE TABLE vehicle_deadlines (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(60),
	termin datetime,
	vehicle_id int
);

CREATE TABLE c_about (
	id int AUTO_INCREMENT PRIMARY KEY,
	nazwa varchar(120),
	rodzaj varchar(60),
	grupa varchar(60),
	szczebel varchar(60),
	miejscowosc varchar(60),
	rozpoczecie datetime,
	zakonczenie datetime,
	czas varchar(60)
);

CREATE TABLE c_score (
	id int AUTO_INCREMENT PRIMARY KEY,
	msc int,
	sztafeta varchar(30),
	pktk_sz int,
	bojowka varchar(30),
	pktk_bj int,
	pkt int,
	comp_id int
);

CREATE TABLE c_comp (
	id int AUTO_INCREMENT PRIMARY KEY,
	bj_func varchar(60),
	sz_func varchar(60),
	uwagi varchar(60),
	personal_id int,
	comp_id int
);

CREATE TABLE c_note (
	id int AUTO_INCREMENT PRIMARY KEY,
	note text,
	comp_id int
);

CREATE TABLE h_osp (
  id int AUTO_INCREMENT PRIMARY KEY,
  msc varchar(60),
  rok varchar(10)
);

CREATE TABLE h_head (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwisko varchar(60),
  lata varchar(30),
  zawod varchar(60),
  szkolenie varchar(60),
  uwagi varchar(60)
);

CREATE TABLE h_fpstatus (
	id int AUTO_INCREMENT PRIMARY KEY,
	rok varchar(10),
	ilosc text,
	gospodz text,
	zaowr text,
	zaows text,
	zaklady text,
	zagroz text,
	laczr text,
	laczp text
);

CREATE TABLE h_objects (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(60),
  rok varchar(10),
  ilosc text,
  mods text,
  remonty text
);

CREATE TABLE h_vehicle (
  id int AUTO_INCREMENT PRIMARY KEY,
  marka varchar(60),
  remonty text,
  likwidacja varchar(120),
  uwagi varchar(60)
);

CREATE TABLE m_about (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa varchar(60),
  data_zebrania datetime,
  rodzaj varchar(60),
  notatka text
);

CREATE TABLE m_member (
  id int AUTO_INCREMENT PRIMARY KEY,
  personal_id int,
  funkcja varchar(60),
  meet_id int
);

CREATE TABLE m_guest (
  id int AUTO_INCREMENT PRIMARY KEY,
  dpguest varchar(60),
  pochodzenie varchar(60),
  meet_id int
);

CREATE TABLE m_files (
  id int AUTO_INCREMENT PRIMARY KEY,
  nazwa text,
  format varchar(10),
  informacje varchar(120),
  meet_id int
);

CREATE TABLE fastaccess (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(120),
	link VARCHAR(120)
);

CREATE TABLE eqec_common (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	serial VARCHAR(60),
	starts VARCHAR(20),
	ends VARCHAR(20),
	marka VARCHAR(30),
	typ VARCHAR(30),
	rodzaj VARCHAR(30),
	nrewi VARCHAR(30),
	norma VARCHAR(15)
);


CREATE TABLE eqec_usage (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data VARCHAR(20),
	nazwisko int,
	minuty VARCHAR(10),
	uzycie VARCHAR(15),
	personal_id int,
	eqec_id int

);

CREATE TABLE eqec_fuel (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data VARCHAR(20),
	faktura VARCHAR(30),
	paliwo VARCHAR(15),
	personal_id int,
	eqec_id int

);

CREATE TABLE eqec_common2 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	pozostalo0 varchar(10),
	pobrano varchar(10),
	razem0 varchar(10),
	minut int,
	uzycie0 varchar(10),
	rozruch int,
	uzycie1 varchar(10),
	razem1 varchar(10),
	pozostalo1 varchar(10),
	personal_id0 int,
	personal_id1 int,
	eqec_id int
);

CREATE TABLE rcard_common (	
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	seria varchar(30),
	miesiac varchar(15) 
);

CREATE TABLE rcard_vehicle (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	marka varchar(30),
	typ varchar(30),
	rodzaj varchar(30),
	rej varchar(15),
	nrop varchar(15),
	zbior varchar(10),
	norma varchar(10),
	normap varchar(10),
	rcard_id int
);

CREATE TABLE rcard_usage (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	stkoniecbr varchar(10),
	stkoniecpo varchar(10),
	przebiegbr varchar(10),
	przebieg varchar(10),
	pdroz varchar(10),
	postoj varchar(10),
	rk varchar(10),
	razem varchar(10),
	rcard_id int
);

CREATE TABLE rcard_fuel1 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data varchar(25),
	faktura varchar(30),
	paliwo varchar(10),
	olej varchar(10),
	personal_id0 int,
	personal_id1 int,
	rcard_id int

);

CREATE TABLE rcard_fuel2 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	pozostalo_paliwo0 varchar(10),
	pozostalo_olej0 varchar(10),
	pobrano_paliwo varchar(10),
	pobrano_olej varchar(10),
	razem_paliwo0 varchar(10),
	razem_olej0 varchar(10),
	km varchar(10),
	kmz_paliwo varchar(10),
	kmz_olej varchar(10),
	minut varchar(10),
	m_paliwo varchar(10),
	m_olej varchar(10),
	rk varchar(10),
	rk_paliwo varchar(10),
	rk_olej varchar(10),
	razem_paliwo1 varchar(10),
	razem_olej1 varchar(10),
	pozostalo_paliwo1 varchar(10),
	pozostalo_olej1 varchar(10),
	rcard_id int

	
);

CREATE TABLE rcard_common2 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	personal_id0 int,
	personal_id1 int,
	msc varchar(30),
	data varchar(25),
	personal_id2 int,
	rcard_id int
	
);

CREATE TABLE rcard_tab (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data varchar(20),
	personal_id0 int,
	trasa text,
	cel text,
	personal_id1 int,
	ostanl int,
	pstanl int,
	dev int,
	personal_id2 int,
	rcard_id int
	
);

CREATE TABLE rcardev_common (	
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	seria varchar(30),
	miesiac varchar(15) 
);

CREATE TABLE rcardev_vehicle (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	marka varchar(30),
	typ varchar(30),
	rodzaj varchar(30),
	rej varchar(15),
	nrop varchar(15),
	zbior varchar(10),
	norma varchar(10),
	normap varchar(10),
	rcardev_id int
);

CREATE TABLE rcardev_usage (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	stkoniecbr varchar(10),
	stkoniecpo varchar(10),
	przebiegbr varchar(10),
	przebieg varchar(10),
	pdroz varchar(10),
	postoj varchar(10),
	rk varchar(10),
	razem varchar(10),
	rcardev_id int
);

CREATE TABLE rcardev_fuel1 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data varchar(25),
	faktura varchar(30),
	paliwo varchar(10),
	olej varchar(10),
	personal_id0 int,
	personal_id1 int,
	rcardev_id int

);

CREATE TABLE rcardev_fuel2 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	pozostalo_paliwo0 varchar(10),
	pozostalo_olej0 varchar(10),
	pobrano_paliwo varchar(10),
	pobrano_olej varchar(10),
	razem_paliwo0 varchar(10),
	razem_olej0 varchar(10),
	km varchar(10),
	kmz_paliwo varchar(10),
	kmz_olej varchar(10),
	minut varchar(10),
	m_paliwo varchar(10),
	m_olej varchar(10),
	rk varchar(10),
	rk_paliwo varchar(10),
	rk_olej varchar(10),
	razem_paliwo1 varchar(10),
	razem_olej1 varchar(10),
	pozostalo_paliwo1 varchar(10),
	pozostalo_olej1 varchar(10),
	rcardev_id int

	
);

CREATE TABLE rcardev_common2 (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	personal_id0 int,
	personal_id1 int,
	msc varchar(30),
	data varchar(25),
	personal_id2 int,
	rcardev_id int
	
);

CREATE TABLE rcardev_tab (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	data varchar(20),
	personal_id0 int,
	trasa text,
	cel text,
	personal_id1 int,
	ostanl int,
	pstanl int,
	dev int,
	personal_id2 int,
	rcardev_id int
	
);

CREATE TABLE rcardev_pompa (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	minut int,
	norma varchar(10),
	rcardev_id int
);

CREATE TABLE rcardev_web (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	minut int,
	norma varchar(10),
	rcardev_id int
);

CREATE TABLE hydrant (
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nazwa varchar(120),
	sz text,
	dl text
);

INSERT INTO user (username, passwd_hash, role)
VALUES ('admin', "$2y$10$KEEPwtuauoA0DegWuDO7fu8pSZZxc6HrD0j/327XWAlGd1Bq38su2", 'admin');

