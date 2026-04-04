/* ============================================
   Garage Sposato — Main JS
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {

    /* --- Animated counters --- */
    function animateCounter(element, target, duration = 2000, addPlus = false) {
        const increment = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString('de-CH') + (addPlus ? '+' : '');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString('de-CH');
            }
        }, 16);
    }

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.target);
                const addPlus = el.dataset.plus === 'true';
                animateCounter(el, target, 2000, addPlus);
                counterObserver.unobserve(el);
            }
        });
    }, {threshold: 0.3});

    document.querySelectorAll('.stat-number').forEach(num => {
        counterObserver.observe(num);
    });

    /* --- Navbar active state on scroll --- */
    const navLinks = document.querySelectorAll('#navbar .nav-link');
    const sections = [];

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (!href || !href.startsWith('#')) return;
        const id = href.replace('#', '');
        const target = document.getElementById(id);
        if (target) sections.push({id, el: target, link});
    });

    function updateActiveNav() {
        const scrollY = window.scrollY + 150;

        sections.forEach(({el, link}) => {
            const top = el.offsetTop;
            const bottom = top + el.offsetHeight;

            if (scrollY >= top && scrollY < bottom) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    window.addEventListener('scroll', updateActiveNav);
    updateActiveNav();

    /* --- Close mobile nav on link click --- */
    const navCollapse = document.getElementById('navbarNav');
    if (navCollapse) {
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                if (bsCollapse) bsCollapse.hide();
            });
        });
    }

    /* --- Lazy load images --- */
    const lazyImages = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                img.style.opacity = '1';
                imageObserver.unobserve(img);
            }
        });
    }, {rootMargin: '250px'});

    lazyImages.forEach(img => imageObserver.observe(img));

    /* --- Parallax scroll tracking --- */
    const parallaxElements = document.querySelectorAll('[data-parallax]');

    function updateParallax() {
        const scrollY = window.scrollY;
        parallaxElements.forEach(el => {
            const intensity = parseFloat(el.dataset.parallax) || 0.4;
            const offset = (scrollY - el.offsetTop) * intensity;
            el.style.backgroundPositionY = `calc(50% - ${offset}px)`;
        });
    }

    if (parallaxElements.length) {
        window.addEventListener('scroll', updateParallax);
        updateParallax();
    }
    /* --- Gallery Swiper --- */
    if (document.querySelector('.gallery-swiper')) {
        new Swiper('.gallery-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
    }
    /* --- Leaflet Map --- */
    const mapEl = document.getElementById('map');
    if (!mapEl || typeof L === 'undefined') return;

    const lat = parseFloat(mapEl.dataset.lat);
    const lng = parseFloat(mapEl.dataset.lng);
    const company = mapEl.dataset.company;
    const address = mapEl.dataset.address;
    const city = mapEl.dataset.city;

    const greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    const map = L.map('map', {
        scrollWheelZoom: false,
    }).setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    // init
    L.marker([lat, lng], {icon: greenIcon})
        .addTo(map)
        .bindPopup('<a target="_blank" style="color: #0A0A50; font-size: 0.85rem" href="https://www.google.com/maps/dir/?api=1&destination=' +
            lat + ',' +
            lng + '"><strong>' +
            company +
            '</strong><br>' +
            address + '<br>' +
            city + '</a>')
        .openPopup();
});