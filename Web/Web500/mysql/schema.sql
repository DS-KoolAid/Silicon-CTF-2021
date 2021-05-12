USE silicon;

CREATE TABLE login_table (
name char(64) NOT NULL,
pw_hash char(64) NOT NULL,
otp_date int(11)
);

CREATE TABLE flag_t (
id int,
flag char(64)
);


INSERT INTO login_table VALUES ('admin','2fdde255d49fe7fc6f3323614bb55994c55db86142df93c2e4cb11570521fe54',1618288256);
INSERT INTO flag_t VALUES (1,'flag{Type_Juggling_f0r_th3_w1n}');



-- Full hash: 2fdde255d49fe7fc6f3323614bb55994c55db86142df93c2e4cb11570521fe54
-- Actual password: nHMx.z3iYN*A7WsGJCH