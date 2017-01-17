#popis robe
select r.roba, r.naziv, r.kolicina from roba r;

#informacije u jednom predmetu u skladištu
select r.roba, r.naziv, v.naziv, r.kolicina from roba r, vrsta_robe v where r.roba ='1' and r.vrsta = v.vrsta;

#otvorene narudžbe
select n.narudzbenica, k.ime, k.prezime, n.naruceno, n.status from narudzbenica n, korisnik k where n.status='0' and n.korisnik = k.korisnik;

#nerealizirana narudžbe
select n.narudzbenica, k.ime, k.prezime, n.naruceno, n.status from narudzbenica n, korisnik k where n.status='1' and n.korisnik = k.korisnik;

#zatvorene narudžbe
select n.narudzbenica, k.ime, k.prezime, n.naruceno, n.status from narudzbenica n, korisnik k where n.status='2' and n.korisnik = k.korisnik;

#popis isporuka
select i.broj, i.narudzbenica, i.stavka, i.roba, i.kolicina from izdatnica i;

#isporuka robe
select i.broj, i.narudzbenica, i.stavka, i.roba, i.kolicina from izdatnica i where i.roba='1';

#promet robe u vremenskom intervalu
select r.naziv, r.korisnik, p.kolicina, i.kolicina, r.jm, r.evidentirano from roba r, izdatnica i, primka p where r.evidentirano > "2009-01-01" and r.evidentirano < "2009-02-01" and r.roba = i.roba and r.roba = p.roba;