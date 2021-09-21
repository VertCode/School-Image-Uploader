<?php
function initImagePage($upload_date, $url, $image, $application) {
    echo <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wesley | Image</title>
    <link rel="stylesheet" href="../pages/css/image.css"/>
    <script type="application/javascript">
    function change(element) {
        if (element.id === "zoomed") {
            element.id = null;
        }else {
            element.id = "zoomed";
        }
    }
    </script>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="og:site_name" content="Wesley | Image"/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Wesley | Image"/>
    <meta property="og:url" content="$url"/>
    <meta property="og:image" content="$image" />
</head>
<body>
</div>

<div id="body">
    <div class="image-container">
        <div class="image"><img src="$image" alt="" onclick="change(this)""></div>
    </div>
</div>

<div id="footer">
    <div class="footer-item-container">
        <div class="footer-item">Owner: Admin</div>
        <div class="footer-item">Uploaded At: $upload_date</div>
        <div class="footer-item">Application: $application</div>
    </div>
</div>

</body>
</html>
EOT;
}

?>