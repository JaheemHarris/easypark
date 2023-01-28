CREATE TABLE auth_role(
	id SERIAL PRIMARY KEY NOT NULL,
	role_name VARCHAR(20)
);

INSERT INTO auth_role(role_name) VALUES ('ROLE_ADMIN');
INSERT INTO auth_role(role_name) VALUES ('ROLE_USER');

CREATE TABLE auth_user(
	id SERIAL PRIMARY KEY NOT NULL,
	role_id INT NOT NULL,
	firstname VARCHAR(60),
	lastname VARCHAR(60),
	email VARCHAR(60),
	password VARCHAR(255),
	is_enabled INT DEFAULT 0,
	FOREIGN KEY (role_id) REFERENCES auth_role(id)
);

INSERT INTO auth_user(role_id,firstname,lastname,email,password,is_enabled) VALUES (1,'Jaheem','Harris','jaheemharris@gmail.com',md5('jaheemisadmin'),1);
INSERT INTO auth_user(role_id,firstname,lastname,email,password,is_enabled) VALUES (2,'Oladada','Phan','oladada@gmail.com',md5('jaheemisadmin'),1);

CREATE TABLE heure_actuelle(
	id SERIAL PRIMARY KEY NOT NULL,
	heure TIME DEFAULT CURRENT_TIME
);

CREATE TABLE place(
	id SERIAL PRIMARY KEY NOT NULL,
	numero VARCHAR(10),
	est_occupe INT DEFAULT 0,
	est_desactive INT DEFAULT 0
);

INSERT INTO place(numero) VALUES ('P1A');
INSERT INTO place(numero) VALUES ('P2A');
INSERT INTO place(numero) VALUES ('P3A');
INSERT INTO place(numero) VALUES ('P1B');
INSERT INTO place(numero) VALUES ('P2B');
INSERT INTO place(numero) VALUES ('P3B');

INSERT INTO place(numero) VALUES ('P1C');
INSERT INTO place(numero) VALUES ('P2C');
INSERT INTO place(numero) VALUES ('P3C');
INSERT INTO place(numero) VALUES ('P1D');
INSERT INTO place(numero) VALUES ('P2D');
INSERT INTO place(numero) VALUES ('P3D');

INSERT INTO place(numero) VALUES ('P1E');
INSERT INTO place(numero) VALUES ('P2E');
INSERT INTO place(numero) VALUES ('P3E');
INSERT INTO place(numero) VALUES ('P1F');
INSERT INTO place(numero) VALUES ('P2F');
INSERT INTO place(numero) VALUES ('P3F');

INSERT INTO place(numero) VALUES ('P1G');
INSERT INTO place(numero) VALUES ('P2G');

CREATE TABLE tarif(
	id SERIAL PRIMARY KEY NOT NULL,
	delai TIME,
	prix DECIMAL DEFAULT 0
);

INSERT INTO tarif(delai,prix) VALUES ('00:15:00',2000);
INSERT INTO tarif(delai,prix) VALUES ('00:30:00',7000);
INSERT INTO tarif(delai,prix) VALUES ('01:00:00',15000);
INSERT INTO tarif(delai,prix) VALUES ('02:00:00',22500);

CREATE TABLE placement_voiture(
	id SERIAL PRIMARY KEY NOT NULL,
	id_place INT NOT NULL,
	id_tarif INT NOT NULL,
	id_user INT NOT NULL,
	numero_voiture VARCHAR(10),
	date_arrivee DATE DEFAULT CURRENT_DATE,
	heure_arrivee TIME DEFAULT CURRENT_TIME,
	heure_depart TIME DEFAULT NULL,
	heure_prevue TIME,
	montant DECIMAL,
	remise VARCHAR(40),
	FOREIGN KEY (id_user) REFERENCES auth_user(id),
	FOREIGN KEY (id_place) REFERENCES place(id),
	FOREIGN KEY (id_tarif) REFERENCES tarif(id)
);

CREATE TABLE wallet(
	id SERIAL PRIMARY KEY NOT NULL,
	user_id INT NOT NULL,
	entry DECIMAL DEFAULT 0,
	exit DECIMAL DEFAULT 0,
	transaction_date DATE DEFAULT CURRENT_DATE,
	status INT DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES auth_user(id)
);

-- INSERT INTO wallet(user_id,entry) VALUES (2,45000);

CREATE TABLE amende(
	id SERIAL PRIMARY KEY NOT NULL,
	montant DECIMAL DEFAULT 0
);

INSERT INTO amende(montant) VALUES ('100000'); 
-- -- SELECT *,(heure_arrivee + interval CAST(delai AS VARCHAR)) AS test  FROM liste_place lp JOIN amende  a ON a.id!=0  WHERE id_place = 6;

-- SELECT *, (heure_prevue - '12:00'::time) heure_reste, CASE WHEN (heure_prevue - '12:00'::time)< '00:00' THEN 1 ELSE 0 END infraction FROM liste_place;

CREATE OR REPLACE VIEW nonvalid_recharge AS
SELECT
	w.id,
	w.entry,
	w.transaction_date,
	w.user_id,
	au.firstname,
	au.lastname,
	au.email
FROM wallet w
LEFT JOIN auth_user au
ON w.user_id = au.id
WHERE w.status = 0;

CREATE OR REPLACE VIEW wallet_amount AS
WITH wallet_valid AS (SELECT * FROM wallet WHERE status = 1)
SELECT
	au.id as user_id,
	COALESCE(SUM(entry-exit),0) AS amount
FROM wallet_valid w
RIGHT JOIN auth_user au
ON w.user_id = au.id
GROUP BY au.id;

CREATE OR REPLACE FUNCTION get_now()
RETURNS TIME
LANGUAGE plpgsql
AS
$$
DECLARE 
	heure_now TIME;
BEGIN
	SELECT heure INTO heure_now FROM heure_actuelle LIMIT 1;

	IF heure_now IS NULL THEN RETURN (SELECT LOCALTIME(0)); END IF; 

	RETURN heure_now;
END;
$$;

-- INSERT INTO heure_actuelle(heure) VALUES ('11:00:00');


-- CREATE OR REPLACE VIEW place_occupee AS
-- SELECT
-- 	pvt.id AS id_park,
-- 	pvt.id_place,
-- 	pvt.numero_voiture,
-- 	pvt.date_arrivee,
-- 	pvt.heure_arrivee,
-- 	pvt.heure_depart,
-- 	pvt.heure_prevue,
-- 	t.id as id_tarif,
-- 	t.delai,
-- 	t.prix
-- FROM placement_voiture pvt
-- LEFT JOIN place p 
-- ON pvt.id_place = p.id
-- LEFT JOIN tarif t
-- ON t.id = pvt.id_tarif
-- WHERE p.est_occupe = 1 AND heure_depart IS NULL;


-- CREATE OR REPLACE VIEW liste_place AS
-- SELECT
-- 	p.id As id_place,
-- 	p.numero,
-- 	p.est_occupe,
-- 	po.id_park,
-- 	po.numero_voiture,
-- 	po.date_arrivee,
-- 	po.heure_arrivee,
-- 	po.heure_depart,
-- 	po.heure_prevue,
-- 	po.id_tarif,
-- 	po.delai,
-- 	po.prix
-- FROM place p
-- LEFT JOIN place_occupee po
-- ON p.id = po.id_place;

-- WITH t1 AS (SELECT * FROM tarif), t2 AS (SELECT * FROM tarif ) SELECT * FROM t1;
-- -- SELECT *,(heure_arrivee + interval CAST(delai AS VARCHAR)) AS test  FROM liste_place lp JOIN amende  a ON a.id!=0  WHERE id_place = 6;

-- SELECT *, (heure_prevue - '12:00'::time) heure_reste, CASE WHEN (heure_prevue - '12:00'::time)< '00:00' THEN 1 ELSE 0 END infraction FROM liste_place;

-- CREATE OR REPLACE FUNCTION test_liste(heure_now TIME)
-- RETURNS TABLE(id_place INT,numero VARCHAR(20),est_occupe INT,id_park INT,
-- 			numero_voiture VARCHAR(20),date_arrivee DATE,heure_arrivee TIME,
-- 			heure_depart TIME,heure_prevue TIME, id_tarif INT,delai TIME,prix DECIMAL,
-- 			heure_reste VARCHAR(20), infraction INT, montant_amende DECIMAL)
-- LANGUAGE plpgsql
-- AS $$
-- BEGIN
-- 	RETURN QUERY
-- 	WITH occupee AS (
-- 		SELECT
-- 		pvt.id AS id_park,
-- 		pvt.id_place,
-- 		pvt.numero_voiture,
-- 		pvt.date_arrivee,
-- 		pvt.heure_arrivee,
-- 		pvt.heure_depart,
-- 		pvt.heure_prevue,
-- 		t.id as id_tarif,
-- 		t.delai,
-- 		t.prix 
-- 	FROM placement_voiture pvt
-- 	LEFT JOIN place p 
-- 	ON pvt.id_place = p.id
-- 	LEFT JOIN tarif t
-- 	ON t.id = pvt.id_tarif
-- 	WHERE p.est_occupe = 1 AND pvt.heure_depart IS NULL AND pvt.heure_arrivee <= heure_now
-- 	),liste AS (SELECT
-- 		p.id As id_place,
-- 		p.numero,
-- 		CASE WHEN po.id_park IS NULL THEN 0 WHEN po.id_park IS NOT NULL THEN 1 END est_occupe,
-- 		po.id_park,
-- 		po.numero_voiture,
-- 		po.date_arrivee,
-- 		po.heure_arrivee,
-- 		po.heure_depart,
-- 		po.heure_prevue,
-- 		po.id_tarif,
-- 		po.delai,
-- 		po.prix
-- 	FROM place p
-- 	LEFT JOIN occupee po
-- 	ON p.id = po.id_place)
-- 	SELECT 
-- 		l.*,
-- 		CAST((l.heure_prevue - heure_now) AS VARCHAR(20)),
-- 		CASE WHEN (l.heure_prevue - heure_now)< '00:00' THEN 1 ELSE 0 END infraction,
-- 		CASE 
-- 			WHEN 
-- 				l.id_park IS NOT NULL 
-- 				AND (l.heure_prevue - heure_now)< '00:00' 
-- 			THEN a.montant*(CEILING((CAST((EXTRACT(EPOCH  FROM (l.heure_prevue - heure_now))/60) AS DECIMAL))/-25))
-- 			ELSE 0 END montant_amende
-- 	FROM liste l LEFT JOIN amende a ON a.id!=0;
-- END;
-- $$;


CREATE OR REPLACE FUNCTION test_liste(heure_now TIME)
RETURNS TABLE(id_place INT,numero VARCHAR(20),est_occupe INT,est_desactive INT,id_park INT,
			numero_voiture VARCHAR(20),date_arrivee DATE,heure_arrivee TIME,
			heure_depart TIME,heure_prevue TIME, montant DECIMAL, id_tarif INT,delai TIME,prix DECIMAL,
			heure_reste VARCHAR(20), infraction INT, montant_amende DECIMAL)
LANGUAGE plpgsql
AS $$
BEGIN
	RETURN QUERY
	WITH occupee AS (
		SELECT
		pvt.id AS id_park,
		pvt.id_place,
		pvt.numero_voiture,
		pvt.date_arrivee,
		pvt.heure_arrivee,
		pvt.heure_depart,
		pvt.heure_prevue,
		pvt.montant,
		t.id as id_tarif,
		t.delai,
		t.prix 
	FROM placement_voiture pvt
	LEFT JOIN place p 
	ON pvt.id_place = p.id
	LEFT JOIN tarif t
	ON t.id = pvt.id_tarif
	WHERE p.est_occupe = 1 AND pvt.heure_depart IS NULL AND pvt.heure_arrivee <= heure_now
	),liste AS (SELECT
		p.id As id_place,
		p.numero,
		CASE WHEN po.id_park IS NULL THEN 0 WHEN po.id_park IS NOT NULL THEN 1 END est_occupe,
		p.est_desactive,
		po.id_park,
		po.numero_voiture,
		po.date_arrivee,
		po.heure_arrivee,
		po.heure_depart,
		po.heure_prevue,
		po.montant,
		po.id_tarif,
		po.delai,
		po.prix
	FROM place p
	LEFT JOIN occupee po
	ON p.id = po.id_place)
	SELECT 
		l.*,
		CAST((l.heure_prevue - heure_now) AS VARCHAR(20)),
		CASE WHEN (l.heure_prevue - heure_now)< '00:00' THEN 1 ELSE 0 END infraction,
		CASE 
			WHEN 
				l.id_park IS NOT NULL 
				AND (l.heure_prevue - heure_now)< '00:00'
			THEN a.montant
			ELSE 0 END montant_amende
	FROM liste l LEFT JOIN amende a ON a.id!=0;
END;
$$;






