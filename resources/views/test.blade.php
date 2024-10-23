<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Profile</title>  
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
    <!-- jQuery -->  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
</head>  
<body>  
    <div class="container mt-5">  
        <h2>Upload Avatar</h2>  
        <form id="avatarForm" enctype="multipart/form-data">  
            <div class="form-group">  
                <label for="avatar">Choose Avatar</label>  
                <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*" required>  
            </div>  
            <button type="submit" class="btn btn-primary">Upload</button>  
        </form>  
        <div id="preview" class="mt-3" style="display:none;">  
            <h4>Preview:</h4>  
            <img id="avatarPreview" src="" alt="Avatar Preview" class="img-thumbnail" style="max-width: 200px;">  
        </div>  
    </div>  
    <!-- Bootstrap JS and dependencies -->  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
  
    <script>  
        $(document).ready(function() {  
            $('#avatar').on('change', function(event) {  
                var inputFile = event.target;  
  
                if (inputFile.files && inputFile.files[0]) {  
                    var reader = new FileReader();  
  
                    reader.onload = function(e) {  
                        $('#avatarPreview').attr('src', e.target.result);  
                        $('#preview').show();  
                    }  
  
                    reader.readAsDataURL(inputFile.files[0]);  
                } else {  
                    $('#preview').hide();  
                }  
            });  
  
            $('#avatarForm').on('submit', function(event) {  
                event.preventDefault();  
  
                var formData = new FormData(this);  
  
                $.ajax({  
                    url: '{{ route('user.avatar.update') }}',  
                    type: 'POST',  
                    data: formData,  
                    processData: false,  
                    contentType: false,  
                    success: function(response) {  
                        alert('Avatar uploaded successfully!');  
                        $('#avatarPreview').attr('src', response.avatarUrl);  
                    },  
                    error: function(xhr, status, error) {  
                        alert('Error uploading avatar: ' + xhr.responseText);  
                    }  
                });  
            });  
        });  
    </script>  
</body>  
</html>