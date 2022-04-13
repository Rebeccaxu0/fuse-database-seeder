const client = filestack.init('AH59fBT6uS4SC2YbWiJJpz');

const uploadContainer = document.getElementById('Filestack-container');
const uploadFilename = document.getElementById('Filestack-filename');
const uploadHandle = document.getElementById('Filestack-handle');
const uploadKey = document.getElementById('Filestack-key');
const uploadMimetype = document.getElementById('Filestack-mimetype');
const uploadOriginalPath = document.getElementById('Filestack-original_path');
const uploadSize = document.getElementById('Filestack-size');
const uploadSource = document.getElementById('Filestack-source');
const uploadStatus = document.getElementById('Filestack-status');
const uploadUploadId = document.getElementById('Filestack-upload_id');
const uploadURL = document.getElementById('Filestack-url');

let options = {
  'cleanupImageExif': {
    'keepOrientation': true,
    'keepICCandAPP': true
  },
  'container': '#Filestack-Picker',
  'displayMode': 'inline',
  'dropPane': {
    'overlay': false,
    'showIcon': true,
    'showProgress': true
  },
  'fromSources': ['local_file_system', 'googledrive', 'webcam', 'audio', 'video'],
  'maxFiles': 1,
  'onUploadDone': updateForm,
  'startUploadingWhenMaxFilesReached': true,
  'storeTo': {
    'container': 'fusestudio-student-uploads',
    'location': 's3',
    'path': settings.fuse_level.uid + '/',
    'region': 'us-east-1'
  },
  'uploadInBackground': false
};

const picker = client.picker(options);
picker.open();

function updateForm(results) {
  const upload = results.filesUploaded[0];
  uploadContainer.value = upload.container;
  uploadFilename.value = upload.filename;
  uploadHandle.value = upload.handle;
  uploadKey.value = upload.key;
  uploadMimetype.value = upload.mimetype;
  uploadOriginalPath.value = upload.originalPath;
  uploadSize.value = upload.size;
  uploadSource.value = upload.source;
  uploadStatus.value = upload.status;
  uploadUploadId.value = upload.uploadId;
  uploadURL.value = upload.url;
  $('button[id*=edit-picker-submit-file]').mousedown();
}
