const slide = new Slide(".slide", ".slide-wrapper");

function initHandleSearchInputSubmit() {
  const searchFormEl = document.querySelector("#searchForm");
  const inputSearchFormEl = searchFormEl.querySelector("#s");

  function showBoxMessage() {
    const boxMessage = document.createElement("div");
    boxMessage.classList.add("boxWarning");
    boxMessage.textContent = "Você precisa digitar algo antes de pesquisar.";

    boxMessage.animate(
      [
        { transform: "translateX(-20px)", opacity: 0 },
        { transform: "initial", opacity: 1 },
      ],
      {
        duration: 100,
      }
    );

    inputSearchFormEl.insertAdjacentElement("afterend", boxMessage);

    setTimeout(() => {
      boxMessage.remove();
    }, 1500);
  }

  function handleSearchForm(e) {
    if (inputSearchFormEl.value === "") {
      e.preventDefault();
      showBoxMessage();
      return;
    }

    searchFormEl.submit();
  }

  searchFormEl.addEventListener("submit", handleSearchForm);
}

function initHandleGalleryProduct() {
  const galleryEl = document.querySelector('[data-gallery="gallery"]');
  const galleryItems = document.querySelectorAll('[data-gallery="listItem"]');
  const galleryMainImg = document.querySelector('[data-gallery="main"]');

  if (!galleryEl) return;

  const changeImage = ({ target }) => (galleryMainImg.src = target.src);

  galleryItems.forEach((item) => {
    item.addEventListener("click", changeImage);
    item.addEventListener("mouseover", changeImage);
  });
}

slide.init();
initHandleSearchInputSubmit();
initHandleGalleryProduct();
