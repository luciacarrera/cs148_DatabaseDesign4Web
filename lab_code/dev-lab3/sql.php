
<?php
include 'top.php'
?>
<main>
  <p>Select wildlife:</p>
  <pre>
    SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription,
      fldHabitat, fldReproduction, fldDiet, fldManagement,
      fldStatus, fldMainImage
    FROM tblWildlife
    ORDER BY fldCommonName
  </pre>

  <p>Create Table SQL: tblWildlife</p>
  <pre>
    CREATE TABLE tblWildlife (
      pmkWildlifeId int(11) NOT NULL,
      fldType varchar(12) NOT NULL,
      fldCommonName varchar(20) NOT NULL,
      fldDescription varchar(900) NOT NULL,
      fldHabitat text NOT NULL,
      fldReproduction text NOT NULL,
      fldDiet text NOT NULL,
      fldManagement text NOT NULL,
      fldStatus text NOT NULL,
      fldMainImage varchar(30) NOT NULL
    ) 
  </pre>

  <p>Create Table SQL: tblAdopter</p>
  <pre>
    CREATE TABLE tblAdopter (
    pmkAdopterEmail varchar(50) NOT NULL,
    fldFirstName varchar(50) NOT NULL,
    fldLastName varchar(60) NOT NULL,
    fldAgreeToTerms tinyint(1) NOT NULL DEFAULT '1',
    fldRecieveCommunication tinyint(1) NOT NULL DEFAULT '1'
  )
  </pre>

  <p>Create Table SQL: tblAdopterWildlife</p>
  <pre>
    CREATE TABLE tblAdopterWildlife (
    pmkDonationId int(11) NOT NULL,
    fpkAdopterEmail varchar(50) NOT NULL,
    fpkWildlifeId int(11) NOT NULL,
    fldDonationAmount int(11) NOT NULL DEFAULT '0'
  )
  </pre>
</main>
<?php include 'footer.php';?>
