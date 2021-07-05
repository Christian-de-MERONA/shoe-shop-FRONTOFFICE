var app = {
  init: function() {
    console.log('app init');

    document.querySelector(".custom-select").addEventListener("change", function(event){
      // get current url
      let currentUrl = window.location.toString();
      let newUrl = "";
      let orderBy = event.currentTarget.value;
      let ordered = false;

      if (currentUrl.search("orderby") !== -1) {
        ordered = true;
      }

      if (ordered) {
        newUrl = currentUrl.substring(0, parseInt(currentUrl.search("orderby")));
      } else {
        newUrl = currentUrl + "/";
      }

      if (orderBy === "orderby_0"){
        window.location.href = newUrl
      } else {
        window.location.href = newUrl + orderBy;
      }

    })
  }
};


document.addEventListener('DOMContentLoaded', app.init);