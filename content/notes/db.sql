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
