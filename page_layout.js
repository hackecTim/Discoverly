
function openReviewForm() {
  const form = document.getElementById("reviewFormContainer");
  console.log("Opening form...");

  if (!form) {
    console.error("Review form container not found");
    return;
  }

  form.classList.add("is-open");
  form.setAttribute("aria-hidden", "false");

  // Fallback for old CSS (display: none/flex)
  form.style.display = "flex";

  document.body.style.overflow = "hidden";

  const first = form.querySelector("select, textarea, button, input");
  if (first) setTimeout(() => first.focus(), 50);
}

function closeReviewForm() {
  const form = document.getElementById("reviewFormContainer");
  if (!form) return;

  form.classList.remove("is-open");
  form.setAttribute("aria-hidden", "true");

  // Fallback for old CSS
  form.style.display = "none";

  document.body.style.overflow = "";
}

function showLoginModal() {
  const modal = document.getElementById("loginModal");
  if (!modal) return;

  modal.classList.add("show");
  document.body.style.overflow = "hidden";
}

function hideLoginModal() {
  const modal = document.getElementById("loginModal");
  if (!modal) return;

  modal.classList.remove("show");
  document.body.style.overflow = "";
}

(function setupModalCloseHandlers() {
  const form = document.getElementById("reviewFormContainer");
  if (form) {
    form.addEventListener("click", (e) => {
      if (e.target === form) closeReviewForm();
    });
  }

  window.addEventListener("keydown", (e) => {
    if (e.key !== "Escape") return;

    const reviewIsOpen = form && (form.classList.contains("is-open") || form.style.display === "flex");
    if (reviewIsOpen) closeReviewForm();

    const login = document.getElementById("loginModal");
    if (login && login.classList.contains("show")) hideLoginModal();
  });
})();

(function scrollReveal() {
  const items = [
    ...document.querySelectorAll(
      ".map-card, .info-side, .photos-section, .reviews-section, .review-item"
    ),
  ];

  if (!items.length) return;

  items.forEach((el) => el.classList.add("reveal"));

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("revealed");
          io.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12 }
  );

  items.forEach((el) => io.observe(el));
})();

var map = L.map("map").setView([51.505, -0.09], 13);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

L.marker([placeData.lat, placeData.lng])
  .addTo(map)
  .bindPopup(placeData.address)
  .openPopup();

// https://leafletjs.com/examples/quick-start/

let userLat = null; // save userLat
let userLon = null; // save userLon
let routeControl = null; // save route

function showUserLocation(callback) {
  if (!navigator.geolocation) {
    alert("Location not supported by your device");
    return;
  }

  navigator.geolocation.getCurrentPosition(
    (position) => {
      userLat = position.coords.latitude;
      userLon = position.coords.longitude;

      // custom marker icon
      const userIcon = L.icon({
        iconUrl: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      // user location marker
      L.marker([userLat, userLon], { icon: userIcon })
        .addTo(map)
        .bindPopup("Your location")
        .openPopup();

      // move map to user
      map.setView([userLat, userLon], 13);

      if (callback) callback();
    },
    (error) => {
      alert("Unable to retrieve your location");
      console.error(error);
    }
  );
}

function routeToLocation() {
  if (userLat === null || userLon === null) {
    showUserLocation(routeToLocation);
    return;
  }

  // delete route if it exists already
  if (routeControl) {
    map.removeControl(routeControl);
    routeControl = null;
  }

  // create route
  routeControl = L.Routing.control({
    waypoints: [
      L.latLng(userLat, userLon), // start - user location
      L.latLng(placeData.lat, placeData.lng), // end - destination location
    ],
    routeWhileDragging: false,
    createMarker: function () {
      return null;
    }, // disable markers
    draggableWaypoints: false, // disable dragging
    addWaypoints: false, // disable adding extra waypoints
  }).addTo(map);
}
(function initStarRating() {
  const container = document.querySelector(".star-rating");
  const hiddenInput = document.getElementById("ratingValue");
  const hint = document.getElementById("starHint");

  if (!container || !hiddenInput) return;

  const stars = Array.from(container.querySelectorAll(".star"));
  let selected = parseInt(hiddenInput.value || "0", 10);

  function labelFor(value){
    if (value <= 0) return "Select a rating";
    if (value === 1) return "1 star";
    return `${value} stars`;
  }

  function paint(value) {
    stars.forEach((btn, idx) => {
      const on = idx < value;
      btn.classList.toggle("is-lit", on);
      btn.setAttribute("aria-checked", on ? "true" : "false");
    });
    if (hint) hint.textContent = labelFor(value);
  }

  paint(selected);

  stars.forEach((btn) => {
    btn.addEventListener("mouseenter", () => {
      const v = parseInt(btn.dataset.value, 10);
      paint(v);
    });

    btn.addEventListener("click", () => {
      selected = parseInt(btn.dataset.value, 10);
      hiddenInput.value = String(selected);
      paint(selected);
    });
  });

  // When leaving container, revert to selected value
  container.addEventListener("mouseleave", () => paint(selected));

  // Keyboard support: left/right arrows change selection
  container.addEventListener("keydown", (e) => {
    const key = e.key;
    if (!["ArrowLeft", "ArrowRight", "Home", "End"].includes(key)) return;

    e.preventDefault();
    if (key === "ArrowLeft") selected = Math.max(1, selected - 1);
    if (key === "ArrowRight") selected = Math.min(5, selected + 1);
    if (key === "Home") selected = 1;
    if (key === "End") selected = 5;

    hiddenInput.value = String(selected);
    paint(selected);
  });

  container.tabIndex = 0;
})();
(function guardReviewSubmit(){
  const form = document.querySelector(".review-form");
  const rating = document.getElementById("ratingValue");
  if (!form || !rating) return;

  form.addEventListener("submit", (e) => {
    if (parseInt(rating.value || "0", 10) < 1) {
      e.preventDefault();
      alert("Please select a star rating before submitting.");
    }
  });
})();
