var map = L.map('mapa-kontener').setView([20, 0], 2);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var conflicts = [
    {
        lat: 50.45,
        lng: 30.52,
        title: "Ukraina (Wojna z Rosją)",
        description: "Trwająca wojna z Rosją wpływa na ceny energii, zboża, nawozów."
    },
    {
        lat: 31.76,
        lng: 35.21,
        title: "Izrael-Palestyna (Wojna w Strefie Gazy)",
        description: "Działania wojenne wpływają na ceny ropy naftowej."
    },
    {
        lat: 15.3,
        lng: 44.2,
        title: "Jemen (Wojna domowa)",
        description: "Zakłócenia eksportu ropy w wyniku trwającej wojny domowej."
    },
    {
        lat: 19.76,
        lng: 96.08,
        title: "Mjanma (Wojna domowa)",
        description: "Konflikt ogranicza eksport metali, w tym srebra, złota, i stali."
    },
    {
        lat: -1.29,
        lng: 29.82,
        title: "Demokratyczna Republika Konga (Konflikt M23)",
        description: "Wojna wpływa na przemysł wydobywczy (kobalt, miedź)."
    },
    {
        lat: 32.43,
        lng: 53.68,
        title: "Iran (Napięcia i interwencje militarne)",
        description: "Napięcia regionalne wpływają na ceny ropy naftowej."
    },
    {
        lat: 34.08,
        lng: 74.79,
        title: "Kaszmír (Indie-Pakistan)",
        description: "Zbrojne starcia w regionie Kaszmiru destabilizują sytuację w Azji."
    },
    {
        lat: 15.5,
        lng: 32.5,
        title: "Sudan (Wojna domowa)",
        description: "Wojna domowa wpływa na produkcję ropy i złota."
    },
    {
        lat: 12.65,
        lng: -8.0,
        title: "Mali (Konflikt w Sahelu)",
        description: "Walka z grupami islamistycznymi destabilizuje region i wpływa na eksport surowców."
    },
    {
        lat: 6.52,
        lng: 3.37,
        title: "Nigeria (Boko Haram i konflikty zbrojne)",
        description: "Zbrojne działania zakłócają produkcję ropy naftowej."
    },
    {
        lat: 33.51,
        lng: 36.29,
        title: "Syria (Wojna domowa)",
        description: "Trwająca wojna domowa zakłóca eksport ropy i gazu."
    },
    {
        lat: 12.65,
        lng: 99.97,
        title: "Afganistan (Wojna z talibami)",
        description: "Trwały konflikt wpływa na sytuację polityczną i ekonomiczną kraju."
    },
    {
        lat: 14.55,
        lng: -17.85,
        title: "Czad (Wojna z rebeliantami)",
        description: "Konflikt wpływa na niestabilność w regionie Sahelu."
    },
    {
        lat: 4.87,
        lng: -58.23,
        title: "Kolumbia (Konflikty zbrojne)",
        description: "Przemoc związana z kartelami narkotykowymi i grupami bojowymi."
    },
    {
        lat: 10.0,
        lng: 105.0,
        title: "Filipiny (Wojna z bojownikami islamskimi)",
        description: "Walki w południowych regionach kraju destabilizują sytuację."
    }
];

conflicts.forEach(function(conflict) {
    L.marker([conflict.lat, conflict.lng])
        .addTo(map)
        .bindPopup("<strong>" + conflict.title + "</strong><br>" + conflict.description);
});
