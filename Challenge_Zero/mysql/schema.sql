USE c0;

CREATE TABLE users (
    username char(64) NOT NULL,
    password char(64) NOT NULL
);

CREATE TABLE pages (
    page_id int,
    page_uri char(64),
    page_title char(64),
    page_thumbnail char(64)
);

CREATE TABLE secret_pages (
    page_id int,
    page_uri char(64),
    page_title char(64),
    page_thumbnail char(64)
);


INSERT INTO users VALUES ('tc_174812','2a8b3484cc216f51611d0f49b80029c66b5928df3939e344cb8d3dd4814c5bbc');
INSERT INTO users VALUES ('tc_133337','2d579cd75056723657b8fa68fa6626c245cd362030159965efbdf41da2d67adf');

INSERT INTO pages VALUES (1,'tie_fighter_speed.html','Tie Fighters', 'tf.png');
INSERT INTO pages VALUES (2,'storm_trooper_sharp_shooter.html','Storm Trooper Accuracy', 'st.png');
INSERT INTO pages VALUES (3,'death_star_reborn.html','Death Star Reborn', 'deathstar.jpeg');

INSERT INTO secret_pages VALUES (1,'super_secret_plans_message.html','Super Secret Plans Message', 'plan.jpg');