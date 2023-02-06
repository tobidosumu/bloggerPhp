<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script defer type="text/javascript" src="./scripts/animate.js"></script>
    <link rel="stylesheet" type="text/css" href="./styles/css/index.css">
    <title>Blogger | Home</title>
</head>

<header class="d-flex justify-content-between align-items-center sticky-top border-bottom">
    <div class="logoContainer"><a href="index.php"><img src="assets/svg/bloggerLogoBlack.svg" alt="blogger logo"></a></div>
    <nav class="headerMenuContainer">
        <ul class="d-flex justify-content-between align-items-center wrap">
            <li class="home"><a href="./index.php"><i class="bi bi-house"></i></a></li>
            <li class="cart"><a href="./cart.php"><i class="bi bi-bag"></i><span>3</span></a></li> 

            <!-- To be displayed using JS when a user login -->
            <li class="profile d-flex justify-content-between align-items-center">
                <div class="profileLinkWrapper" class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-caret-down-fill caretIcon" onclick="revealProfileDropdown()"></i>
                    <a href="./posts.php">
                        <img src="assets/images/moji.png" alt="user account">
                    </a>
                </div>

                <div id="profileDropdown" class="profileDropdown">
                    <ul class="d-flex flex-column">
                        <form action="" method="post">
                            <button type="submit" name="logOutUser" class="logout d-flex justify-content-even align-items-center">
                                <i class="bi bi-power"></i><span class="ps-2">Log out</span>
                            </button>
                        </form>
                    </ul>
                </div>
            </li>
            <li class="search d-flex justify-content-center">
                <button type="submit" class="border-0">
                    <i class="bi bi-search searchIcon" onclick="toggleSearchDropdown()"></i>
                </button>
            </li>
        </ul>
    </nav>

    <div class="searchDropDown border rounded-bottom-2">
        <form action="" method="get" class="d-flex">
            <input type="search" name="search" placeholder="...search for posts and bloggers">
            <button><i class="bi bi-search"></i></button>
        </form>
    </div>
</header>