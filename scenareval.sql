INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (3,'Sachet de 0,5 kg de cote de porc','Sachet',12000,500,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (6,'Bouteilles Huile','Bouteille',3500,250,'ml');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (6,'Sachet de 0,25 kg de sel','Sachet',500,500,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (2,'Pack 1 kg de pomme de terre','Pack',1650,1000,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (2,'Pack 0,5 kg de carotte','Pack',1300,500,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (2,'Pack 0,33 kg de poireau','Pack',1000,330,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (2,'Boite 250 g de haricot','Boite',2200,250,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (6,'Pack 6 bouteilles de Cristalline','Bouteilles',9000,6,'bouteilles');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (1,'250 g de Fromage','Fromage',6600,250,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (3,'Sachet 750 g Viande de boeuf','Viande',17320,750,'g');
INSERT INTO product(category_id,product_name,details,price,qty,unit) VALUES (1,'Barquette glace vanille','Barquette',21000,1,'barquette');

INSERT INTO product_image(product_id,image_name) VALUES (1,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (2,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (3,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (4,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (5,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (6,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (7,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (8,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (9,'model1.jpg');
INSERT INTO product_image(product_id,image_name) VALUES (10,'model1.jpg');

INSERT INTO receipt(receipt_name,receipt_image) VALUES ('Cote de porc aux petits legumes pour 4 personnes','model1.jpg');

INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (1,1,750);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (1,2,2);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (1,4,1000);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (1,5,1000);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (1,6,500); 


INSERT INTO receipt(receipt_name,receipt_image) VALUES ('Henomby sy tsaramaso pour 4 personnes','model1.jpg');

INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (2,10,500);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (2,7,600);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (2,6,100);
INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (2,2,50);

INSERT INTO auth_user(role_id,firstname,lastname,email,phone,password,is_enabled)
    VALUES (2,'Rakoto','kaly','Rakoto@kaly.com','0341918116',md5('jaheemisadmin'),1);

INSERT INTO stock(product_id,entry) VALUES (1,100);
INSERT INTO stock(product_id,entry) VALUES (2,100);
INSERT INTO stock(product_id,entry) VALUES (3,100);
INSERT INTO stock(product_id,entry) VALUES (4,100);
INSERT INTO stock(product_id,entry) VALUES (5,100);
INSERT INTO stock(product_id,entry) VALUES (6,100);
INSERT INTO stock(product_id,entry) VALUES (7,100);
INSERT INTO stock(product_id,entry) VALUES (8,100);
INSERT INTO stock(product_id,entry) VALUES (9,100);
INSERT INTO stock(product_id,entry) VALUES (10,100);
INSERT INTO stock(product_id,entry) VALUES (11,100);

UPDATE stock SET stock_date = (SELECT CURRENT_DATE);
-- UPDATE receipt_formula SET percentage = 30.3030303 WHERE id = 3;
-- UPDATE receipt_formula SET percentage = 80 WHERE id = 2;
