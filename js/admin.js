
/**
 * admin.js
 * Manages all admin dashboard interactions:
 *   - Loading and displaying colleges and events
 *   - Updating college points with validation
 *   - Creating, editing, and deleting events with validation
 */

/** @type {Array<{id: number, name: string, points: number}>} */
let cachedCollegesList = [];

/** @type {Array<{id: number, eventName: string, eventDate: string}>} */
let cachedEventsList = [];

// ─── Initialization ──────────────────────────────────────────────────────────

document.addEventListener("DOMContentLoaded", function () {
    loadColleges();
    loadEvents();
    attachCollegeFormListener();
    attachCollegeSelectListener();
    attachEventFormListener();
    attachEventSelectListener();
});

// ─── Event Listeners ─────────────────────────────────────────────────────────

function attachCollegeFormListener() {
    const collegeForm = document.getElementById("collegeForm");
    if (collegeForm) {
        collegeForm.addEventListener("submit", function (e) {
            e.preventDefault();
            saveCollege();
        });
    }
}

function attachCollegeSelectListener() {
    const collegeSelect = document.getElementById("collegeSelect");

    if (collegeSelect) {
        collegeSelect.addEventListener("change", function () {
            const selectedId = this.value;

            if (!selectedId) {
                document.getElementById("collegeForm").reset();
                document.getElementById("collegeSubmitBtnText").textContent = "Add College";
                return;
            }

            populateCollegeFields(selectedId);
            document.getElementById("collegeSubmitBtnText").textContent = "Update College";
        });
    }
}

function attachEventFormListener() {
    const eventForm = document.getElementById("eventForm");
    if (eventForm) {
        eventForm.addEventListener("submit", function (e) {
            e.preventDefault();
            handleSaveEvent();
        });
    }
}

function attachEventSelectListener() {
    const eventSelect = document.getElementById("eventSelect");
    if (eventSelect) {
        eventSelect.addEventListener("change", function () {
            populateEventFields(this.value);
        });
    }
}

// ─── Data Loading ─────────────────────────────────────────────────────────────

/**
 * Fetches colleges from the backend and populates the dropdown and standings table.
 */
function loadColleges() {
    fetch("../backend/getColleges.php")
        .then(function (response) {
            if (!response.ok) throw new Error("Network error: " + response.status);
            return response.json();
        })
        .then(function (collegesData) {

            const collegeSelect = document.getElementById("collegeSelect");

            const collegeStandingsTable = document.getElementById("collegesTable");

            cachedCollegesList = Array.isArray(collegesData) ? collegesData : [];

            if (collegeSelect) {
                collegeSelect.innerHTML = '<option value="">+ Create New College</option>';
            }
            
            if (collegeStandingsTable) {
                collegeStandingsTable.innerHTML = "";
            }

            if (cachedCollegesList.length === 0) {
                if (collegeStandingsTable) {
                    collegeStandingsTable.innerHTML = '<tr><td colspan="3" class="text-center opacity-75">No colleges available.</td></tr>';
                }
                return;
            }

            cachedCollegesList.forEach(function (college, rankIndex) {
                // Populate the select dropdown
                if (collegeSelect) {
                    const option = document.createElement("option");
                    option.value = college.id;
                    option.textContent = college.name;
                    collegeSelect.appendChild(option);
                }

                // Populate the standings table
                if (collegeStandingsTable) {
                    const tableRow = document.createElement("tr");
                    tableRow.style.cursor = "pointer";
                    tableRow.title = "Click to select " + college.name;
                    tableRow.innerHTML = `
                        <td class="opacity-75">${rankIndex + 1}</td>
                        <td class="fw-bold text-ustp-gold">${college.name}</td>
                        <td class="text-end fw-bold text-white">${college.points} pts</td>
                    `;
                    tableRow.addEventListener("click", function() {
                        if (collegeSelect) {
                            collegeSelect.value = college.id;
                            populateCollegeFields(college.id);
                            document.getElementById("pointsForm").scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                    collegeStandingsTable.appendChild(tableRow);
                }
            });
        })
        .catch(function (fetchError) {
            console.error("Error loading colleges:", fetchError);

            const collegeSelect = document.getElementById("collegeSelect");

            if (collegeSelect) collegeSelect.innerHTML = '<option value="">Error loading colleges</option>';
            const collegeStandingsTable = document.getElementById("collegesTable");
            if (collegeStandingsTable) collegeStandingsTable.innerHTML = '<tr><td colspan="3" class="text-center text-danger">Failed to load colleges.</td></tr>';
        });
}

function loadEvents() {
    fetch("../backend/getEvents.php")
        .then(function (response) {
            if (!response.ok) throw new Error("Network error: " + response.status);
            return response.json();
        })
        .then(function (eventsData) {
            const eventDropdown = document.getElementById("eventSelect");
            const upcomingEventsTable = document.getElementById("eventsTable");

            cachedEventsList = Array.isArray(eventsData) ? eventsData : [];

            eventDropdown.innerHTML = '<option value="">Create New Event</option>';
            upcomingEventsTable.innerHTML = "";

            if (cachedEventsList.length === 0) {
                upcomingEventsTable.innerHTML = '<tr><td colspan="4" class="text-center opacity-75">No events available.</td></tr>';
                return;
            }

            cachedEventsList.forEach(function (event) {
                // Populate the event selection dropdown
                const dropdownOption = document.createElement("option");
                dropdownOption.value = event.id;
                dropdownOption.textContent = `${event.eventName} (${event.eventDate})`;
                eventDropdown.appendChild(dropdownOption);

                // Status badge logic
                let statusBadgeClass = "bg-secondary";
                if (event.status === "upcoming") statusBadgeClass = "bg-info text-dark";
                else if (event.status === "ongoing") statusBadgeClass = "bg-success";
                else if (event.status === "completed") statusBadgeClass = "bg-primary";
                else if (event.status === "cancelled") statusBadgeClass = "bg-danger";

                // Populate the upcoming events table
                const tableRow = document.createElement("tr");
                tableRow.style.cursor = "pointer";
                tableRow.title = "Click to edit " + event.eventName;
                tableRow.innerHTML = `
                    <td class="fw-bold text-white">${event.eventName}</td>
                    <td class="opacity-75">${event.location || "-"}</td>
                    <td><span class="badge ${statusBadgeClass} small fw-bold text-uppercase">${event.status || "upcoming"}</span></td>
                    <td class="text-end text-white fw-bold">${event.eventDate}</td>
                `;
                tableRow.addEventListener("click", function() {
                    if (eventDropdown) {
                        eventDropdown.value = event.id;
                        populateEventFields(event.id);
                        document.getElementById("eventForm").scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
                upcomingEventsTable.appendChild(tableRow);
            });
        })
        .catch(function (fetchError) {
            console.error("Error loading events:", fetchError);
            document.getElementById("eventSelect").innerHTML = '<option value="">Error loading events</option>';
            document.getElementById("eventsTable").innerHTML = '<tr><td colspan="4" class="text-center text-danger">Failed to load events.</td></tr>';
        });
}

function populateCollegeFields(selectedCollegeId) {
    const c = cachedCollegesList.find(x => String(x.id) === String(selectedCollegeId));

    if (!c) return;

    document.getElementById("collegeName").value = c.name || "";
    document.getElementById("collegeCode").value = c.code || "";
    document.getElementById("collegeDescription").value = c.description || "";
    document.getElementById("collegeDeanName").value = c.deanName || "";
    document.getElementById("collegeEmail").value = c.email || "";
    document.getElementById("collegePhone").value = c.phone || "";
    document.getElementById("collegeBuilding").value = c.building || "";
    document.getElementById("collegeEstablishedYear").value = c.establishedYear || "";
    document.getElementById("collegePoints").value = c.points || "";

}

function populateEventFields(selectedEventId) {

    const matchedEvent = cachedEventsList.find(function (event) {
        return String(event.id) === String(selectedEventId);
    });

    document.getElementById("eventName").value = matchedEvent ? matchedEvent.eventName : "";
    document.getElementById("eventDescription").value = matchedEvent && matchedEvent.description ? matchedEvent.description : "";
    document.getElementById("eventType").value = matchedEvent && matchedEvent.eventType ? matchedEvent.eventType : "sports";
    document.getElementById("eventStatus").value = matchedEvent && matchedEvent.status ? matchedEvent.status : "upcoming";
    document.getElementById("eventDate").value = matchedEvent ? matchedEvent.eventDate : "";
    document.getElementById("eventStartTime").value = matchedEvent && matchedEvent.startTime ? matchedEvent.startTime : "";
    document.getElementById("eventEndTime").value = matchedEvent && matchedEvent.endTime ? matchedEvent.endTime : "";
    document.getElementById("eventLocation").value = matchedEvent && matchedEvent.location ? matchedEvent.location : "";
    document.getElementById("eventMaxParticipants").value = matchedEvent && matchedEvent.maxParticipants ? matchedEvent.maxParticipants : "";

    const deleteEventButton = document.getElementById("deleteEventBtn");
    if (deleteEventButton) deleteEventButton.disabled = !selectedEventId;
}

// ─── Action Handlers ──────────────────────────────────────────────────────────

function saveCollege() {
    const form = document.getElementById("collegeForm");
    const messageDiv = document.getElementById("collegeMessage");

    const formData = new FormData(form);

    const collegeId = document.getElementById("collegeSelect").value;

    const isCreateMode = collegeId === "";

    /**
     * If updating, attach ID
     */
    if (!isCreateMode) {
        formData.append("id", collegeId);
    }

    /**
     * Choose correct backend endpoint
     */
    const url = isCreateMode
        ? "../backend/createCollege.php"
        : "../backend/updateCollege.php";

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        showFeedback(messageDiv, data.success, data.message);

        if (data.success) {
            form.reset();
            document.getElementById("collegeSelect").value = "";
            loadColleges();
        }
    })
    .catch(err => {
        console.error(err);
        showFeedback(messageDiv, false, "Server error occurred.");
    });
}


function handleSaveEvent() {
    const eventMessageDiv = document.getElementById("eventMessage");
    const eventNameInput = document.getElementById("eventName");
    const eventDateInput = document.getElementById("eventDate");
    const eventNameValue = eventNameInput.value.trim();
    const eventDateValue = eventDateInput.value.trim();

    if (!eventNameValue) {
        showFeedback(eventMessageDiv, false, "Event name cannot be empty.");
        return;
    }

    if (!eventDateValue) {
        showFeedback(eventMessageDiv, false, "Please select a valid event date.");
        return;
    }

    const eventDropdown = document.getElementById("eventSelect");
    const selectedEventId = eventDropdown.value;
    const formData = new FormData(document.getElementById("eventForm"));

    if (selectedEventId) {
        formData.append("id", selectedEventId);
    }

    fetch("../backend/updateEvents.php", {
        method: "POST",
        body: formData
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (responseData) {

        console.log("RESPONSE:", responseData);

    showFeedback(eventMessageDiv, responseData.success, responseData.message);

    if (responseData.success) {
        document.getElementById("eventForm").reset();
        eventDropdown.value = "";
        loadEvents();
    }
    })

    .catch(function (fetchError) {
        console.error("Error saving event:", fetchError);
        showFeedback(eventMessageDiv, false, "An error occurred while saving the event.");

    });
};

function deleteEvent() {
    const selectedEventId = document.getElementById("eventSelect").value;

    if (!selectedEventId) {
        showFeedback(document.getElementById("eventMessage"), false, "No event selected for deletion.");
        return;
    }

    if (!confirm("Are you sure you want to delete this event?")) return;

    const eventMessageDiv = document.getElementById("eventMessage");
    const deletePayload = new FormData();
    deletePayload.append("id", selectedEventId);

    fetch("../backend/deleteEvent.php", { method: "POST", body: deletePayload })
        .then(function (response) {
            if (!response.ok) throw new Error("Network error: " + response.status);
            return response.json();
        })
        .then(function (responseData) {
            showFeedback(eventMessageDiv, responseData.success, responseData.message);

            if (responseData.success) {
                document.getElementById("eventForm").reset();
                document.getElementById("eventSelect").value = "";
                document.getElementById("deleteEventBtn").disabled = true;
                loadEvents();
                setTimeout(function () { location.reload(); }, 1200);
            }
        })
        .catch(function (fetchError) {
            console.error("Error deleting event:", fetchError);
            showFeedback(eventMessageDiv, false, "An error occurred while deleting the event.");
        });
}

// ─── Utility ─────────────────────────────────────────────────────────────────

function showFeedback(containerElement, isSuccess, feedbackMessage) {
    const alertClass = isSuccess ? "alert-success" : "alert-danger";
    containerElement.innerHTML = `<div class="alert ${alertClass} mt-3">${feedbackMessage}</div>`;
}

function deleteCollege() {
    const messageDiv = document.getElementById("collegeMessage");
    const collegeId = document.getElementById("collegeSelect").value;

    if (!collegeId) {
        showFeedback(messageDiv, false, "Please select a college first.");
        return;
    }

    if (!confirm("Are you sure you want to delete this college?")) return;

    const formData = new FormData();
    formData.append("id", collegeId);

    fetch("../backend/deleteCollege.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        showFeedback(messageDiv, data.success, data.message);

        if (data.success) {
            document.getElementById("collegeForm").reset();
            document.getElementById("collegeSelect").value = "";
            loadColleges();
        }
    })
    .catch(err => {
        console.error(err);
        showFeedback(messageDiv, false, "Server error occurred.");
    });
}