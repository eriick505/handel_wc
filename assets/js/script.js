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

const slide = new Slide(".slide", ".slide-wrapper");

slide.init();
initHandleSearchInputSubmit();
