CREATE TABLE tblArtInquiry (
    fldEmail varchar(30),
    fldFirstName varchar(30),
    fldLastName varchar(50),
    fldGender varchar(15),
    fldAbstract tinyint(1),
    fldSurrealism tinyint(1),
    fldRealism tinyint(1),
    fldCubism tinyint(1),
    fldDadaism tinyint(1),
    fldArtistLst varchar(40),
    fldComments text
)

INSERT INTO tblArtInquiry (fldEmail, fldFirstName, fldLastName, fldGender, fldAbstract, fldSurrealism, fldRealism, fldCubism, fldDadaism, fldArtistLst, fldComments) 
    VALUES ('ewest3@uvm.edu', 'Ethan', 'West', 'Male', 1, 1, 1, 1, 1, 'Monet', 'I love art')