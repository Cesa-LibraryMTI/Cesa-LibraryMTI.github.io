delimiter //
CREATE FUNCTION inserter(utype CHAR(1),uname varchar(32),pword varchar(32)) RETURNS INT
BEGIN
  DECLARE c1,c2,c3 INT DEFAULT 0;
  DECLARE nuid INT;
  DECLARE flag,illegal INT DEFAULT 0;
  SET nuid = FLOOR(RAND()*9000+5000); 
  SELECT count(userid) into c2 from users where username = uname;
  IF (c2 = 0) THEN
    REPEAT
    SELECT count(userid) into c1 from users where userid = nuid;
    IF(c1 != 0) THEN
      SET nuid = FLOOR(RAND()*9000+5000);
    ELSE
      set flag = 1;
    END IF;
    UNTIL flag=1 END REPEAT;
  ELSE SET illegal = 1;
  END IF;
  IF(!illegal) THEN INSERT INTO users values (nuid,utype,uname,pword);
  END IF;
  RETURN illegal;
END //
delimiter  ;