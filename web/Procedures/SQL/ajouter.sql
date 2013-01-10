Delimiter//
CREATE PROCEDURE ajouter (in Nnom VARCHAR(20), in Nage int, in Ncouleur VARCHAR(6), in Npouvoir VARCHAR(255))
BEGIN
    INSERT INTO poney (nom, age, couleur, pouvoir) values (Nnom, Nage, Ncouleur, Npouvoir);
END;//
Delimiter ;