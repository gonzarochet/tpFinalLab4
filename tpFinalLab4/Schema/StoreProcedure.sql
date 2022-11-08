use pethero;

CREATE PROCEDURE `GetAllOwners` ()
	select * from owner o
	inner join user u on o.userid = u.userid;

