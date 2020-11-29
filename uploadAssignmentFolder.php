<form action="includes/uploadAssignment.inc.php?idAssignment=<?= $idAssignment ?>" method="post" enctype="multipart/form-data">
  Type Folder Name:<input type="text" name="foldername" /><br/><br/>
  Select Folder to Upload: <input type="file" name="files[]" id="files" multiple directory="" webkitdirectory="" moxdirectory="" /><br/><br/>
  <input type="Submit" value="Upload" name="upload" />
  </form>
