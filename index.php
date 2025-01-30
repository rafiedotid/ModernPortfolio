<?php 
    $data = json_decode(file_get_contents('config/database.json'), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['hero']['title'] ?> - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="font-[Poppins] bg-gray-50">
    <!-- Navigation -->
   <!-- <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-[#6879EF]">PORTOFOLIO</a>
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="nav-link hover:text-[#6879EF] transition-colors">Home</a>
                    <a href="#projects" class="nav-link hover:text-[#6879EF] transition-colors">Projects</a>
                    <a href="#skills" class="nav-link hover:text-[#6879EF] transition-colors">Skills</a>
                    <a href="#contact" class="nav-link hover:text-[#6879EF] transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </nav> -->

    <!-- Hero Section -->
<section id="home" class="gradient-bg text-white min-h-screen flex items-center relative overflow-hidden pt-20">
    <!-- Floating Shapes Background -->
    <div class="absolute inset-0 z-0 opacity-10">
        <div class="bubble bubble-1 floating delay-1000"></div>
        <div class="bubble bubble-2 floating delay-2000"></div>
        <div class="bubble bubble-3 floating delay-3000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="lg:w-1/2 mb-12 lg:mb-0" data-aos="fade-right">
                <!-- Animated Title -->
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight animate-fade-in-up">
                    <?= $data['hero']['title'] ?>
                    <span class="text-[#FFD700] wave">👋</span>
                </h1>
                
                <!-- Animated Subtitle -->
                <p class="text-lg md:text-xl mb-8 opacity-90 leading-relaxed animate-fade-in-up delay-100">
                    <?= $data['hero']['subtitle'] ?>
                    <span class="inline-block ml-2 animate-pulse">🚀</span>
                </p>

                <!-- Action Buttons -->
                <div class="flex space-x-4 animate-fade-in-up delay-200">
                    <a href="#contact" class="cta-button bg-white text-[#6879EF] px-8 py-3 rounded-full font-semibold hover:bg-opacity-90 transition-all flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        <?= $data['hero']['button_text'] ?>
                    </a>
                    <div class="flex space-x-2">
                        <?php foreach($data['social'] as $social): ?>
                            <a href="<?= $social['url'] ?>" target="_blank" 
                               class="p-3 rounded-full border-2 border-white text-white hover:bg-white hover:text-[#6879EF] transition-all"
                               data-aos="zoom-in" data-aos-delay="100">
                                <i class="<?= $social['platform'] === 'GitHub' ? 'fab fa-github' : 'fab fa-'.strtolower($social['platform']) ?> text-lg"></i>
                            </a>
                            <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Scroll Indicator -->
                <div class="mt-12 animate-bounce">
                    <div class="flex flex-col items-center text-sm opacity-75">
                        <span class="mb-2"><?= $data['hero']['scroll_text'] ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <!-- Profile Image with Floating Animation -->
            <div class="lg:w-1/2 flex justify-center" data-aos="fade-left">
                <div class="relative w-80 h-80 rounded-full overflow-hidden border-8 border-white/20 hover:border-[#FFD700] transition-all floating">
                    <img src="<?= $data['hero']['profile_image'] ?>" alt="Profile" 
                         class="w-full h-full object-cover hover:scale-110 transition-transform">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 glow-effect"></div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800" data-aos="fade-up">
                Featured <span class="text-[#6879EF]">Projects</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($data['projects'] as $project): ?>
                <div class="group relative bg-white rounded-xl shadow-lg hover:shadow-xl transition-all overflow-hidden" data-aos="zoom-in">
                    <div class="relative overflow-hidden">
                        <img src="<?= $project['image'] ?>" alt="<?= $project['title'] ?>" 
                            class="w-full h-60 object-cover transform transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#6879EF] opacity-0 group-hover:opacity-90 transition-opacity flex items-end p-6">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2"><?= $project['title'] ?></h3>
                                <p class="text-sm"><?= $project['description'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-semibold text-gray-800"><?= $project['title'] ?></h3>
                            <span class="text-sm text-[#6879EF]"><?= $project['category'] ?></span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach($project['tags'] as $tag): ?>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600"><?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800" data-aos="fade-up">
                Technical <span class="text-[#6879EF]">Expertise</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach($data['skills'] as $skill): ?>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all" data-aos="flip-up">
                    <div class="w-16 h-16 mb-4 flex items-center justify-center rounded-xl gradient-bg text-white">
                        <i class="<?= $skill['icon'] ?> text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $skill['name'] ?></h3>
                    <p class="text-gray-600 text-sm"><?= $skill['experience'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-gray-800" data-aos="fade-up">
                Get <span class="text-[#6879EF]">In Touch</span>
            </h2>
            <div class="flex flex-wrap justify-center gap-8 max-w-4xl mx-auto">
                <?php foreach($data['contact'] as $contact): ?>
                <a href="<?= $contact['url'] ?>" target="_blank" 
                   class="contact-card bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-2 flex items-center gap-4 w-full md:w-auto"
                   data-aos="zoom-in">
                    <div class="w-12 h-12 rounded-full gradient-bg flex items-center justify-center text-white">
                        <i class="<?= $contact['icon'] ?> text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-700"><?= $contact['platform'] ?></h3>
                        <p class="text-sm text-gray-500">Click to contact</p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
<footer class="gradient-bg text-white py-8 mt-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Copyright -->
            <div class="text-center md:text-left mb-4 md:mb-0">
                <p class="text-sm opacity-80">
                    &copy; <?= date('Y') ?> <?= $data['hero']['title'] ?>. All rights reserved
                </p>
                <p class="text-xs opacity-60 mt-1">
                    Crafted with <i class="fas fa-heart text-red-400"></i> in Indonesia
                </p>
            </div>

            <!-- Social Links -->
            <div class="flex space-x-6">
                <?php foreach($data['social'] as $social): ?>
                <a href="<?= $social['url'] ?>" target="_blank" 
                   class="text-white hover:text-[#FFD700] transition-colors"
                   data-aos="zoom-in" data-aos-delay="100">
                    <i class="<?= $social['platform'] === 'GitHub' ? 'fab fa-github' : 'fab fa-'.strtolower($social['platform']) ?>  text-xl"></i>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Back to Top -->
<div class="text-center mt-8">
    <a href="#home" 
       class="back-to-top inline-block px-6 py-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm"
       data-aos="fade-up">
       <i class="fas fa-arrow-up mr-2"></i>Back to Top
    </a>
</div>
    </div>
</footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out',
        });
    </script>
    <script>
// Smooth scroll untuk semua anchor link
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if(target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Tampilkan tombol back to top saat scroll
window.addEventListener('scroll', function() {
    const backToTop = document.querySelector('.back-to-top');
    if (window.scrollY > 300) {
        backToTop.classList.add('show');
    } else {
        backToTop.classList.remove('show');
    }
});
</script>
</body>
</html>