document.addEventListener('DOMContentLoaded', function() {
    const services = {
        1: {
            title: 'Konsultime Mjekësore',
            subtitle: 'Konsultime me mjekë specialistë',
            icon: '🩺',
            description: 'Konsultime me mjekë specialistë për çdo problem shëndetësor. Ne ofrojmë konsultime në të gjitha specialitetet mjekësore me mjekë të kualifikuar dhe me përvojë. Çdo konsultim përfshin ekzaminim të plotë, historik mjekësor dhe rekomandime për trajtim.',
            duration: '30-60 minuta',
            price: 'Nga 20 euro',
            availability: 'E Hënë - E Premte: 08:00 - 20:00'
        },
        2: {
            title: 'Analiza Laboratorike',
            subtitle: 'Teste dhe analiza laboratorike',
            icon: '🔬',
            description: 'Teste dhe analiza të plota laboratorike me rezultate të shpejta dhe të sakta. Laboratori ynë është i pajisur me teknologji moderne dhe ofron një gamë të gjerë testesh për diagnostikim të saktë. Rezultatet janë të disponueshme brenda 24-48 orëve.',
            duration: '5-15 minuta (marrja e mostrës)',
            price: 'Nga 15 euro',
            availability: 'E Hënë - E Premte: 07:00 - 19:00'
        },
        3: {
            title: 'Vaksinime',
            subtitle: 'Vaksinime për të gjitha moshën',
            icon: '💉',
            description: 'Vaksinime për të gjitha moshën dhe për udhëtime. Ne ofrojmë vaksinime standarde dhe speciale për udhëtime me vaksina të certifikuara dhe të sigurta. Kujdesi ynë përfshin konsultim para vaksinimit dhe ndjekje pas vaksinimit.',
            duration: '15-30 minuta',
            price: 'Nga 30 euro',
            availability: 'E Hënë - E Premte: 08:00 - 18:00'
        },
        4: {
            title: 'Imagjistikë Mjekësore',
            subtitle: 'Shërbime imagjistike mjekësore',
            icon: '🩻',
            description: 'Shërbime të plota imagjistike mjekësore për diagnostikim të saktë. Pajisje moderne për radiografi, ultrazë dhe MRI. Rezultatet interpretohen nga radiologë të kualifikuar dhe janë të disponueshme brenda kohës së shkurtër.',
            duration: '15-60 minuta (varësisht nga lloji)',
            price: 'Nga 50 euro',
            availability: 'E Hënë - E Premte: 08:00 - 20:00'
        },
        5: {
            title: 'Trajtime Spitalore',
            subtitle: 'Trajtime spitalore me kujdes 24/7',
            icon: '🏥',
            description: 'Trajtime spitalore me kujdes 24/7. Dhoma të rehatshme dhe staf mjekësor profesional për çdo nevojë. Ofrojmë kujdes intensiv, trajtime post-operatoriale dhe rehabilitim me ekip mjekësor të dedikuar.',
            duration: 'Varësisht nga trajtimi',
            price: 'Nga 50 euro/ditë',
            availability: '24/7'
        },
        6: {
            title: 'Shërbime Urgjente',
            subtitle: 'Shërbime urgjente 24/7',
            icon: '🚑',
            description: 'Shërbime urgjente 24/7 për raste emergjente. Ekipi ynë është gjithmonë i gatshëm për t\'ju ndihmuar në çdo kohë. Ofrojmë përgjigje të shpejtë dhe kujdes mjekësor profesional për raste urgjente.',
            duration: 'Përgjigje e menjëhershme',
            price: 'Nga 30 euro',
            availability: '24/7'
        }
    };

    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('id') || '1';
    const service = services[serviceId];

    if (service) {
        const titleElement = document.getElementById('serviceTitle');
        const subtitleElement = document.getElementById('serviceSubtitle');
        const serviceNameElement = document.getElementById('serviceName');
        const serviceDescriptionElement = document.getElementById('serviceFullDescription');
        const serviceImageElement = document.getElementById('serviceImage');
        const durationElement = document.getElementById('duration');
        const priceElement = document.getElementById('price');
        const availabilityElement = document.getElementById('availability');

        if (titleElement) titleElement.textContent = service.title;
        if (subtitleElement) subtitleElement.textContent = service.subtitle;
        if (serviceNameElement) serviceNameElement.textContent = service.title;
        if (serviceDescriptionElement) serviceDescriptionElement.textContent = service.description;
        
        if (serviceImageElement) {
            const placeholder = serviceImageElement.querySelector('.placeholder-image-large');
            if (placeholder) placeholder.textContent = service.icon;
        }
        
        if (durationElement) durationElement.textContent = service.duration;
        if (priceElement) priceElement.textContent = service.price;
        if (availabilityElement) availabilityElement.textContent = service.availability;
    }
});

