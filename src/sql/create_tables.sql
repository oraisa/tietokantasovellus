CREATE TABLE User(
  id integer PRIMARY KEY,
  username varchar(50),
  password varchar(50)
);

CREATE TABLE Assingment(
  id integer PRIMARY KEY,
  name varchar(50),
  importance integer,
  deadline timestamp,
  description varchar(500),
  owner integer,
  tag integer,
  FOREIGN KEY(owner) REFERENCES User(id),
  FOREIGN KEY(tag) REFERENCES Tag(id)
);

CREATE TABLE Tag(
  id integer PRIMARY KEY,
  name varchar(50)
);

CREATE TABLE TagParent(
  parent integer,
  child integer,
  FOREIGN KEY(parent) REFERENCES Tag(id),
  FOREIGN KEY(child) REFERENCES Tag(id)
);
