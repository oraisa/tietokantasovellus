CREATE TABLE Luser(
  id serial PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Tag(
  id serial PRIMARY KEY,
  owner integer,
  name varchar(50)
  FOREIGN KEY(owner) REFERENCES Luser(id)
);

CREATE TABLE Assignment(
  id serial PRIMARY KEY,
  name varchar(50),
  importance integer,
  deadline timestamp,
  description varchar(500),
  owner integer NOT NULL,
  tag integer,
  FOREIGN KEY(owner) REFERENCES Luser(id),
  FOREIGN KEY(tag) REFERENCES Tag(id)
);

CREATE TABLE TagParent(
  parent integer NOT NULL,
  child integer NOT NULL,
  FOREIGN KEY(parent) REFERENCES Tag(id),
  FOREIGN KEY(child) REFERENCES Tag(id)
);
