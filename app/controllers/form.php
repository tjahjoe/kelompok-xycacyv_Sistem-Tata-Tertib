<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="uploadForm" enctype="multipart/form-data">
        <label for="surat">Upload Document:</label>
        <input type="file" name="surat" id="surat" accept=".docx">
        <input type="submit" value="Submit">
    </form>
    <div id="response"></div>

    <script>
        $(document).ready(function () {
            $('#uploadForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                // Create FormData object
                var formData = new FormData(this);

                // Make AJAX request
                $.ajax({
                    url: 'handlerPost.php?action=updateSuratPeringatan',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#response').html('<p>' + response + '</p>');
                    },
                    error: function (xhr, status, error) {
                        $('#response').html('<p>Error: ' + error + '</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
