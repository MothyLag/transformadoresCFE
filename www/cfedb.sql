CREATE TABLE IF NOT EXISTS retirado(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_instalado INTEGER,
  fecha TEXT NOT NULL,
  ubicacion TEXT,
  responsable TEXT,
  num_circuito TEXT,
  causa TEXT,
  coordenadas TEXT,
  marca TEXT,
  capacidad TEXT,
  fases INT,
  voltmed TEXT,
  voltbaj TEXT,
  no_serie TEXT,
  no_econo TEXT,
  tipo TEXT,
  tipo2 TEXT,
  aceite  TEXT,
  peso TEXT,
  causadan TEXT,
  clavedan TEXT,
  condiciones TEXT
);
CREATE TABLE IF NOT EXISTS instalado(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  fecha TEXT NOT NULL,
  ubicacion TEXT,
  responsable TEXT,
  num_circuito TEXT,
  causa TEXT,
  coordenadas TEXT,
  marca TEXT,
  capacidad TEXT,
  fases INT,
  voltmed TEXT,
  voltbaj TEXT,
  no_serie TEXT,
  No_econo TEXT,
  tipo TEXT,
  tipo2 TEXT,
  aceite TEXT,
  peso TEXT,
  condiciones TEXT
);

--pruebas
INSERT INTO retirado (fecha,ubicacion,responsable,num_circuito,causa) VALUES("20/05/2017","calle juarez","E.A.M","tze 4820","daño en x3");
ALTER TABLE retirado ADD COLUMN f_fab STRING;
ALTER TABLE retirado ADD COLUMN f_rep STRING;

ALTER TABLE instalado ADD COLUMN f_fab STRING;
ALTER TABLE instalado ADD COLUMN f_rep STRING;

ALTER TABLE retirado ADD COLUMN taller STRING;
