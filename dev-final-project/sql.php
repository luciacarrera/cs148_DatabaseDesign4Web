<?php
include 'top.php';
?>

<main>
    <p>Select Mountain:</p>

<pre>

CREATE TABLE `tblMtn` (
  `pmkMountainId` int(11) NOT NULL,
  `fldType` varchar(12) NOT NULL,
  `fldCommonName` varchar(20) NOT NULL,
  `fldDescription` varchar(900) NOT NULL,
  `fldHabitat` text NOT NULL,
  `fldReproduction` text NOT NULL,
  `fldDiet` text NOT NULL,
  `fldManagement` text NOT NULL,
  `fldStatus` text NOT NULL,
  `fldMainImage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


SELECT pmkMountainId, fldType,fldCommonName, fldDescription,
        fldHabitat, fldReproduction, fldDiet, fldManagement, 
        fldStatus, fldMainImage
FROM tblMtn
ORDER BY fldCommonName

CREATE TABLE `tblAdopter` (
  `pmkAdopterEmail` varchar(50) NOT NULL,
  `fldFirstName` varchar(50) NOT NULL,
  `fldLastName` varchar(60) NOT NULL,
  `fldAgreeToTerms` tinyint(1) NOT NULL DEFAULT '1',
  `fldRecieveCommunication` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tblAdopterMountain` (
  `pmkDonationId` int(11) NOT NULL,
  `fpkAdopterEmail` varchar(50) NOT NULL,
  `fpkMountainId` int(11) NOT NULL,
  `fpkDonationAmount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
</pre>

</main>
<?php include 'footer.php'; ?>
</body>
</html>