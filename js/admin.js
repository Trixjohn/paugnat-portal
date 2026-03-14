function updatePoints() {
    const college = document.getElementById("college").value;
    const points = document.getElementById("points").value;
    const message = document.getElementById("message");

    if (points === "" || Number(points) === 0) {
        message.innerHTML = '<span class="text-danger">Points cannot be zero.</span>';
        return;
    }

    fetch("backend/updatePoints.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${encodeURIComponent(college)}&points=${encodeURIComponent(points)}`
    })
    .then(async (response) => {
        const text = await response.text();
        console.log("Raw response:", text);
        return JSON.parse(text);
    })
    .then((data) => {
        if (data.success) {
            message.innerHTML = '<span class="text-success">Score updated successfully.</span>';
            document.getElementById("points").value = "";
        } else {
            message.innerHTML = `<span class="text-danger">${data.message}</span>`;
        }
    })
    .catch((error) => {
        console.error("Error:", error);
        message.innerHTML = '<span class="text-danger">Server error.</span>';
    });
}