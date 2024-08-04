//Drag and Drop Files
const dropzone = document.getElementById('fileUploadDropzone');
const fileInput = document.getElementById('fileUpload');
const dropzoneContent = document.getElementById('dropzoneContent');

dropzone.addEventListener('click', () => fileInput.click());

dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('dragover');
});

dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('dragover');
});

dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
    updateDropzoneContent();
});

fileInput.addEventListener('change', updateDropzoneContent);

function updateDropzoneContent() {
    if (fileInput.files.length > 0) {
        let fileNames = [];
        for (let i = 0; i < fileInput.files.length; i++) {
            fileNames.push(fileInput.files[i].name);
        }
        dropzoneContent.innerHTML = `<p>${fileNames.join(', ')}</p>`;
    } else {
        dropzoneContent.innerHTML = `
            <i class="fas fa-cloud-upload-alt" style="font-size: 30px;"></i>
            <p>Drag and drop files here or click to upload</p>
        `;
    }
}

//Choose Department
document.addEventListener('DOMContentLoaded', function () {
    const departmentSelect = document.getElementById('department');
    const collegeCampusInput = document.getElementById('collegeCampus');

    departmentSelect.addEventListener('change', function () {
        const selectedDepartment = departmentSelect.value;
        collegeCampusInput.value = selectedDepartment;
    });
});


//Progress Loading
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const saveButton = document.getElementById('saveButton');
    const buttonText = saveButton.querySelector('.button-text');
    const progressBar = saveButton.querySelector('.progress-bar');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        saveButton.disabled = true;
        saveButton.classList.add('submitting');
        buttonText.textContent = 'Submitting...';

        const formData = new FormData(form);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);

        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBar.style.width = percentComplete + '%';
            }
        };

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        console.error('Error:', response.message);
                        resetButton();
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    if (xhr.responseURL !== form.action) {
                        window.location.href = xhr.responseURL;
                    } else {
                        resetButton();
                    }
                }
            } else {
                console.error('Error:', xhr.statusText);
                resetButton();
            }
        };

        xhr.onerror = function() {
            console.error('Error:', xhr.statusText);
            resetButton();
        };

        xhr.send(formData);
    });

    function resetButton() {
        saveButton.disabled = false;
        saveButton.classList.remove('submitting');
        buttonText.textContent = 'Save';
        progressBar.style.width = '0';
    }

    setTimeout(function() {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.opacity = 0;
            setTimeout(function() {
                successMessage.remove();
            }, 500); 
        }
    }, 5000);
});