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
create procedure `GetBookingsByOwner`(ownerid int)
	select bookingNr, bookingDate, startDate , endDate, keeperid , booking.petid, totalprice, paidAmount, isAccepted from booking
	inner join pet on pet.ownerid = ownerid;


/*---------------------------------------- FILE-----------------------------------------------------*/
create procedure `AddFile`(nameFile varchar (100) , typeFile varchar(100), sizefile double, tmp_namefile varchar (100))
	insert into File(nameFile, ypefile, sizefile, tmp_nameFile) 
    values(nameFile,typeFile,sizefile,tmp_nameFile);