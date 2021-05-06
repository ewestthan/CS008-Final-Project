<?php include top.php ?>

<main>
    <p>Create Table SQL</p>
    <pre>
    CREATE TABLE tblPieces(
        fldPiece VARCHAR(20),
        fldCreator VARCHAR(10),
        fldCost VARCHAR(6)
    );
    INSERT INTO tblPieces (fldPiece, fldCreator, fldCost) 
    VALUES
    ("Untitled (Heart)", "Haring", "3"),
    ("Water Lilies", "Monet", "43"),
    ("BroadWay Boogie Woogie", "Mondrian", "10"),
    ("NightHawks", "Hopper", "91");
    </pre>
    <pre>
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
    </pre>
</main>
<?php include footer.php ?>
</body>
</html>