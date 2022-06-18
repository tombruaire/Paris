Drop database if exists paris;
Create database paris;
Use paris;

Create table user (
	iduser int(3) not null auto_increment,
	nom varchar(50) not null,
	prenom varchar(50) not null,
	tel varchar(10) not null UNIQUE,
	email varchar(100) not null UNIQUE,
	mdp varchar(255) not null,
	droits enum("user", "admin"),
	primary key (iduser)
) ENGINE=InnoDB;

Drop trigger if exists crypterMdpUserInsert;
Delimiter //
Create trigger crypterMdpUserInsert
Before insert on user
For each row
Begin
	set new.mdp = sha1(new.mdp);
End //
Delimiter ;

Drop trigger if exists crypterMdpUserUpdate;
Delimiter //
Create trigger crypterMdpUserUpdate
Before update on user
For each row
Begin
	set new.mdp = sha1(new.mdp);
End //
Delimiter ;

Create table histoUser as select *, sysdate() dateHeureAction, user() user, '__________' action
From user
Where 2=0;

Alter table histoUser add primary key (iduser, dateHeureAction);

Create or replace view vHistoUser (iduser, nom, prenom, tel, email, mdp, droits, dateHeureAction, user, action)
as select iduser, nom, prenom, tel, email, mdp, droits, date_format(dateHeureAction, '%d/%m/%Y %H:%i'), user, action
from histoUser;

Drop trigger if exists insertHistoUser;
Delimiter //
Create trigger insertHistoUser
After insert on user
For each row
Begin
	insert into histoUser select *, sysdate(), user(), 'INSERT'
	from user
	where iduser = new.iduser;
End //
Delimiter ;

Drop trigger if exists updateHistoUser;
Delimiter //
Create trigger updateHistoUser
Before update on user
For each row
Begin
	insert into histoUser select *, sysdate(), user(), 'UPDATE'
	from user
	where iduser = old.iduser;
End //
Delimiter ;

Drop trigger if exists deleteHistoUser;
Delimiter //
Create trigger deleteHistoUser
Before delete on user
For each row
Begin
	insert into histoUser select *, sysdate(), user(), 'DELETE'
	from user
	where iduser = old.iduser;
End //
Delimiter ;

Drop function if exists countTelUser;
Delimiter //
Create function countTelUser(f_tel varchar(10))
Returns int
Begin
	select count(*) from user where tel = f_tel into @result;
	return @result;
End //
Delimiter ;

Drop trigger if exists checkTelUserInsert;
Delimiter //
Create trigger checkTelUserInsert
Before insert on user
For each row
Begin
	if countTelUser(new.tel)
		then signal sqlstate '45000'
		set message_text = 'Téléphone déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkTelUserUpdate;
Delimiter //
Create trigger checkTelUserUpdate
Before update on user
For each row
Begin
	if countTelUser(new.tel)
		then signal sqlstate '45000'
		set message_text = 'Téléphone déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop function if exists countEmailUser;
Delimiter //
Create function countEmailUser(f_email varchar(100))
Returns int
Begin
	select count(*) from user where email = f_email into @result;
	return @result;
End //
Delimiter ;

Drop trigger if exists checkEmailUserInsert;
Delimiter //
Create trigger checkEmailUserInsert
Before insert on user
For each row
Begin
	if countEmailUser(new.email)
		then signal sqlstate '45000'
		set message_text = 'Adresse email déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkEmailUserUpdate;
Delimiter //
Create trigger checkEmailUserUpdate
Before update on user
For each row
Begin
	if countEmailUser(new.email)
		then signal sqlstate '45000'
		set message_text = 'Adresse email déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop trigger if exists upperNomUserInsert;
Delimiter //
Create trigger upperNomUserInsert
Before insert on user
For each row
Begin
	set new.nom = upper(new.nom);
End //
Delimiter ;

Drop trigger if exists upperNomUserUpdate;
Delimiter //
Create trigger upperNomUserUpdate
Before update on user
For each row
Begin
	set new.nom = upper(new.nom);
End //
Delimiter ;

Drop trigger if exists ucasePrenomUserInsert;
Delimiter //
Create trigger ucasePrenomUserInsert
Before insert on user
For each row
Begin
	set new.prenom = concat(ucase(left(new.prenom,1)), lcase(substring(new.prenom,2)));
End //
Delimiter ;

Drop trigger if exists ucasePrenomUserUpdate;
Delimiter //
Create trigger ucasePrenomUserUpdate
Before update on user
For each row
Begin
	set new.prenom = concat(ucase(left(new.prenom,1)), lcase(substring(new.prenom,2)));
End //
Delimiter ;

Insert into user values
(null, "ADMIN", "Tom", "0606060606", "admin@gmail.com", "123", "admin"),
(null, "USER", "Tom", "0707070707", "user@gmail.com", "456", "user");

Create table evenement (
	idevent int(3) not null auto_increment,
	designation varchar(50) not null,
	dateevent date,
	heureevent time,
	lieuevent varchar(50),
	inscrits int(11),
	description longtext,
	prixplace decimal(6,2),
	placestotal int(11),
	primary key (idevent)
) ENGINE=InnoDB;

Create or replace view vevenements(idevent, designation, dateevent, heureevent, lieuevent, inscrits, description, prixplace, placestotal)
as select idevent, designation, date_format(dateevent, '%d/%m/%Y'), date_format(heureevent, '%H:%i'), lieuevent, inscrits, description, prixplace, placestotal
from evenement;

Create table histoEvent as select *, sysdate() dateHeureAction, user() user, '__________' action
From evenement
Where 2=0;

Alter table histoEvent add primary key (idevent, dateHeureAction);

Create or replace view vhistoEvent (idevent, designation, dateevent, heureevent, lieuevent, inscrits, description, prixplace, placestotal, dateHeureAction, user, action)
as select idevent, designation, date_format(dateevent, '%d/%m/%Y'), date_format(heureevent, '%H:%i'), lieuevent, inscrits, description, prixplace, placestotal, date_format(dateHeureAction, '%d/%m/%Y %H:%i'), user, action
from histoEvent;

Drop trigger if exists insertHistoEvent;
Delimiter //
Create trigger insertHistoEvent
After insert on evenement
For each row
Begin
	insert into histoEvent select *, sysdate(), user(), 'INSERT'
	from evenement
	where idevent = new.idevent;
End //
Delimiter ;

Drop trigger if exists updateHistoEvent;
Delimiter //
Create trigger updateHistoEvent
Before update on evenement
For each row
Begin
	insert into histoEvent select *, sysdate(), user(), 'UPDATE'
	from evenement
	where idevent = old.idevent;
End //
Delimiter ;

Drop trigger if exists deleteHistoEvent;
Delimiter //
Create trigger deleteHistoEvent
Before delete on evenement
For each row
Begin
	insert into histoEvent select *, sysdate(), user(), 'DELETE'
	from evenement
	where idevent = old.idevent;
End //
Delimiter ;

Drop trigger if exists checkDateEventInsert;
Delimiter //
Create trigger checkDateEventInsert
Before insert on evenement
For each row
Begin
	if new.dateevent < curdate()
		then signal sqlstate '45000'
		set message_text = 'La date de l\'évènement de ne peut pas être inférieur à la date du jour';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkDateEventUpdate;
Delimiter //
Create trigger checkDateEventUpdate
Before update on evenement
For each row
Begin
	if new.dateevent < curdate()
		then signal sqlstate '45000'
		set message_text = 'La date de l\'évènement de ne peut pas être inférieur à la date du jour';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkNbInscritInsert;
Delimiter //
Create trigger checkNbInscritInsert
Before insert on evenement
For each row
Begin
	if new.inscrits < 0
		then signal sqlstate '45000'
		set message_text = 'Le nombre d\'inscrit ne peut pas être inférieur à 0';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkNbInscritUpdate;
Delimiter //
Create trigger checkNbInscritUpdate
Before update on evenement
For each row
Begin
	if new.inscrits < 0
		then signal sqlstate '45000'
		set message_text = 'Le nombre d\'inscrit ne peut pas être inférieur à 0';
	end if ;
End //
Delimiter ;


Drop trigger if exists checkPrixPlaceInsert;
Delimiter //
Create trigger checkPrixPlaceInsert
Before insert on evenement
For each row
Begin
	if new.prixplace < 0
		then signal sqlstate '45000'
		set message_text = 'Le prix de la place ne peut pas être inférieur à 0';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkPrixPlaceUpdate;
Delimiter //
Create trigger checkPrixPlaceUpdate
Before update on evenement
For each row
Begin
	if new.prixplace < 0
		then signal sqlstate '45000'
		set message_text = 'Le prix de la place ne peut pas être inférieur à 0';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkPlacesTotalesInsert;
Delimiter //
Create trigger checkPlacesTotalesInsert
Before insert on evenement
For each row
Begin
	if new.placestotal < new.inscrits
		then signal sqlstate '45000'
		set message_text = 'Le nombre d\'inscrit ne peut pas être supérieur au nombre de places totales';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkPlacesTotalesUpdate;
Delimiter //
Create trigger checkPlacesTotalestUpdate
Before update on evenement
For each row
Begin
	if new.placestotal < new.inscrits
		then signal sqlstate '45000'
		set message_text = 'Le nombre d\'inscrit ne peut pas être supérieur au nombre de places totales';
	end if ;
End //
Delimiter ;

Insert into evenement values
(null, "Chasse au trésor", "2022-07-15", "10:00", "Paris", 734, "Chasse au trésor", 10, 1000),
(null, "Fête de l'été", "2022-06-28", "10:00", "Levallois", 100, "Attractions", 10, 3000);

Create table personne (
	idpers int(3) not null auto_increment,
	nom varchar(50) not null,
	prenom varchar(50) not null,
	email varchar(100) not null UNIQUE,
	tel varchar(10) not null UNIQUE,
	adresse varchar(100),
	primary key (idpers)
) ENGINE=InnoDB;

Create table histoPersonne as select *, sysdate() dateHeureAction, user() user, '__________' action
From personne
Where 2=0;

Alter table histoPersonne add primary key (idpers, dateHeureAction);

Create or replace view vHistoPersonne (idpers, nom, prenom, email, tel, adresse, dateHeureAction, user, action)
as select idpers, nom, prenom, email, tel, adresse, date_format(dateHeureAction, '%d/%m/%Y %H:%i'), user, action
from histoPersonne;

Drop trigger if exists insertHistoPersonne;
Delimiter //
Create trigger insertHistoPersonne
After insert on personne
For each row
Begin
	insert into histoPersonne select *, sysdate(), user(), 'INSERT'
	from personne
	where idpers = new.idpers;
End //
Delimiter ;

Drop trigger if exists updateHistoPersonne;
Delimiter //
Create trigger updateHistoPersonne
Before update on personne
For each row
Begin
	insert into histoPersonne select *, sysdate(), user(), 'UPDATE'
	from personne
	where idpers = old.idpers;
End //
Delimiter ;

Drop trigger if exists deleteHistoPersonne;
Delimiter //
Create trigger deleteHistoPersonne
Before delete on personne
For each row
Begin
	insert into histoPersonne select *, sysdate(), user(), 'DELETE'
	from personne
	where idpers = old.idpers;
End //
Delimiter ;

Drop function if exists countEmailPersonne;
Delimiter //
Create function countEmailPersonne(f_email varchar(100))
Returns int
Begin
	select count(*) from personne where email = f_email into @result;
	return @result;
End //
Delimiter ;

Drop trigger if exists checkEmailPersonneInsert;
Delimiter //
Create trigger checkEmailPersonneInsert
Before insert on personne
For each row
Begin
	if countEmailPersonne(new.email)
		then signal sqlstate '45000'
		set message_text = 'Adresse email déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkEmailPersonneUpdate;
Delimiter //
Create trigger checkEmailPersonneUpdate
Before update on personne
For each row
Begin
	if countEmailPersonne(new.email)
		then signal sqlstate '45000'
		set message_text = 'Adresse email déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop function if exists countTelPersonne;
Delimiter //
Create function countTelPersonne(f_tel varchar(10))
Returns int
Begin
	select count(*) from personne where tel = f_tel into @result;
	return @result;
End //
Delimiter ;

Drop trigger if exists checkTelPersonneInsert;
Delimiter //
Create trigger checkTelPersonneInsert
Before insert on personne
For each row
Begin
	if countTelPersonne(new.tel)
		then signal sqlstate '45000'
		set message_text = 'Téléphone déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop trigger if exists checkTelPersonneUpdate;
Delimiter //
Create trigger checkTelPersonneUpdate
Before update on personne
For each row
Begin
	if countTelPersonne(new.tel)
		then signal sqlstate '45000'
		set message_text = 'Téléphone déjà utilisée !';
	end if ;
End //
Delimiter ;

Drop trigger if exists upperNomPersonneInsert;
Delimiter //
Create trigger upperNomPersonneInsert
Before insert on personne
For each row
Begin
	set new.nom = upper(new.nom);
End //
Delimiter ;

Drop trigger if exists upperNomPersonneUpdate;
Delimiter //
Create trigger upperNomPersonneUpdate
Before update on personne
For each row
Begin
	set new.nom = upper(new.nom);
End //
Delimiter ;

Drop trigger if exists ucasePrenomPersonneInsert;
Delimiter //
Create trigger ucasePrenomPersonneInsert
Before insert on personne
For each row
Begin
	set new.prenom = concat(ucase(left(new.prenom,1)), lcase(substring(new.prenom,2)));
End //
Delimiter ;

Drop trigger if exists ucasePrenomPersonneUpdate;
Delimiter //
Create trigger ucasePrenomPersonneUpdate
Before update on personne
For each row
Begin
	set new.prenom = concat(ucase(left(new.prenom,1)), lcase(substring(new.prenom,2)));
End //
Delimiter ;

Insert into personne values
(null, "BRUAIRE", "Tom", "t@gmail.com", "0606060606", "5 rue de Levallois"),
(null, "BEHAHMED", "Okacha", "o@gmail.com", "0707070707", "8 rue de Paris"),
(null, "CHOUAKI", "Abder", "a@gmail.com", "0909090909", "10 rue de Neuilly");

Create table participation (
	idparticipation int(3) not null auto_increment,
	idpers int(3) not null,
	idevent int(3) not null,
	prixtotal decimal(6,2),
	dateheureachat datetime,
	commentaire text,
	primary key (idparticipation, idpers, idevent),
	foreign key (idpers) references personne (idpers)
	on update cascade
	on delete cascade,
	foreign key (idevent) references evenement (idevent)
	on update cascade
	on delete cascade
) ENGINE=InnoDB;

Insert into participation values
(null, 1, 1, 75, sysdate(), "Paiement effectué par carte"),
(null, 2, 1, 50, sysdate(), "Paiement effectué par PayPal");

Create or replace view vparticipations(idparticipation, idpers, nom, prenom, idevent, designation, dateevent, heureevent, prixtotal, dateheureachat, commentaire)
as select par.idparticipation, p.idpers, p.nom, p.prenom, e.idevent, e.designation, date_format(e.dateevent, '%d/%m/%Y'), date_format(e.heureevent, '%H:%i'), par.prixtotal, date_format(par.dateheureachat, '%d/%m/%Y %H:%i'), par.commentaire
from participation par, personne p, evenement e
where par.idpers = p.idpers
and par.idevent = e.idevent
group by e.designation;

select * from vparticipations;

show tables;

