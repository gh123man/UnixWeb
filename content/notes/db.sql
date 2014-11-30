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
