// main.js - Optional enhancements

document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll(".alert");
  
    alerts.forEach(alert => {
      setTimeout(() => {
        alert.style.display = 'none';
      }, 5000);
    });
  
    const scrollLinks = document.querySelectorAll("a[href^='#']");
    scrollLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  });
  