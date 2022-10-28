<?php
$i = 1;
foreach ($_REQUEST['erreurs'] as $erreur) {
?>
    <div style="background-color:red;" class=" notification numNotif<?php echo $i; ?> is-danger is-light ">
        <button class="delete" dt-numNotif="<?php echo $i; ?>"></button>
        <?php echo "<li>$erreur</li>";
        ?>
    </div>
<?php
    $i += 1;
}
?>