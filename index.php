<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Videos from MySQL</title>
</head>
<body>

<h1>Embedded YouTube Videos</h1>
<div id="video-container">Loading videos...</div>

<script>
    // Fetch multiple video IDs from the PHP API
    fetch('api/get-video.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById("video-container");
            container.innerHTML = ""; // Clear loading text

            if (data.videoIds && Array.isArray(data.videoIds) && data.videoIds.length > 0) {
                data.videoIds.forEach(videoId => {
                    // Create iframe
                    const iframe = document.createElement("iframe");
                    iframe.width = "560";
                    iframe.height = "315";
                    iframe.src = `https://www.youtube.com/embed/${videoId}`;
                    iframe.title = "YouTube video player";
                    iframe.frameBorder = "0";
                    iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                    iframe.allowFullscreen = true;

                    // Insert iframe into the page
                    container.appendChild(iframe);
                    container.appendChild(document.createElement("br")); // Add space between videos
                });
            } else {
                container.innerText = "No videos available.";
            }
        })
        .catch(error => {
            console.error("Error fetching video IDs:", error);
            document.getElementById("video-container").innerText = "Failed to load videos.";
        });
</script>


</body>
</html>
