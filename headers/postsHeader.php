<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script defer src="./scripts/animate.js"></script>
    <link rel="stylesheet" href="./styles/css/posts.css">
    <title>Blogger | Posts</title>
</head>

<header class="d-flex justify-content-between align-items-center sticky-top border-bottom">
    <div class="logoContainer"><a href="index.php"><img src="assets/svg/bloggerLogoBlack.svg" alt="blogger logo"></a></div>
    <nav class="headerMenuContainer">
        <ul class="d-flex justify-content-between align-items-center wrap">
            <li class="home"><a href="./index.php">Home</a></li>
            <li class="posts"><a href="./posts.php">Posts</a></li>
            <li onclick="revealDropdown()" class="profile d-flex justify-content-between align-items-center">
                <a href="#">
                    <i class="bi bi-caret-down-fill"></i>
                    <img src="assets/images/moji.png" alt="user account">
                </a>

                <div class="profileDropdown">
                    <ul class="d-flex flex-column">
                        <a href="#"><i class="bi bi-heart"></i>Likes</a>
                        <a href="#"><i class="bi bi-person"></i>Profile</a>
                        <a href="#" class="logout"><i class="bi bi-power"></i>Log out</a>
                    </ul>
                </div>
            </li>
            <li class="search d-flex justify-content-center"><button type="submit" class="border-0"><i class="bi bi-search searchIcon"></i></button></li>
        </ul>
    </nav>
</header>