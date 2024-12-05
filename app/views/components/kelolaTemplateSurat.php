<?php
function KelolaTemplateSurat()
{
?>
  <form id="updateSuratPernyataan" class="flex-row-full m-0">
    <label class="upload-section" for="lampiran">
      <span class="upload-icon"><img src="../assets/images/upload-surat-icon.svg" width="30px" alt=""></span>
      <p>Upload Lampiran (Max: 5MB)</p>
    </label>
    <input type="file" name="suratPernyataan" id="lampiran" placeholder="Ketik nama pelanggaran di sini..." required hidden accept=".docx">
  </form>
  <div class="list-file-uploaded">
    <h4 id="file-count"></h4>
    <ul id="file-list">
    </ul>
  </div>
<?php
}
?>