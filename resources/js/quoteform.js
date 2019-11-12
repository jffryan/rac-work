(function() {
  const textTypes = ["text", "email", "tel"];
  const url = "quote.php";

  document
    .getElementById("submit-button")
    .addEventListener("click", function(e) {
      e.preventDefault();

      const form = document.getElementById("what-form");
      const elements = form.elements;
      const payload = {};

      for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        const value = element.value;
        const checked = element.checked;
        const name = element.name;
        if (element.type === "checkbox") {
          payload[name] = checked;
        }
        if (textTypes.includes(element.type)) {
          payload[name] = value;
        }
      }
      fetch(url, {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(payload) // body data type must match "Content-Type" header
      })
        .then(data => data.json())
        .then(
          (document.getElementById(
            "quote-message"
          ).innerHTML = `<div class="alert alert-dismissable border-1px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent! We'll be in touch soon. </div>`)
        )
        .catch(
          err =>
            (document.getElementById(
              "quote-message"
            ).innerHTML = `<div class="alert alert-dismissable border-1px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>There was an error processing your request. Please try again. </div>`)
        );
    });
})();
