<?php

include("header.php");


?>






<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include_once "templates/base.php";


require_once ('autoload.php');


$client_id = '84878280128-ulk9gd5fu4dos97jvlahlbclbkqas8i4.apps.googleusercontent.com';
$client_secret = 'vqvSciobv8ypSrRdG9Q43lpw';
$redirect_uri = 'http://ramon.beekman.ee/raamatukoi/index.php';


$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope(array("https://www.googleapis.com/auth/userinfo.email", "https://www.googleapis.com/auth/userinfo.profile"));


$service = new Google_Service_Urlshortener($client);


if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}


if (isset($_GET['code'])) {

    $oauth2 = new Google_Service_Oauth2($client);

    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();

    

    $user = $oauth2->userinfo->get();
    $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
    $first_name = $user['givenName'];
    $family_name = $user['familyName'];

    include("components/database.php");

    $sql = "SELECT id, admin, firstname, lastname FROM user WHERE email = '". $email ."' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $row = $result->fetch_assoc();



    if(mysqli_num_rows($result) == 1){

        $_SESSION['firstname'] = $row["firstname"];
        $_SESSION['lastname'] = $row["lastname"];
        $_SESSION['user_id'] = $row["id"];
        $_SESSION['admin'] = $row["admin"];


    } else {

        $username = strtolower($first_name.$family_name.rand(1,1000));
        $password = md5(strtolower($first_name.$family_name.rand(1,1000)));
        $add_user = $connection->query("INSERT INTO issuetracker.user (username, firstname, lastname, password, email, admin) VALUES ( '". $username ."', '". $first_name ."', '" . $family_name . "', '". $password ."', '". $email ."', '0')");

        $newsql = "SELECT id FROM user WHERE email = '". $email ."' LIMIT 1";
        $newresult = mysqli_query($connection, $newsql);
        $newrow = $newresult->fetch_assoc();

        $_SESSION['firstname'] = $first_name;
        $_SESSION['lastname'] = $family_name;
        $_SESSION['user_id'] = $newrow["id"];
        $_SESSION['admin'] = "0";


    }


    header("Location: home.php");
    exit();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));

}


if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    $authUrl = $client->createAuthUrl();
}


if ($client->getAccessToken() && isset($_GET['url'])) {
    $url = new Google_Service_Urlshortener_Url();
    $url->longUrl = $_GET['url'];
    $short = $service->url->insert($url);
    $_SESSION['access_token'] = $client->getAccessToken();
}

?>

<body>
<form method="post" action="components/login.php" class="form-login container box">
    <input type="hidden" name="action" value="login">
    <div class="header"></div>
    <input type="text" name="username" class="field" placeholder="Kasutajanimi">
    <input type="password" name="password" class="field" placeholder="Parool">
    <button class="btn btn-sm btn-green" type="submit" name="submit">Logi sisse</button>
</form>
<?php
if (isset($authUrl)) {
    echo "<a class='login' href='" . $authUrl . "'>Connect with Google!</a>";
}
?>
</body>
</html>



