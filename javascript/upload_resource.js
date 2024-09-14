document.addEventListener("DOMContentLoaded", function() {
    // Function to handle file drag-and-drop upload
    const setupFileUpload = () => {
        const handleFileSelect = (event, inputId, fileNameId) => {
            event.stopPropagation();
            event.preventDefault();
            const files = event.dataTransfer ? event.dataTransfer.files : event.target.files;
            document.getElementById(inputId).files = files;
            document.getElementById(fileNameId).textContent = files[0].name;
        };

        const handleDragOver = (event) => {
            event.stopPropagation();
            event.preventDefault();
            event.dataTransfer.dropEffect = 'copy';
        };

        const fileDropContainer = document.getElementById('file-drop-container');
        if (fileDropContainer) {
            fileDropContainer.addEventListener('dragover', handleDragOver, false);
            fileDropContainer.addEventListener('drop', (e) => handleFileSelect(e, 'file_path', 'file-name'), false);
            document.getElementById('file_path').addEventListener('change', (e) => handleFileSelect(e, 'file_path', 'file-name'), false);
        }

        const coverDropContainer = document.getElementById('cover-drop-container');
        if (coverDropContainer) {
            coverDropContainer.addEventListener('dragover', handleDragOver, false);
            coverDropContainer.addEventListener('drop', (e) => handleFileSelect(e, 'cover_picture', 'cover-name'), false);
            document.getElementById('cover_picture').addEventListener('change', (e) => handleFileSelect(e, 'cover_picture', 'cover-name'), false);
        }
    };

    setupFileUpload();
});
