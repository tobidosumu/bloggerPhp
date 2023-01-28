<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script defer src="./scripts/animate.js"></script>
    <link rel="stylesheet" href="./styles/css/cart.css">
    <title>Blogger | Home</title>
</head>

<header class="d-flex justify-content-between align-items-center sticky-top border-bottom">
    <div class="logoContainer"><a href="index.php"><img src="assets/svg/bloggerLogoBlack.svg" alt="blogger logo"></a></div>
    <nav class="headerMenuContainer">
        <ul class="d-flex justify-content-between align-items-center wrap">
            <li class="home"><a href="./index.php"><i class="bi bi-house"></i></a></li>
            <li class="cart"><a href="./cart.php"><i class="bi bi-bag"></i><span>0</span></a></li>
            
            <!-- Displayed when a user is not logged in -->
            <li class="profile d-flex justify-content-between align-items-center">
                <div class="notLoggedIn">
                    <i class="bi bi-caret-down-fill caretIcon" onclick="revealProfileDropdown()"></i>
                    <a href="./posts.php">
                        <i class="userIcon bi bi-person-circle"></i>
                    </a>
                </div>

                <div id="profileDropdown" class="notLoggedInProfileDropdown">
                    <ul class="d-flex flex-column">
                        <li><a href="./login.php" class="text-start d-flex justify-content-between align-items-center"><i class="bi bi-box-arrow-right"></i><span>Login</span></a></li>
                        <li><a href="./signup.php" class="d-flex justify-content-between align-items-center"><i class="bi bi-door-open"></i>Sign up</a></li>
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