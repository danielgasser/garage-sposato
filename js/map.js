/* ============================================
   Garage Sposato — Leaflet Map
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
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