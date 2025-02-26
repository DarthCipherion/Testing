<?php
header("Content-Type: application/json");

// Database credentials
$host = "162.214.80.40"; // Change if needed
$user = "heconseq_darthcipherion";
$password = "Queen_Boherha_1975";
$database = "heconseq_test_projects";

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Fetch multiple video IDs (e.g., latest 5 videos)
$sql = "SELECT video_id FROM videos ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

$videoIds = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $videoIds[] = $row["video_id"];
    }
    echo json_encode(["videoIds" => $videoIds]);
} else {
    echo json_encode(["error" => "No videos found"]);
}

// Close connection
$conn->close();
?>
