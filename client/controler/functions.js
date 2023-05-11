

function MessageUI(head, information) {
    const thing = document.createElement("div");
    thing.className = "message-and-error";
  
    const header = document.createElement("h1");
    const informationField = document.createElement("p");
  
    header.innerText = head;
    informationField.innerText = information;
  
    thing.appendChild(header);
    thing.appendChild(informationField);
  
    const deleteOnClick = function () {
      this.parentNode.removeChild(this);
    };
  
    thing.addEventListener("click", deleteOnClick);
  
    document.body.appendChild(thing);
}

MessageUI("thing", "thing")