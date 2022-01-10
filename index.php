<?php
include_once 'includes/init.inc.php';

$title = 'webconia Technology Conference';
$description = 'webconia Technology Conference';

$wtConf = new wtConference();
$members = [];

if (isset($_GET['logout'])) {
    $wtConf->logout();
    header('Location: ' . $_SERVER['PHP_SELF']);
    die;
}

if (isset($_POST['login'])) {

    $wtConf->login($_POST['user'], $_POST['password']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    die;
}

$login = $wtConf->islogin();

if ($login) {
    $wtConf->getMembers();
    $members = $wtConf->members;
}

if (isset($_POST['submit'])) {
    $wtConf->entryNewMember($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['firma']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    die;
}

?>

<!DOCTYPE html>
<html>
<title><?= $title ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?= $description ?>" />
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/main.js"></script>

<body>

    <!-- Navbar (sit on top) -->
    <nav class="wtc-top">
        <div class="wtc-bar wtc-white wtc-wide wtc-padding wtc-card">
            <a href="#home">
                <img src="images/webconia_logo.svg" width="200" height="38" alt="webconia logo">
            </a>
            <!-- Float links to the right. Hide them on small screens -->
            <div class="wtc-right wtc-hide-small">
                <a href="#about" class="wtc-bar-item wtc-button">Über</a>
                <a href="#speakers" class="wtc-bar-item wtc-button">Sprecher</a>
                <?php if (!$login) { ?>
                    <a href="#register" class="wtc-bar-item wtc-button">Einschreiben</a>
                <?php } else { ?>
                    <a href="#members" class="wtc-bar-item wtc-button">Die Teilnemer</a>
                <?php } ?>
                <a class="wtc-bar-item wtc-button" id="bigLogin">Login</a>
            </div>
            <div class="wtc-right wtc-hide-big">
                <a class="wtc-bar-item wtc-button" id="smallLogin">Login</a>
            </div>
        </div>
        <!-- login Section -->
        <?php if (!$login) { ?>
            <div class="login hide-login" id="login">
                <div class="login-triangle"></div>
                <form class="login-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <p><input type="text" placeholder="Login" required name="user"></p>
                    <p><input type="password" placeholder="Passwort" required name="password"></p>
                    <p><input type="submit" name="login" value="Log in"></p>
                </form>
            </div>
        <?php } else { ?>
            <div class="login hide-login" id="login">
                <div class="login-triangle"></div>
                <form class="login-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
                    <p><input type="submit" name="logout" value="Log out"></p>
                </form>
            </div>
        <?php } ?>
    </nav>

    <!-- Page content -->
    <main class="wtc-content wtc-padding" style="max-width:1564px">

        <!-- Header -->
        <header class="wtc-display-container wtc-content wtc-wide" style="max-width:1500px; margin-top: 32px" id="home">
            <img class="wtc-image" src="images/hamburg_hafencity.jpg" alt="Architecture" width="1500" height="800">
            <div class="wtc-display-middle wtc-margin-top wtc-center">
                <h1 class="wtc-xxlarge wtc-text-white"><span class="wtc-padding wtc-black wtc-opacity-min"><b>WT</b></span>
                    <span class="wyc-hide-small wtc-text-light-grey">Conference</span>
                </h1>
            </div>
        </header>

        <!-- About Section -->
        <section class="wtc-container wtc-padding-32" id="about">
            <h3 class="wtc-border-bottom wtc-border-light-grey wtc-padding-16">Über Konferenz</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat.
            </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat.
            </p>
        </section>

        <!-- Speakers Section -->
        <section>

        </section>
        <section class="wtc-container" id="speakers">
            <div class="wtc-padding-32">
                <h3 class="wtc-border-bottom wtc-border-light-grey wtc-padding-16">Konferenzsprecher</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
                    occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>

            <div class="wtc-row-padding wtc-grayscale">
                <div class="wtc-col l3 m6 wtc-margin-bottom">
                    <img src="images/team2.jpg" alt="John" style="width:100%">
                    <h3>John Doe</h3>
                    <p class="wtc-opacity">IT Guru</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                </div>
                <div class="wtc-col l3 m6 wtc-margin-bottom">
                    <img src="images/team1.jpg" alt="Jane" style="width:100%">
                    <h3>Jane Doe</h3>
                    <p class="wtc-opacity">IT Guru</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                </div>
                <div class="wtc-col l3 m6 wtc-margin-bottom">
                    <img src="images/team3.jpg" alt="Mike" style="width:100%">
                    <h3>Mike Ross</h3>
                    <p class="wtc-opacity">IT Guru</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                </div>
                <div class="wtc-col l3 m6 wtc-margin-bottom">
                    <img src="images/team4.jpg" alt="Dan" style="width:100%">
                    <h3>Dan Star</h3>
                    <p class="wtc-opacity">IT Guru</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                </div>
            </div>
        </section>

        <!-- Register Section -->


        <!-- Members Section -->
        <?php if (!$login) { ?>
            <section class="wtc-container wtc-padding-32" id="register">
                <h3 class="wtc-border-bottom wtc-border-light-grey wtc-padding-16">Einschreiben</h3>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input class="wtc-input wtc-border" type="text" placeholder="Vorname" required name="firstName">
                    <input class="wtc-input wtc-section wtc-border" type="text" placeholder="Name" required name="lastName">
                    <input class="wtc-input wtc-section wtc-border" type="email" placeholder="Email" required name="email">
                    <input class="wtc-input wtc-section wtc-border" type="text" placeholder="Firma" required name="firma">
                    <button class="wtc-button wtc-black wtc-section" type="submit" name="submit">
                        <i class="fa fa-paper-plane"></i> SENDEN
                    </button>
                </form>
            </section>
        <?php } else { ?>
            <section class="wtc-container wtc-padding-32" id="members">
                <h3 class="wtc-border-bottom wtc-border-light-grey wtc-padding-16">Die Teilnehmer</h3>
                <?php if (count($members) > 0) { ?>
                    <div class="container">
                        <table class="wtc-table">
                            <tbody>
                                <tr>
                                    <th>Vorname</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Firma</th>
                                </tr>
                                <?php foreach ($members as $value) { ?>
                                    <tr>
                                        <td data-th="Vorname">
                                            <?= $value['firstName'] ?>
                                        </td>
                                        <td data-th="Name">
                                            <?= $value['lastName'] ?>
                                        </td>
                                        <td data-th="Email">
                                            <?= $value['email'] ?>
                                        </td>
                                        <td data-th="Firma">
                                            <?= $value['firma'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <p>Momentan gibt es noch keine Mitglieder.</p>
                <?php } ?>
            </section>
        <?php } ?>

        <!-- Image of location/map -->
        <section class="wtc-container">
            <img src="images/map.jpg" class="wtc-image" style="width:100%">
        </section>

        <!-- End page content -->
    </main>


    <!-- Footer -->
    <footer class="wtc-center wtc-black wtc-padding-16">
        <p>Powered by <a title="wtc.CSS" target="_blank" class="wtc-hover-text-green">Oleksiy Pasmarnov</a></p>
    </footer>

</body>

</html>