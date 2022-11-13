use pethero;

CREATE PROCEDURE `GetAllOwners` ()
	select * from owner o
	inner join user u on o.userid = u.userid;



/*------------------ User Procedure--------------------------------------------- */ 
create procedure `isUserExistAndValidateID`(emailFind varchar (100), usernameFind varchar(100), useridFind int)
	select * from user
    where email = emailFind and useridFind != userid and usernameFind = username;


create procedure `updateUser`(useridFind int, newEmail varchar(100),newUsername varchar(100),newPass varchar(50),newFirstName varchar(100),newLastName varchar(100), newDateBirth datetime)
update user set email = newEmail,
username = newUsername,
pass = newPass,
firstName = newfirstName,
lastName = newLastName,
dateBirth = newDateBirth
where useridFind = userid;


/*--------------------------------------------- Review------------------------------------------- */
create procedure `isReviewExist`(bookingid int)
	select * from review
    where bookingNr = bookingid;

create procedure `AddReview`(score int, comment varchar(1000),bookingNr int)
	INSERT INTO review(score,comment,bookingNr) VALUES(score, comment, bookingNr);

create procedure `GetReviewByKeeper`(keeperid int)
	select * from review
    where review.keeperid = keeperid;

create procedure `GetReviewByBooking`(bookingNr int)
	select * from review
    where review.bookingNr = bookingNr;


/*------------------------------------------- OWNER----------------------------------------------------*/
create procedure GetBookingsByOwnerId (ownerid int)
begin
	select 
		b.bookingNr, b.bookingDate , b.startDate, b.endDate, b.paidAmount, b.totalPrice , b.status
		,k.keeperid, k.reputation, k.fee, k.size 
		,u.userid, u.username, u.email, u.pass, u.firstName, u.lastName, u.dateBirth 
		,p.petid, p.name, p.birthDate, p.vaccinationPlan, p.picture, p.breed, p.size, p.video, p.comments
		,o.ownerid, o.userid as ouserid 
		,u2.username as ousername , u2.email as oemail , u2.pass as opass ,u2.firstName as ofirstName, u2.lastName as olastName, u2.dateBirth as odateBirth
	from booking b
	inner join pet p on p.petid = b.petid
	inner join keeper k on b.keeperid=k.keeperid 
	inner join user u on k.userid=u.userid
	inner join owner o on p.ownerid=o.ownerid
	inner join user u2 on u2.userid=o.userid
	where p.ownerid=ownerid;
end	


