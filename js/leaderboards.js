document.addEventListener("DOMContentLoaded", function () {
    const leaderboard = document.getElementById("leaderboard");

    if (!leaderboard) {
        console.error("Leaderboard not found");
        return;
    }

    fetch("../backend/getColleges.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Network error: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            leaderboard.innerHTML = "";
            const messageEl = document.getElementById("leaderboardMessage");
            messageEl.textContent = "";

            if (!data || data.error) {
                const msg = data && data.message ? data.message : "No rankings available yet.";
                messageEl.textContent = msg;
                return;
            }

            if (!Array.isArray(data) || data.length === 0) {
                messageEl.textContent = "No rankings available yet.";
                return;
            }

            data.forEach((college, index) => {
                let rank = `${index + 1}.`;
                let badgeClass = "bg-primary";

                if (index === 0) {
                    rank = "🥇";
                    badgeClass = "bg-warning text-dark";
                } else if (index === 1) {
                    rank = "🥈";
                    badgeClass = "bg-secondary";
                } else if (index === 2) {
                    rank = "🥉";
                    badgeClass = "bg-danger";
                }

                const li = document.createElement("li");
                li.className = "list-group-item d-flex justify-content-between align-items-center";

                li.innerHTML = `
                    <span class="fw-bold">${rank} ${college.name}</span>
                    <span class="badge ${badgeClass} rounded-pill">${college.points} pts</span>
                `;

                leaderboard.appendChild(li);
            });
        })
        .catch(error => {
            const messageEl = document.getElementById("leaderboardMessage");
            messageEl.textContent = "Unable to load rankings. Please refresh the page.";
            console.error("Error loading leaderboard:", error);
        });
});