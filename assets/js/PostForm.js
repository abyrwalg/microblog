class PostForm {
  constructor(formPost, addImageButton, previewContainer) {
    this.button = addImageButton;
    this.button.addEventListener("click", this.showFilesSelector);
    this.images = [];
    this.previewContainer = previewContainer;
    this.formData = new FormData();

    this.formPost = formPost;
    this.formPost
      .querySelector("button[type='submit']")
      .addEventListener("click", this.post);
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

  post = async (event) => {
    event.preventDefault();
    for (let i = 0; i < this.images.length; i++) {
      this.formData.append(`image-${i + 1}`, this.images[i]);
    }
    const postText = this.formPost.querySelector("textarea").value;
    this.formData.append("post", postText);

    try {
      const response = await fetch("post.php", {
        method: "post",
        body: this.formData,
      });
      const result = await response.json();
      console.log(result);
      location.reload();
    } catch (error) {
      console.log(error);
    }
  };
}
