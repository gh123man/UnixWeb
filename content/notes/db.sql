create table Searchable (
    ID char(32) NOT NULL,
    title varchar(80) NOT NULL,
    content TEXT NOT NULL,
    path varchar(180) NOT NULL,
    PRIMARY KEY (ID),
    FULLTEXT KEY (content)
) ENGINE=MyISAM;

CREATE INDEX titleIndex
ON Searchable (title);


create table Account (
    ID char(32) NOT NULL,
    email varchar(256) NOT NULL,
    fname varchar(80) NOT NULL,
    lname varchar(80) NOT NULL,
    hash varchar(104) NOT NULL,
    salt varchar(32) NOT NULL,
    time int unsigned NOT NULL,

    PRIMARY KEY (ID)
);

CREATE INDEX emailIndex
ON Account (email);


create table QuizTracker (
    ID char(32) NOT NULL,
    user char(32) NOT NULL,
    name varchar(80) NOT NULL,
    score int unsigned NOT NULL,
    points int unsigned NOT NULL,
    path varchar(180) NOT NULL,
    time int unsigned NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (user) REFERENCES Account(ID)
);

CREATE INDEX userIndex
ON QuizTracker (user);

CREATE INDEX pathIndex
ON QuizTracker (path);



create table PageTracker (
    ID char(32) NOT NULL,
    name varchar(80) NOT NULL,
    hits int unsigned NOT NULL,
    path varchar(180) NOT NULL,
    type varchar(80) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE INDEX cmdPathIndex
ON PageTracker (path);

CREATE INDEX hitsIndex
ON PageTracker (hits);
