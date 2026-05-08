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
            handleUpdatePoints();
        });
    }
}

function attachCollegeSelectListener() {
    const collegeSelect = document.getElementById("collegeId");
    if (collegeSelect) {
        collegeSelect.addEventListener("change", function () {
            populateCollegeFields(this.value);
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
            const collegeSelect = document.getElementById("collegeId");
            const collegeStandingsTable = document.getElementById("collegesTable");

            cachedCollegesList = Array.isArray(collegesData) ? collegesData : [];

            if (collegeSelect) {
                collegeSelect.innerHTML = '<option value="">Select a college</option>';
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
                        <td class="text-end fw-bold">${college.points} pts</td>
                    `;
                    tableRow.addEventListener("click", function() {
                        if (collegeSelect) {
                            collegeSelect.value = college.id;
                            populateCollegeFields(college.id);
                            document.getElementById("collegeForm").scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                    collegeStandingsTable.appendChild(tableRow);
                }
            });
        })
        .catch(function (fetchError) {
            console.error("Error loading colleges:", fetchError);
            const collegeSelect = document.getElementById("collegeId");
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
                tableRow.innerHTML = `
                    <td class="fw-bold text-dark">${event.eventName}</td>
                    <td class="opacity-75">${event.location || "-"}</td>
                    <td><span class="badge ${statusBadgeClass} small fw-bold text-uppercase">${event.status || "upcoming"}</span></td>
                    <td class="text-end text-info fw-bold">${event.eventDate}</td>
                `;
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
    const matchedCollege = cachedCollegesList.find(function (c) {
        return String(c.id) === String(selectedCollegeId);
    });

    document.getElementById("collegeName").value = matchedCollege ? matchedCollege.name : "";
    document.getElementById("points").value = "";
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

function handleUpdatePoints() {
    const messageDiv = document.getElementById("collegeMessage");
    const selectedCollegeId = document.getElementById("collegeId").value;
    const pointsInput = document.getElementById("points");
    const pointsValue = pointsInput.value.trim();

    if (!selectedCollegeId) {
        showFeedback(messageDiv, false, "Please select a college before updating points.");
        return;
    }

    if (pointsValue === "" || isNaN(Number(pointsValue))) {
        showFeedback(messageDiv, false, "Please enter a valid number for points.");
        return;
    }

    const formData = new FormData();
    formData.append("id", selectedCollegeId);
    formData.append("points", pointsValue);

    fetch("../backend/updatePoints.php", {
        method: "POST",
        body: formData
    })
    .then(function (response) {
        if (!response.ok) throw new Error("Network error: " + response.status);
        return response.json();
    })
    .then(function (responseData) {
        showFeedback(messageDiv, responseData.success, responseData.message);

        if (responseData.success) {
            document.getElementById("collegeForm").reset();
            loadColleges();
            setTimeout(function () { location.reload(); }, 1500);
        }
    })
    .catch(function (fetchError) {
        console.error("Error updating points:", fetchError);
        showFeedback(messageDiv, false, "An error occurred while updating points. Please try again.");
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
        if (!response.ok) throw new Error("Network error: " + response.status);
        return response.json();
    })
    .then(function (responseData) {
        showFeedback(eventMessageDiv, responseData.success, responseData.message);

        if (responseData.success) {
            document.getElementById("eventForm").reset();
            eventDropdown.value = "";
            loadEvents();
            setTimeout(function () { location.reload(); }, 1500);
        }
    })
    .catch(function (fetchError) {
        console.error("Error saving event:", fetchError);
        showFeedback(eventMessageDiv, false, "An error occurred while saving the event.");
    });
}

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