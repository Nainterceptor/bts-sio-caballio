Delimiter//
CREATE PROCEDURE lister (in order varchar(10))
BEGIN
    IF order = 0 OR order IS NULL
        THEN SELECT * FROM poney;
    ELSE
        SELECT * FROM poney ORDER BY order;
    END IF;
END;//
Delimiter ;
