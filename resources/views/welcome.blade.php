<form action="http://127.0.0.1/pfe_backend/public/api/upload/image" method="post" enctype="multipart/form-data">
    <input type="file" name="image" />
    @csrf
    <input type="submit" value="Upload">
</form>
