CREATE TABLE opettaja
(
opettajatunnus SERIAL PRIMARY KEY NOT NULL,
nimi varchar(80),
salasana varchar(12),
tehdyt integer[]
);

CREATE TABLE sana
(
sanatunnus SERIAL PRIMARY KEY NOT NULL,
kohde varchar(30),
kieli varchar(9),
kaannos varchar(30),
taivutus varchar(50),
sluokka integer,
artikkeli integer
);

CREATE TABLE sanasto
(
sanastotunnus SERIAL PRIMARY KEY NOT NULL,
nimi varchar(80),
kieli varchar(12),
kuvaus varchar(200),
maara int,
opetunnus integer references opettaja(opettajatunnus)
);

CREATE TABLE kuuluu
(
sanatunnus integer references sana(sanatunnus),
sanastotunnus integer references sanasto(sanastotunnus) 
);

CREATE TABLE oppilas
(
oppilastunnus SERIAL PRIMARY KEY NOT NULL,
nimi varchar(80),
salasana varchar(12),
tehdyt integer,
viimeksi timestamp
);

CREATE TABLE tentti
(
tenttitunnus SERIAL PRIMARY KEY NOT NULL,
tiedetyt integer[],
oppilastunnus integer references oppilas(oppilastunnus) 
);

CREATE TABLE tulos
(
tulostunnus SERIAL PRIMARY KEY NOT NULL,
yritykset integer,
viimeksi timestamp,
oppilastunnus integer references oppilas(oppilastunnus),
tenttitunnus integer references tentti(tenttitunnus)  
);

CREATE TABLE tenttii
(
tenttitunnus integer references tentti(tenttitunnus),
sanastotunnus integer references sanasto(sanastotunnus) 
);