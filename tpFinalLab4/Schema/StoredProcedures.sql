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

create procedure `GetAllReviewByKeeperId`(keeperid int)
    select r.bookingNr,u.username,r.score, r.comment,b.endDate from  review r 
    inner join booking b on b.bookingNr = r.bookingNr
    inner join keeper k  on b.keeperid = k.keeperid
    inner join user u on u.userid = k.userid
    where k.keeperid = keeperid;




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


/*---------------------------------------- FILE-----------------------------------------------------*/
create procedure `AddFile`(nameFile varchar (500) , typeFile varchar(100), sizefile double, tmp_namefile varchar (500),fullPath varchar (500),errorFile varchar (100))
	insert into File(nameFile, typefile, sizefile, tmp_nameFile,fullPath,errorFile) 
    values(nameFile,typeFile,sizefile,tmp_nameFile,fullPath,errorFile);

create procedure `GetFileByName`(nameFile varchar(100))
	select * from File
    where File.nameFile = nameFile


/*---------------------------------------- INVOICE-----------------------------------------------------*/
create procedure GetAllInvoices ()
begin 
	select 
		i.invoiceid, i.invoiceNr, i.invoiceDate, i.value 
		,b.bookingNr, b.bookingDate , b.startDate, b.endDate, b.paidAmount, b.totalPrice , b.status
		,p.petid, p.name, p.birthDate, p.vaccinationPlan, p.picture, p.breed, p.size, p.video, p.comments
		,o.ownerid, o.userid as ouserid
		,u2.username as ousername , u2.email as oemail , u2.pass as opass ,u2.firstName as ofirstName, u2.lastName as olastName, u2.dateBirth as odateBirth
	from invoice i
		inner join booking b on i.bookingNr=b.bookingNr 
		inner join pet p on b.petid=p.petid 
		inner join owner o on p.ownerid=o.ownerid
		inner join user u2 on o.userid=u2.userid;
end


/*---------------------------------------- PAYMENT-----------------------------------------------------*/
create procedure GetAllPayments ()
begin 
	select 
		py.paymentid,py.paymentDate, py.amount, py.paymentImage
		,i.invoiceid, i.invoiceNr, i.invoiceDate, i.value 
		,b.bookingNr, b.bookingDate , b.startDate, b.endDate, b.paidAmount, b.totalPrice , b.status
		,p.petid, p.name, p.birthDate, p.vaccinationPlan, p.picture, p.breed, p.size, p.video, p.comments
		,o.ownerid, o.userid as ouserid
		,u2.username as ousername , u2.email as oemail , u2.pass as opass ,u2.firstName as ofirstName, u2.lastName as olastName, u2.dateBirth as odateBirth
	from payment py
		inner join invoice i on py.invoiceid=i.invoiceid
		inner join booking b on i.bookingNr=b.bookingNr 
		inner join pet p on b.petid=p.petid 
		inner join owner o on p.ownerid=o.ownerid
		inner join user u2 on o.userid=u2.userid;
end



/* -----------------------------------------------KEEPER-------------------------------------*/
create procedure `updateKeeper`(keeperid int, fee int, size varchar (10))
	update keeper set keeper.fee = fee,
    keeper.size = size where keeper.keeperid = keeperid;

create procedure `updateReputation`(keeperid int, reputation float)
	update keeper set keeper.reputation = reputation
    where keeper.keeperid = keeperid;