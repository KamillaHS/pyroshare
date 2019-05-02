<?php include_once("../includes/header.php") ?>
<?php require_once("../includes/SelectHeader.php") ?>
<link rel="stylesheet" href="../../css/rulesAndReg.style.css">

<div id="rr-content">
<h3>Rules and Regulations</h3>

    <?php
    $sql = "SELECT RulesAndRegulations FROM websiteinfo";
    $query = $dbCon->prepare($sql);
    $query->execute();
    $getRulesAndRegs= $query->fetch();
    echo "$getRulesAndRegs[0]";
    ?>

</div>

<?php include_once("../includes/footer.php") ?>
