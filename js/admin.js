// Admin dashboard JavaScript
let adminEvents = [];

document.addEventListener("DOMContentLoaded", function () {
    loadColleges();
    loadEvents();

    const pointsForm = document.getElementById("pointsForm");
    if (pointsForm) {
        pointsForm.addEventListener("submit", function (e) {
            e.preventDefault();
            updatePoints();
        });
    }

    const eventForm = document.getElementById("eventForm");
    if (eventForm) {
        eventForm.addEventListener("submit", function (e) {
            e.preventDefault();
            updateEvent();
        });
    }

    const eventSelect = document.getElementById("eventSelect");
    if (eventSelect) {
        eventSelect.addEventListener("change", function () {
            populateEventFields(this.value);
        });
    }
});

function loadColleges() {
    fetch("../backend/getColleges.php")
        .then(response => response.json())
        .then(data => {
            const collegeSelect = document.getElementById("collegeId");
            const collegesTable = document.getElementById("collegesTable");

            if (!Array.isArray(data) || data.length === 0) {
                collegeSelect.innerHTML = '<option value="">No colleges found</option>';
                collegesTable.innerHTML = '<tr><td colspan="3">No colleges available.</td></tr>';
                return;
            }

            collegeSelect.innerHTML = '<option value="">Select a college</option>';
            collegesTable.innerHTML = "";

            data.forEach((college, index) => {
                const option = document.createElement("option");
                option.value = college.id;
                option.textContent = college.name;
                collegeSelect.appendChild(option);

                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="opacity-75">${index + 1}</td>
                    <td class="fw-bold">${college.name}</td>
                    <td class="text-end text-ustp-gold fw-bold">${college.points} pts</td>
                `;
                collegesTable.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Error loading colleges:", error);
            document.getElementById("collegeId").innerHTML = '<option value="">Error loading colleges</option>';
            document.getElementById("collegesTable").innerHTML = '<tr><td colspan="3">Error loading colleges.</td></tr>';
        });
}

function loadEvents() {
    fetch("../backend/getEvents.php")
        .then(response => response.json())
        .then(data => {
            const eventSelect = document.getElementById("eventSelect");
            const eventsTable = document.getElementById("eventsTable");

            adminEvents = Array.isArray(data) ? data : [];

            eventSelect.innerHTML = '<option value="">Create New Event</option>';
            eventsTable.innerHTML = "";

            if (adminEvents.length === 0) {
                eventsTable.innerHTML = '<tr><td colspan="3">No events available.</td></tr>';
                return;
            }

            adminEvents.forEach(event => {
                const option = document.createElement("option");
                option.value = event.id;
                option.textContent = `${event.eventName} (${event.eventDate})`;
                eventSelect.appendChild(option);

                const row = document.createElement("tr");
                row.innerHTML = `
<<<<<<< HEAD
                    <td>${event.id}</td>
                    <td>${event.eventName}</td>
                    <td>${event.eventDate}</td>
=======
                    <td class="opacity-75">${event.id}</td>
                    <td class="fw-bold">${event.event_name}</td>
                    <td class="text-end text-info">${event.event_date}</td>
>>>>>>> upstream/main
                `;
                eventsTable.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Error loading events:", error);
            document.getElementById("eventSelect").innerHTML = '<option value="">Error loading events</option>';
            document.getElementById("eventsTable").innerHTML = '<tr><td colspan="3">Error loading events.</td></tr>';
        });
}

function populateEventFields(eventId) {
    const selected = adminEvents.find(event => String(event.id) === String(eventId));
    document.getElementById("eventName").value = selected ? selected.event_name : "";
    document.getElementById("eventDate").value = selected ? selected.event_date : "";

    const imageInput = document.getElementById("eventImage");
    if (imageInput) imageInput.value = "";

    const deleteBtn = document.getElementById("deleteEventBtn");
    if (deleteBtn) deleteBtn.disabled = !eventId;
}

function deleteEvent() {
    const eventId = document.getElementById("eventSelect").value;
    if (!eventId || !confirm("Are you sure you want to delete this event?")) return;

    const messageDiv = document.getElementById("eventMessage");
    const formData = new FormData();
    formData.append("id", eventId);

    fetch("../backend/deleteEvent.php", { method: "POST", body: formData })
        .then(response => response.json())
        .then(data => {
            messageDiv.className = data.success ? "alert alert-success mt-3" : "alert alert-danger mt-3";
            messageDiv.textContent = data.message;
            if (data.success) {
                document.getElementById("eventForm").reset();
                document.getElementById("eventSelect").value = "";
                document.getElementById("deleteEventBtn").classList.add("d-none");
                loadEvents();
                setTimeout(() => location.reload(), 1200);
            }
        })
        .catch(() => {
            messageDiv.className = "alert alert-danger mt-3";
            messageDiv.textContent = "An error occurred while deleting the event.";
        });
}

function updatePoints() {
    const formData = new FormData(document.getElementById("pointsForm"));
    const messageDiv = document.getElementById("pointsMessage");

    fetch("../backend/updatePoints.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        messageDiv.className = data.success ? "alert alert-success mt-3" : "alert alert-danger mt-3";
        messageDiv.textContent = data.message;

        if (data.success) {
            document.getElementById("pointsForm").reset();
            loadColleges();
            setTimeout(() => location.reload(), 1500);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        messageDiv.className = "alert alert-danger mt-3";
        messageDiv.textContent = "An error occurred while updating points.";
    });
}

function updateEvent() {
    const eventSelect = document.getElementById("eventSelect");
    const eventId = eventSelect.value;
    const formData = new FormData(document.getElementById("eventForm"));
    const messageDiv = document.getElementById("eventMessage");

    if (eventId) {
        formData.append("id", eventId);
    }

    fetch("../backend/updateEvents.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        messageDiv.className = data.success ? "alert alert-success mt-3" : "alert alert-danger mt-3";
        messageDiv.textContent = data.message;

        if (data.success) {
            document.getElementById("eventForm").reset();
            eventSelect.value = "";
            loadEvents();
            setTimeout(() => location.reload(), 1500);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        messageDiv.className = "alert alert-danger mt-3";
        messageDiv.textContent = "An error occurred while saving the event.";
    });
}
