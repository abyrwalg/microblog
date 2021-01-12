class Gallery {
  constructor(post) {
    this.post = post;
    this.images = Array.from(this.post.querySelectorAll(".image-container"));
    this.images.forEach((image) =>
      image.addEventListener("click", this.showGallery)
    );
    this.gallery;
    this.currentImageIndex;
    this.currentImage;
    this.nextImageButton;
    this.previousImageButton;
  }

  showGallery = (event) => {
    event.preventDefault();

    //Create gallery
    this.gallery = document.createElement("DIV");
    this.gallery.className = "gallery-container";
    this.gallery.addEventListener("click", this.hideGallery);
    document.body.appendChild(this.gallery);
    document.body.style.overflow = "hidden";

    //Create image
    this.currentImageIndex = this.images.indexOf(event.target);
    let imageSrc = event.target.style.backgroundImage;
    imageSrc = imageSrc.split('"')[1];
    this.currentImage = document.createElement("IMG");
    this.currentImage.src = imageSrc;
    this.gallery.appendChild(this.currentImage);

    //Create buttons to switch images
    if (this.images.length > 1) {
      this.previousImageButton = document.createElement("DIV");
      this.previousImageButton.className = "previous switch-image ui-element";
      this.previousImageButton.addEventListener("click", () =>
        this.switchImage("previous")
      );
      this.gallery.appendChild(this.previousImageButton);

      if (this.currentImageIndex === 0) {
        this.previousImageButton.style.display = "none";
      }

      this.nextImageButton = document.createElement("DIV");
      this.nextImageButton.className = "next switch-image ui-element";
      this.nextImageButton.addEventListener("click", () =>
        this.switchImage("next")
      );
      this.gallery.appendChild(this.nextImageButton);

      if (this.currentImageIndex === this.images.length - 1) {
        this.nextImageButton.style.display = "none";
      }
    }

    //Create close button
    const closeButton = document.createElement("DIV");
    closeButton.className = "close ui-element";
    closeButton.addEventListener("click", this.hideGallery);
    this.gallery.appendChild(closeButton);
  };

  hideGallery = (event) => {
    if (
      event.target.tagName === "IMG" ||
      event.target.classList.contains("switch-image")
    ) {
      return;
    }
    this.gallery.remove();
    document.body.style.overflow = "visible";
  };

  switchImage = (direction) => {
    if (direction === "next") {
      this.currentImage.style.marginLeft = "-100vw";
    } else if (direction === "previous") {
      this.currentImage.style.marginRight = "-100vw";
    }

    setTimeout(() => {
      if (direction === "next") {
        this.gallery.style.justifyContent = "flex-start";
      } else if (direction === "previous") {
        this.gallery.style.justifyContent = "flex-end";
      }
    }, 100);

    setTimeout(() => {
      this.currentImageIndex =
        direction === "next"
          ? this.currentImageIndex + 1
          : this.currentImageIndex - 1;

      //Disable switch image buttons if needed
      if (this.currentImageIndex === 0) {
        this.previousImageButton.style.display = "none";
      } else {
        this.previousImageButton.style.display = "block";
      }

      if (this.currentImageIndex === this.images.length - 1) {
        this.nextImageButton.style.display = "none";
      } else {
        this.nextImageButton.style.display = "block";
      }

      this.currentImage.remove();
      this.currentImage = document.createElement("IMG");
      this.currentImage.className = `${direction}-image`;
      this.currentImage.src = this.images[
        this.currentImageIndex
      ].style.backgroundImage.split('"')[1];
      this.gallery.appendChild(this.currentImage);

      setTimeout(() => {
        this.gallery.style.justifyContent = "center";
        if (direction === "next") {
          this.currentImage.style.marginLeft = "0";
        } else if (direction === "previous") {
          this.currentImage.style.marginRight = "0";
        }
      }, 100);
    }, 200);
  };
}
