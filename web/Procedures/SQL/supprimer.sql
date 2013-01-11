Delimiter //
CREATE PROCEDURE supprimer(in Nid int)
BEGIN
    DELETE FROM poney WHERE id = Nid;
END;//
Delimiter ;

