class ImagesUploader {
  constructor(button, previewContainer) {
    this.button = button;
    this.button.addEventListener("click", this.showFilesSelector);
    this.images = [];
    this.previewContainer = previewContainer;
  }

  showFilesSelector = () => {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/png,image/gif,image/jpeg";
    input.multiple = true;

    input.onchange = () => {
      this.showImagesPreview(input);
    };

    input.click();
  };

  showImagesPreview(input) {
    let inputFiles = Array.from(input.files);
    inputFiles = inputFiles.filter((file) => {
      return !this.images.some(
        (element) => element.name === file.name && element.size === file.size
      );
    });

    this.images.push(...inputFiles);
    this.images = this.images.filter((file) => isFileImage(file));
    if (this.images.length > 4) {
      alert("Пост не может содержать больше четырех изображений");
      return;
    }

    console.log(this.images);

    this.images.forEach((file) => {
      this.previewContainer.innerHTML = "";
      const picReader = new FileReader();
      picReader.addEventListener("load", (event) => {
        const picFile = event.target;
        const image = document.createElement("DIV");
        image.className = "thumbnail";
        image.style.backgroundImage = `url(${picFile.result})`;

        const xButton = document.createElement("DIV");
        xButton.className = "x-button";
        xButton.addEventListener("click", (event) =>
          this.removeImage(event, file)
        );
        image.appendChild(xButton);

        this.previewContainer.insertBefore(image, null);
      });
      //Read the image
      picReader.readAsDataURL(file);
    });

    function isFileImage(file) {
      const acceptedImageTypes = ["image/gif", "image/jpeg", "image/png"];
      return file && acceptedImageTypes.includes(file["type"]);
    }
  }

  removeImage = (event, file) => {
    event.target.parentNode.remove();
    const index = this.images.indexOf(file);
    if (index > -1) {
      this.images.splice(index, 1);
    }
  };
}
