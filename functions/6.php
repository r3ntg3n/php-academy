<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 6</title>
</head>
<body>
    <h1>Gallery</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="upload[]" multiple>
        <br><input type="submit" value="Upload">
    </form>
    <table>
        <tbody>
            <?php renderGallery('gallery'); ?>
        </tbody>
    </table>
    <pre>
<?php
    $galleryDir = 'gallery';

    $allowedMimes = [
        'image/png',
        'image/jpg',
        'image/gif',
    ];
    if (!empty($_FILES)) {
        $files = [];
        $uploadData = $_FILES['upload'];
        foreach ($uploadData['name'] as $key => $name) {
            $tmpName = $uploadData['tmp_name'][$key];
            $info = new finfo(FILEINFO_MIME_TYPE);
            $mime = $info->file($tmpName);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            
            if (!in_array($mime, $allowedMimes)) {
                continue;
            }

            $files[] = [
                'tmpName' => $tmpName,
                'destination' => md5_file($tmpName) . ".{$extension}",
            ];
        }

        saveImageIntoGallery($files);
    }

    function renderGallery($galleryDir)
    {
        if (!is_dir($galleryDir)) {
            echo '<tr><td> No images to render </td></tr>';
            return;
        }

        $cwd = getcwd();
        chdir($galleryDir);
        $images = glob('*.png');
        chdir($cwd);
        echo '<tr>';
        foreach ($images as $file) {
            echo "<td><img src=\"{$galleryDir}/{$file}\" width=\"125px\"></td>";
        }
        echo '</tr>';
    }

    function saveImageIntoGallery(array $images)
    {
        global $galleryDir;
        if (!is_dir($galleryDir)) {
            mkdir($galleryDir);
        }
        $cwd = getcwd();
        chdir($galleryDir);
        foreach ($images as &$data) {
            move_uploaded_file($data['tmpName'], $data['destination']);
        }
        chdir($cwd);
    }
?>
    </pre>
</body>
</html>