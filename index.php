<?php

include ("header.php");


?>

<body>
<form method="post" action="components/login.php" class="form-login container box">
    <input type="hidden" name="action" value="login">
    <div class="header"></div>
    <input type="text" name="username" class="field" placeholder="Kasutajanimi">
    <input type="password" name="password" class="field" placeholder="Parool">
    <button class="btn btn-sm btn-green" type="submit" name="submit">Logi sisse</button>
</form>
</body>
</html>

