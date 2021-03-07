Drop database if exists paris;
Create database paris;
Use paris;

Create table evenement (
	idevent int(5) not null auto_increment,
	designation varchar(50),
	dateevent date,
	heureevent time,
	description text,
	prixplace float,
	primary key(idevent)
);

Create table personne (
	idpers int(5) not null auto_increment,
	nom varchar(50),
	prenom varchar(50),
	email varchar(50),
	telephone varchar(50),
	adresse varchar(100),
	primary key(idpers)
);

Create table participer (
	idpers int(5) not null,
	idevent int(5) not null,
	nbplaces int(2),
	prixtotal float,
	dateachat date,
	commentaire text,
	primary key(idpers, idevent),
	foreign key(idpers) references personne (idpers),
	foreign key(idevent) references evenement (idevent)
);

insert into evenement values
(null, "Piece de theatre", "2020-05-11", "10:30", "Opera de Paris", 25),
(null, "Match de foot", "2020-05-12", "21:00", "Stade de France vous accueille", 120);

insert into personne values
(null, "Bruaire", "Tom", "p@gmail.com", "0606060606", "20 rue de Paris"),
(null, "Olivier", "Kevin", "o@gmail.com", "0707070707", "22 rue de Lyon");

insert into participer values
(1, 1, 3, 75, "2020-04-29", "Paiement effectue par carte"),
(2, 1, 2, 50, "2020-04-29", "Paiement par virement");

/* view (vue) = État des données */
Create view viewParticipations as (
	Select e.designation, e.dateevent, p.nom, p.prenom, e.idevent, p.idpers, pr.nbplaces, pr.prixtotal, pr.dateachat, pr.commentaire
	From evenement e, personne p, participer pr
	Where pr.idpers = p.idpers
	AND pr.idevent = e.idevent
);

Create table user (
	iduser int(5) not null auto_increment,
	email  varchar(100) not null,
	mdp varchar(100) not null,
	prenom varchar(100),
	nom varchar(100),
	telephone varchar(10),
	droits varchar(20),
	primary key(iduser)
);

insert into user values
(null, "admin@gmail.com", "Azerty123", "Tom", "ADMIN", "0606060606", "Admin"),
(null, "user@gmail.com", "Azerty321", "Tom", "USER", "0707070707", "User");

