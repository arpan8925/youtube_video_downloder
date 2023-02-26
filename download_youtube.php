<?php
if (isset($_POST['submit'])) {
    $url = $_POST['url'];
    $video_id = explode("?v=", $url); // get the video id from the url
    $video_id = $video_id[1];
    $download_format = $_POST['format']; // get the selected download format
    if ($download_format == 'mp4') {
        $download_link = "https://www.youtube.com/watch?v=".$video_id; // create the MP4 download link
        $filename = $video_id.".mp4"; // create a unique filename for MP4
        $content_type = 'application/octet-stream';
    } elseif ($download_format == 'mp3') {
        $download_link = "https://www.youtubeinmp3.com/fetch/?video=https://www.youtube.com/watch?v=".$video_id; // create the MP3 download link using youtubeinmp3.com API
        $filename = $video_id.".mp3"; // create a unique filename for MP3
        $content_type = 'audio/mpeg';
    }
    header('Content-Type: '.$content_type);
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"".$filename."\"");
    readfile($download_link); // download the video or audio
}
?>

<form method="post">
    <label for="url">Enter YouTube URL:</label>
    <input type="text" name="url" id="url">
    <label for="format">Download format:</label>
    <select name="format" id="format">
        <option value="mp4">MP4</option>
        <option value="mp3">MP3</option>
    </select>
    <input type="submit" name="submit" value="Download">
</form>
