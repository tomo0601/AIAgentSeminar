document.addEventListener('DOMContentLoaded', ()=> {
    const observerOptions= {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    }

    const observer=new IntersectionObserver((entries, observer)=> {
            entries.forEach(entry=> {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target); // 一度発火したら監視を解除
                    }
                });
        }

        , observerOptions);

    const fadeElements=document.querySelectorAll('.fade-up');
    fadeElements.forEach(el=> observer.observe(el));

    // スムーススクロールの処理
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
