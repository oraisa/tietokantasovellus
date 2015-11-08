INSERT INTO User (id, username, password) VALUES (1, 'testi', 1234);
INSERT INTO Assingment (id, name, importance, deadline, description, owner, tag)
VALUES(
  1, 'Tiran tehtävät', 5, '2015-11-23 13:00:00', 'Laskarit, monisteen sivut 303-354',
  1, 1
);

INSERT INTO Tag(id, name) VALUES(1, 'Koulu');
INSERT INTO Tag(id, name) VALUES(2, 'Kotityö');
INSERT INTO Tag(id, name) VALUES(3, 'Tira');

INSERT INTO TagParent(parent, child) VALUES(1, 3);
