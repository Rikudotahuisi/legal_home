@extends('article.panel.master_admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pengajuan</h3>
              </div>

<label class="title">Judul Artikel:</label>
<div class="mb-3 my-input">
  <input type="text" class="form-control custom-width" id="floatingInput" placeholder="saya orang ampana">
</div>

<label for="img" class="title">Pilih Gambar:</label>
  <input type="file" class="img" id="img" name="img" accept="image/*">

<textarea id="editor" class="my-textarea"></textarea>

<script>
    CKEDITOR.replace('editor', {
        toolbar: [
            { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
            { name: 'insert', items: ['Image', 'Link', 'Video'] },
            { name: 'styles', items: ['Format'] },
            { name: 'tools', items: ['Maximize', 'SpellChecker'] },
        ]
    });
</script>
<button type="button" class="btn btn-success tombol">Update</button>
</div>

@endsection

