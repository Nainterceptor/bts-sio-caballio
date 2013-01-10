Delimiter//
CREATE PROCEDURE modifier(in Nid int, in Nnom VARCHAR(20), in Nage int, in Ncouleur VARCHAR(6), in Npouvoir VARCHAR(255))
BEGIN
    UPDATE poney SET nom = Nnom, age = Nage, couleur = Ncouleur, pouvoir = Npouvoir WHERE id = Nid;
END;//
Delimiter ;