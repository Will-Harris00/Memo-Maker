<form action = "index.php" method = "post">
    <p>Background:
        <select name = "background">
            <option value = "black">Black</option>
            <option value = "white" selected>White</option>
            <option value = "red">Red</option>
            <option value = "blue">Blue</option>
        </select><br />
        Foreground:
        <select name = "foreground">
            <option value = "black" selected>Black</option>
            <option value = "white">White</option>
            <option value = "red">Red</option>
            <option value = "blue">Blue</option>
        </select></p>
    <input type = "submit" value = "Change Preferences">
</form>