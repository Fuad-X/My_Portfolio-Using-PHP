<?php
    session_start();
    require "config.php";
    require "env.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$project_name"; ?></title>
    <link rel="icon" type="image/png" href="images/profile.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...">
</head>
<body onload="bodyOnLoad()">
    <header style="position: fixed; width:100%;top:0;z-index:1000;">
        <nav id="top-nav" class="top-nav">
            <div id="nav-brand" class="nav-brand">
                <h1 class="h1"><?php echo "$project_name"; ?></h1>
            </div>

            <div class="nav-item-holder" id="nav-item-holder">
                <a href="#home" class="btn nav-link home-link">Home</a>
                <a href="#" class="btn nav-link">Blogs</a>
                <a href="#about" class="btn nav-link about-link">About</a>
                <a href="#contact" class="btn nav-link contact-link">Contact</a>

                <div class="dropdown">
                    <button class="btn nav-link">Preference</button>
                    <div style="width: 100%;" class="dropdown-item-holder float-right right-0">
                        <button onclick="themeToggle()" class="btn nav-link theme-toggle">Light</button>
                        <button onclick="positionToggle()" class="btn nav-link position-toggle">Top</button>
                        <button onclick="contentToggle()" class="btn nav-link content-toggle">Text</button>
                    </div>
                </div>

                <?php
                    if(isset($_SESSION['username'])) echo "<form action=\"controllers\LOGOUT_CONTROLLER.php\">"
                ?>
                <button id="login-out" <?php if(isset($_SESSION['username']))echo "value=\"signout\"";else echo "value=\"signin\" onclick=\"toggleModal('login-modal')\""; ?> class="btn nav-link">Sign Up</button>
                <?php
                    if(isset($_SESSION['username'])) echo "</form>"
                ?>
            </div>

            <button style="width: 32px;" id="nav-toggle" onclick="navToggle()" class="btn nav-link"><i class="fa-solid fa-bars"></i></button>
        </nav>

        <nav style="text-align:center; height: 0px;" id="top-collapsed-nav" class="top-collapsed-nav">
            <a href="#home" class="btn nav-link home-link">Home</a>
            <a href="#" class="btn nav-link">Blogs</a>
            <a href="#about" class="btn nav-link about-link">About</a>
            <a href="#contact" class="btn nav-link contact-link">Contact</a>
            <button onclick="themeToggle()" class="btn nav-link theme-toggle">Light</button>
            <button onclick="positionToggle()" class="btn nav-link position-toggle">Top</button>
            <button onclick="contentToggle()" class="btn nav-link content-toggle">Text</button>
            
            <?php
                if(isset($_SESSION['username'])) echo "<form action=\"controllers\LOGOUT_CONTROLLER.php\">"
            ?>
            <button <?php if(!isset($_SESSION['username'])) echo "onclick=\"toggleModal('login-modal')\""; ?> class="btn nav-link">Sign Up</button>
            <?php
                if(isset($_SESSION['username'])) echo "</form>"
            ?>
        </nav>    

        <nav style="text-align:center; width: 0px;" id="left-collapsed-nav" class="left-collapsed-nav">
            <a href="#home" class="btn nav-link home-link">Home</a>
            <a href="#" class="btn nav-link">Blogs</a>
            <a href="#about" class="btn nav-link about-link">About</a>
            <a href="#contact" class="btn nav-link contact-link">Contact</a>
            <button onclick="themeToggle()" class="btn nav-link theme-toggle">Light</button>
            <button onclick="positionToggle()" class="btn nav-link position-toggle">Top</button>
            <button onclick="contentToggle()" class="btn nav-link content-toggle">Text</button>
            
            <?php
                if(isset($_SESSION['username'])) echo "<form action=\"controllers\LOGOUT_CONTROLLER.php\">"
            ?>
            <button style="text-align:center" <?php if(!isset($_SESSION['username'])) echo "onclick=\"toggleModal('login-modal')\""; ?> class="btn nav-link">Sign Up</button>
            <?php
                if(isset($_SESSION['username'])) echo "</form>"
            ?>
        </nav>
        <div id="login-modal" class="modal">
            <div class="modal-content">
                <button onclick="toggleModal('login-modal')" class="btn float-right exit-btn">&times;</button>
                
                <div class="text-center">
                    <h3>Login</h3>
                </div>

                <form class="text-center" action="controllers/VERIFY_LOGIN_CONTROLLER.php" method="POST">
                    <div class="modal-form">
                        <input required class="contact-input" type="text" name="username" placeholder="Enter your username">
                        <input required class="contact-input" type="password" name="password" placeholder="Enter the password">
                    </div>
                    <button type="submit" class="btn submit-btn">Login</button>
                </form>
            </div>
        </div>
    </header>

    <?php
        if(isset($_GET['success'])){
            echo "
            <div id=\"toast\" class=\"toast\">
                <button onclick=\"toastDismiss()\" class=\"btn float-right exit-btn\">&times;</button>
            
                <h6>Success!</h6>
                <p>{$_GET['success']}</p>
            </div>
            ";
        }else if(isset($_GET['failed'])){
            echo "
            <div id=\"toast\" class=\"toast\">
                <button onclick=\"toastDismiss()\" class=\"btn float-right exit-btn\">&times;</button>
            
                <h6>Failed!</h6>
                <p>{$_GET['failed']}</p>
            </div>
            ";
        }
    ?>
    <main style="margin-top:45px;" id="main-page">
        <section id='home'>
            <?php
                if(isset($_SESSION['username'])){
                    echo "
                    <div id=\"change-pp-modal\" class=\"modal\">
                        <div class=\"modal-content\">
                            <button onclick=\"toggleModal('change-pp-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                            
                            <div class=\"text-center\">
                                <h3>Change Profile Picture</h3>
                            </div>

                            <form class=\"text-center\" action=\"controllers/CHANGE_PP_CONTROLLER.php\" method=\"POST\" enctype = \"multipart/form-data\">
                                <div class=\"modal-form\">
                                    <input required class=\"contact-input\" id=\"profile-image\" type=\"file\" name=\"image\" accept=\"image/*\">
                                </div>
                                <button type=\"submit\" class=\"btn submit-btn\">Upload</button>
                            </form>
                        </div>
                    </div>";
                }
            ?>
            <?php
                if(isset($_SESSION['username'])){
                    echo "
                    <div id=\"change-cp-modal\" class=\"modal\">
                        <div class=\"modal-content\">
                            <button onclick=\"toggleModal('change-cp-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                            
                            <div class=\"text-center\">
                                <h3>Change Cover Picture</h3>
                            </div>

                            <form class=\"text-center\" action=\"controllers/CHANGE_CP_CONTROLLER.php\" method=\"POST\" enctype = \"multipart/form-data\">
                                <div class=\"modal-form\">
                                    <input required class=\"contact-input\" id=\"cover-image\" type=\"file\" name=\"image\" accept=\"image/*\">
                                </div>
                                <button type=\"submit\" class=\"btn submit-btn\">Upload</button>
                            </form>
                        </div>
                    </div>";
                }
            ?>
            <section style="z-index:0;background-image: url('images/cover.png');background-size: auto 100%;" class="welcome-section p-1">
                <h2 class="welcome-text">Welcome To My Portfolio</h2>
                <div style="background-image: url('images/profile.png');background-size: 100% 100%;" class="welcome-image">
                    <?php
                        if(isset($_SESSION['username']))
                            echo "<button onclick=\"toggleModal('change-pp-modal')\" class=\"btn change-btn\">Change</button>";
                    ?>
                </div>
                <h2 class="welcome-title">I'm <?php echo "$owner_name"; ?></h2>
                <?php
                    if(isset($_SESSION['username']))
                        echo "<button onclick=\"toggleModal('change-cp-modal')\" class=\"btn change-btn\" style=\"position:absolute;z-index: 1; top: 50%; left: 50%; transform: translate(-50%, -50%);\">Change</button>";
                ?>
        </section>

        <?php
            if(isset($_SESSION['username'])){
                $bio = file_get_contents("files/bio.txt");
                echo "
                <div id=\"change-bio-modal\" class=\"modal\">
                    <div class=\"modal-content\">
                        <button onclick=\"toggleModal('change-bio-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                        
                        <div class=\"text-center\">
                            <h3>Change Bio</h3>
                        </div>

                        <form class=\"text-center\" action=\"controllers/CHANGE_BIO_CONTROLLER.php\" method=\"POST\">
                            <div class=\"modal-form\">
                                <textarea style='box-sizing:border-box;' minlength=\"10\" required rows=\"6\" class=\"contact-input\" type=\"text\" name=\"bio\" placeholder=\"Bio......\">{$bio}</textarea>
                            </div>
                            <button type=\"submit\" class=\"btn submit-btn\">Submit</button>
                        </form>
                    </div>
                </div>";
            }
        ?>
        <section class="info-section p-2">
            <div class="text-center">
                <h3>Bio</h3>

                <p class="my-5"><?php print_r(file_get_contents("files/bio.txt"))?></p>

                <?php
                    if(isset($_SESSION['username']))
                        echo "<button onclick=\"toggleModal('change-bio-modal')\" class=\"btn submit-btn\">Change</button>";
                ?>
            </div>
        </section>
        </section>

        <section id='about'>
            <?php
                if(isset($_SESSION['username'])){
                    echo "
                    <div id=\"add-skill-modal\" class=\"modal\">
                        <div class=\"modal-content\">
                            <button onclick=\"toggleModal('add-skill-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                            
                            <div class=\"text-center\">
                                <h3>Add New Skill</h3>
                            </div>

                            <form class=\"text-center\" action=\"controllers/ADD_NEW_SKILL_CONTROLLER.php\" method=\"POST\">
                                <div class=\"modal-form\">
                                    <input required minlength=\"1\" class=\"contact-input\" type=\"text\" name=\"title\" placeholder=\"Enter the skill title\">
                                    <input required min='0' max='100' class=\"contact-input\" type=\"number\" name=\"percentage\" placeholder=\"Enter the percentage\">
                                </div>
                                <button type=\"submit\" class=\"btn submit-btn\">Submit</button>
                            </form>
                        </div>
                    </div>";
                }
            ?>
            <section class="info-section p-2">
                <div class="text-center">
                    <h3>About</h3>
                    <h4>My Skills</h4>
                </div>


                <div class="skill-set grid3-2-1">
                    <?php
                        require "models/SKILL.php";

                        $sql = "SELECT * FROM `Skills`;";

                        $data =  $conn->query($sql);

                        if ($data->num_rows > 0) {
                            while($row = $data->fetch_assoc()) {
                                echo "<div class='skill'>";

                                if(isset($_SESSION['username'])){
                                    echo "<form action='controllers/DELETE_SKILL_CONTROLLER.php' method='POST'><button name='delete' value='".$row['id']."' class='btn float-right exit-btn'>&times;</button></form>";
                                }

                                echo "<p>".$row['title']."</p>";
                                echo "<div class='progress-bar'>";
                                $level = ($row['percentage'] < 30) ? "Beginner" : (($row['percentage'] < 80) ? "Intermediate" : "Expert");
                                echo "<div style='width: 100%;' class='progress'>". $level ."</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    ?>

                    <?php     
                        if(isset($_SESSION['username'])){
                            echo "
                            <div style=\"display:flex;align-items:end;justify-content:center;\">
                                <button onclick=\"toggleModal('add-skill-modal')\" class=\"btn add-btn\">Add New</button>
                            </div>";
                        }
                    ?>

                </div>
            </section>

            <?php
                if(isset($_SESSION['username'])){
                    echo "
                    <div id=\"add-service-modal\" class=\"modal\">
                        <div class=\"modal-content\">
                            <button onclick=\"toggleModal('add-service-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                            
                            <div class=\"text-center\">
                                <h3>Add New Service</h3>
                            </div>

                            <form class=\"text-center\" action=\"controllers/ADD_NEW_SERVICE_CONTROLLER.php\" method=\"POST\">
                                <div class=\"modal-form\">
                                    <input required class=\"contact-input\" type=\"text\" name=\"icon\" placeholder=\"Enter a icon tag from fontawsome\">
                                    <input required class=\"contact-input\" type=\"text\" name=\"title\" placeholder=\"Enter the title\">
                                    <textarea required rows=\"6\" class=\"contact-input\" type=\"text\" name=\"description\" placeholder=\"Description......\"></textarea>
                                </div>
                                <button type=\"submit\" class=\"btn submit-btn\">Submit</button>
                            </form>
                        </div>
                    </div>
                    ";
                }
            ?>
            <section style="margin: 5px;" class="info-section p-2">
                <div class="text-center">
                    <h3>My Services</h3>
                    <h4>What I Do</h4>
                </div>

                <div class="work-set grid3-2-1">
                    <?php
                        require "models/SERVICE.php";

                        $sql = "SELECT * FROM `Services`;";

                        $data =  $conn->query($sql);

                        if ($data->num_rows > 0) {
                            while($row = $data->fetch_assoc()) {
                                echo "<div class='work'>";

                                if(isset($_SESSION['username'])){
                                    echo "<form action='controllers/DELETE_SERVICE_CONTROLLER.php' method='POST'><button name='delete' value='".$row['id']."' class='btn float-right exit-btn'>&times;</button></form>";
                                }

                                echo "<p>".$row['icon']."</p>";
                                echo "<h5>".$row['title']."</h5>";
                                echo "<p>".$row['description']."</p>";

                                echo "</div>";
                            }
                        }
                    ?>
                    <?php     
                        if(isset($_SESSION['username'])){
                            echo "<button onclick=\"toggleModal('add-service-modal')\" class=\"btn work\">Add New</button>";
                        }
                    ?>
                </div>

            </section>

            <?php
                if(isset($_SESSION['username'])){
                    echo "
                    <div id=\"add-project-modal\" class=\"modal\">
                        <div class=\"modal-content\">
                            <button onclick=\"toggleModal('add-project-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                            
                            <div class=\"text-center\">
                                <h3>Add New Project</h3>
                            </div>

                            <form class=\"text-center\" action=\"controllers/ADD_NEW_PROJECT_CONTROLLER.php\" method=\"POST\" enctype = \"multipart/form-data\">
                                <div class=\"modal-form\">
                                    <input required class=\"contact-input\" type=\"text\" name=\"link\" placeholder=\"Insert the link of the project\">
                                    <label for=\"image\">Project Image</label>
                                    <input required class=\"contact-input\" id=\"image\" type=\"file\" name=\"image\" accept=\"image/*\">
                                </div>
                                <button type=\"submit\" class=\"btn submit-btn\">Submit</button>
                            </form>
                        </div>
                    </div>";
                }
            ?>
            <section style="margin: 5px;" class="info-section p-2">
                <div class="text-center">
                    <h3>My Projects</h3>
                </div>

                <div class="project-set grid3-2-1">
                    <?php
                        require "models/PROJECT.php";

                        $sql = "SELECT * FROM `Projects`;";

                        $data =  $conn->query($sql);

                        if ($data->num_rows > 0) {
                            while($row = $data->fetch_assoc()) {
                                echo "<div style=\"position:relative;background-image: url('images/{$row['path']}'); background-repeat: no-repeat; background-size: cover;\" class=\"project\">";                            
                                
                                if(isset($_SESSION['username'])){
                                echo "<div style='position:absolute;top:5px;right:5px;'>";
                                echo "<form action='controllers/DELETE_PROJECT_CONTROLLER.php' method='POST'><button name='delete' value='".$row['id']."' class='btn float-right exit-btn'>&times;</button></form>";
                                echo "</div>";
                                }

                                echo "<a href=".$row['link']." class='show-project btn'>View</a>";
                                echo "</div>";
                            }
                        }
                    ?>

                    <?php     
                    if(isset($_SESSION['username'])){
                        echo "
                        <div style=\"position:relative;\" class=\"project\">
                            <button onclick=\"toggleModal('add-project-modal')\" class=\"btn show-project\">Add New</button>
                        </div>";
                    }
                    ?>
                </div>
            </section>
        </section>

        <?php
            if(!isset($_SESSION['username'])){
                echo "        
                    <section id='contact' style=\"margin: 5px;\" class=\"info-section p-2\">
                        <div class=\"text-center\">
                            <h3>My Contacts</h3>
                        </div>
            
                        <form class=\"text-center\" action=\"controllers/CONTACT_INFO_POST_CONTROLLER.php\" method=\"POST\">
                            <div class=\"contact-form\">
                                <div style=\"box-sizing:border-box; flex-grow: 1;display: flex; flex-direction:column\">
                                    <input style='box-sizing:border-box;' required minlength=\"5\" class=\"contact-input\" type=\"text\" name=\"name\" placeholder=\"Enter Your Name\">
                                    <input style='box-sizing:border-box;' required class=\"contact-input\" type=\"email\" name=\"email\" placeholder=\"Enter Your Email\">
                                    <input style='box-sizing:border-box;' required minlength=\"12\" class=\"contact-input\" type=\"text\" name=\"subject\" placeholder=\"Enter The Subject\">
                                </div>
                                <div style=\"flex-grow: 1;box-sizing:border-box;\">
                                    <textarea style='box-sizing:border-box;' minlength=\"20\" required rows=\"6\" class=\"contact-input\" type=\"text\" name=\"description\" placeholder=\"Description......\"></textarea>
                                </div>
                            </div>
                                
                            <button type=\"submit\" class=\"btn submit-btn\">Submit</button>
                        </form>
                    </section>
                ";
            }
        ?>        

        <?php
            if(isset($_SESSION['username'])){
                echo "
                <section id='contact' style=\"overflow: scroll;\" class=\"info-section p-2\">
                    <div class=\"text-center\">
                        <h3>All Contacts</h3>
                    </div>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>";

                require("models/CONTACT_LIST.php");

                $sql = "SELECT * FROM `Contact_List`;";
            
                $data =  $conn->query($sql);

                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['subject']."</td>";
                        echo "<td>".$row['description']."</td>";
                        echo "<td><form action='controllers/CONTACT_INFO_DELETE_CONTROLLER.php' method='POST'><button style='font-size: 100%' name='delete' value='".$row['id']."' class='btn'>Delete</button></form></td>";
                        echo "<tr>";
                    }
                } else {
                    echo "0 results";
                }
            }
                echo "</table>";
            echo "</section>";
        ?>

        <?php     
            if(isset($_SESSION['username'])){
                echo "
                <div id=\"add-contact-modal\" class=\"modal\">
                    <div class=\"modal-content\">
                        <button onclick=\"toggleModal('add-contact-modal')\" class=\"btn float-right exit-btn\">&times;</button>
                        
                        <div class=\"text-center\">
                            <h3>Add New Contact</h3>
                        </div>

                        <form class=\"text-center\" action=\"controllers/ADD_NEW_CONTACT_CONTROLLER.php\" method=\"POST\">
                            <div class=\"modal-form\">
                                <input required class=\"contact-input\" type=\"text\" name=\"icon\" placeholder=\"Enter a icon tag from fontawsome\">
                                <input required class=\"contact-input\" type=\"text\" name=\"link\" placeholder=\"Enter the link\">
                            </div>
                            <button type=\"submit\" class=\"btn submit-btn\">Submit</button>
                        </form>
                    </div>
                </div>
                ";
            }
        ?>
        <footer class="p-2">
            <div class="footer-section copyright">
                <p>© 2023 all Copyright reserved | Designed By <?php echo "$owner_name"; ?></p>
            </div>
            <div class="footer-section contact-links">
                <?php
                    require "models/CONTACT.php";

                    $sql = "SELECT * FROM `Contacts`;";

                    $data =  $conn->query($sql);

                    if ($data->num_rows > 0) {
                        while($row = $data->fetch_assoc()) {
                            echo "<div>";                            
                            
                            echo "<a href=\"{$row['link']}\" style='border:none;' class=\"btn exit-btn\">{$row['icon']}</a>";
                            
                            if(isset($_SESSION['username'])){
                                echo "<form action='controllers/DELETE_CONTACT_CONTROLLER.php' method='POST'><button name='delete' value='".$row['id']."' class='btn float-right exit-btn'>&times;</button></form>";
                            }
                            
                            echo "</div>";
                        }
                    }
                ?>
                
                <?php
                    if(isset($_SESSION['username'])){
                        echo "<button onclick=\"toggleModal('add-contact-modal')\" class=\"btn exit-btn\"><i class=\"fa-solid fa-plus\"></i></button>";
                    }
                ?>
            </div>
        </footer>
    </main>

</body>
<script src="js/script.js"></script>
</html>
