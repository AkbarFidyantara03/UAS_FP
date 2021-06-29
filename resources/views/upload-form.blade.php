<form action="/upload-file" method="POST" enctype="multipart/form-data">

    @csrf
    <input type="file" name="berkas">
    <input type="submit" value="Unggah">
</form>