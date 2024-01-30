drop function emailchecker;
delimiter $$
create function emailchecker(em varchar(255)) returns int 
begin
  declare c,flag int default 0;
  select count(email) into c from emails where email = em;
  if(c = 0) then set flag = 0;
  else set flag = 1;
  end if;
  return flag;
end $$
delimiter  ;
