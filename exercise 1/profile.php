<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Stylish Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>My Stylish Website</h1>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section id="home">
            <div class="container">
                <h2>Welcome to Our Site</h2>
                <p>Your journey to excellence starts here.</p>
            </div>
        </section>
        <section id="about">
            <div class="container">
                <h2>About Us</h2>
                <p>We are committed to delivering high-quality services.</p>
            </div>
        </section>
        <h2>Executive Team</h2>
        <hr>
        <div class="members">
            <div class="team-mem">
                <img src="img1.jpg">
                <h4>Mr. Jay Mark</h4>
                <h4>Amper</h4>
                <p>Batchelor in Science</p>
                <p>in Information Technology</p>
                <ul>  
                    <a href="#"><li><i class="fa fa-phone"></i>+63 970 807 8512</li></a>
                    <a href="#"><li><i class="fa fa-facebook"></i>Jmark Amper</li></a>
                    <a href="#"><li><i class="fa fa-google"></i>xjmark04</li></a>  
                </ul> 
            </div>
            <div class="team-mem">
                <img src="img2.jpg">
                <h4>Mr. John Carlo</h4>
                <h4>Reyes</h4>
                <p>Batchelor in Science</p>
                <p>in Information Technology</p>
                <ul>  
                    <a href="#"><li><i class="fa fa-phone"></i>+63 985 1220 114</li></a>
                    <a href="#"><li><i class="fa fa-facebook"></i>John Carlo Jorom Reyes</li></a>
                    <a href="#"><li><i class="fa fa-google"></i>johncarloreyes018</li></a>  
                </ul>
            </div>
            <div class="team-mem">
                <img src="img3.jpg">
                <h4>Ms. Carla</h4>
                <h4>Cinarillos</h4>
                <p>Batchelor in Science</p>
                <p>in Information Technology</p>
                <ul>  
                    <a href="#"><li><i class="fa fa-phone"></i>+63 948 524 2198</li></a>
                    <a href="#"><li><i class="fa fa-facebook"></i> Carla Cinarillos</li></a>
                    <a href="#"><li><i class="fa fa-google"></i>ccinarillos</li></a>  
                </ul>
            </div>
            <div class="team-mem">
                <img src="img4.jpg">
                <h4>Ms. Norielyn</h4>
                <h4>Dano</h4>
                <p>Batchelor in Science</p>
                <p>in Information Technology</p>
                <ul>  
                    <a href="#"><li><i class="fa fa-phone"></i>  +63 948 805 0962</li></a>
                    <a href="#"><li><i class="fa fa-facebook"></i>Norielyn Dano Talavera</li></a>
                    <a href="#"><li><i class="fa fa-google"></i>norielyntalavera</li></a>  
                </ul>
            </div>
            <div class="team-mem">
                <img src="img5.jpg">
                <h4>Ms. Isish</h4>
                <h4>Bolo</h4>
                <p>Batchelor in Science</p>
                <p>in Information Technology</p>
                <ul>  
                    <a href="#"><li><i class="fa fa-phone"></i>+63 955 175 3728</li></a>
                    <a href="#"><li><i class="fa fa-facebook"></i>Isish Bolo</li></a>
                    <a href="#"><li><i class="fa fa-google"></i>isishluvlyb</li></a>  
                </ul>
            </div>
        </div>
    </div>
        <section id="services">
            <div class="container">
                <h2>Our Services</h2>
                <ul>
                    <li>Consulting</li>
                    <li>Design</li>
                    <li>Development</li>
                </ul>
            </div>
        </section>
        <section id="contact">
            <div class="container">
                <h2>Contact Us</h2>
                <form>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 My Stylish Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
