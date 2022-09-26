<form action="{{ route('web.fileupload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" class="custom-file-input" name="video" id="customFile">
    <input type="submit" value="Save">
</form>
