document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true,
        easing: 'ease-in-out',
    });
    
    // Typing Animation
document.addEventListener('DOMContentLoaded', function() {
    const typingTexts = <?= json_encode($data['hero']['typing_texts']) ?>;
    let index = 0;
    let currentText = '';
    let isDeleting = false;
    const typingElement = document.querySelector('.typing-text');
    
    function type() {
        const fullText = typingTexts[index];
        
        if (isDeleting) {
            currentText = fullText.substring(0, currentText.length - 1);
        } else {
            currentText = fullText.substring(0, currentText.length + 1);
        }

        typingElement.textContent = currentText;

        let typeSpeed = 100;
        if (isDeleting) typeSpeed /= 2;

        if (!isDeleting && currentText === fullText) {
            typeSpeed = 2000;
            isDeleting = true;
        } else if (isDeleting && currentText === '') {
            isDeleting = false;
            index = (index + 1) % typingTexts.length;
        }

        setTimeout(type, typeSpeed);
    }

    type();
});

    // Add hover effect to projects
    document.querySelectorAll('#projects .project-item').forEach(item => {
        item.addEventListener('mouseover', () => {
            item.querySelector('img').style.transform = 'scale(1.1)';
        });
        item.addEventListener('mouseout', () => {
            item.querySelector('img').style.transform = 'scale(1)';
        });
    });
});