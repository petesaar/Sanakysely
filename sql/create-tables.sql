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
sluokka varchar(15),
artikkeli varchar(5)
);

CREATE TABLE sanasto
(
sanastotunnus SERIAL PRIMARY KEY NOT NULL,
nimi varchar(80),
kieli varchar(12),
kuvaus varchar(200),
maara integer,
tehty date,
opetunnus integer references opettaja(opettajatunnus)
);

CREATE TABLE kuuluu
(
sanatunnus integer references sana(sanatunnus) ON DELETE cascade,
sanastotunnus integer references sanasto(sanastotunnus) ON DELETE cascade 
);

CREATE TABLE oppilas
(
oppilastunnus SERIAL PRIMARY KEY NOT NULL,
nimi varchar(80),
salasana varchar(12),
tehdyt integer,
viimeksi date
);

CREATE TABLE tentti
(
tenttitunnus SERIAL PRIMARY KEY NOT NULL,
suunta integer,
tulos integer,
aika timestamp,
oikeinVastatut integer,
vaarinVastatut integer,
oppilastunnus integer references oppilas(oppilastunnus) ON DELETE cascade,
sanastotunnus integer references sanasto(sanastotunnus) ON DELETE cascade 
);

