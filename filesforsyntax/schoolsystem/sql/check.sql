delimiter //
CREATE FUNCTION checker(uname varchar(32),pass varchar(32)) RETURNS INT
BEGIN
  DECLARE counter INT DEFAULT 0;
  DECLARE exist INT DEFAULT 0;
  select count(userid) into counter FROM users WHERE username = uname AND password = pass;
  IF(counter = 1) THEN SET exist = 1;
  ELSE SET exist = 0;
  END IF;
  RETURN exist;
END //
delimiter  ;
