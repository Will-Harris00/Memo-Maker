<?php
require "header.php";
?>

<main>
    <form action="inc/preferences.inc.php" name="preferences_form" method="post" autocomplete="off">
        <div class="autocomplete">
            <label>Background:
                <input id="bginput" type="text" name="background" placeholder="Background Colour">
            </label>
        </div>
        <div class="autocomplete">
            <label>Foreground:
                <input id="fginput" type="text" name="foreground" placeholder="Foreground Colour">
            </label>
        </div>
        <input type="submit" value="Change Preferences" name="apply_prefs_btn">
    </form>
    <script src="../js/colours.js"></script>
</main>

<?php
require "footer.php";
?>
