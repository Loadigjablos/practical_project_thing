const user = JSON.parse(localStorage.getItem("me"));

try {
  if (user.role !== "A") {
    document.querySelector("#only-admin").className = "hidden";
  }
} catch (e) {
  document.querySelector("#only-admin").className = "hidden";
  MessageUI("error", "you need to login");
}

const firms = document.querySelector("#firms");

function addFirmToList(data) {
  const row = document.createElement("tr");

  const id = document.createElement("td");
  id.innerText = data.id;
  row.appendChild(id);

  const name = document.createElement("td");
  name.innerText = data.name;
  row.appendChild(name);

  const phone = document.createElement("td");
  phone.innerText = data.phone;
  row.appendChild(phone);

  const mail = document.createElement("td");
  mail.innerText = data.email;
  row.appendChild(mail);

  const owner = document.createElement("td");
  owner.innerText = data.owner;
  row.appendChild(owner);

  const adress = document.createElement("td");
  adress.innerText =
    data.land + ", " + data.street + ", " + data.plz + ", " + data.city;
  row.appendChild(adress);

  firms.appendChild(row);
}

const frimName = document.querySelector("#firm-name");
const frimphone = document.querySelector("#firm-phone");
const frimmail = document.querySelector("#firm-mail");
const frimland = document.querySelector("#firm-land");
const frimstreet = document.querySelector("#firm-street");
const frimplz = document.querySelector("#firm-plz");
const frimcity = document.querySelector("#firm-city");
const frimowner = document.querySelector("#firm-owner");

document.querySelector("#create-firm-").addEventListener("click", async (e) => {
  const data = {
    name: frimName.value,
    email: frimmail.value,
    phone: frimphone.value,
    owner: frimowner.value,
    land: frimland.value,
    street: frimstreet.value,
    plz: frimplz.value,
    city: frimcity.value,
  };

  const response = await fetch("/API/V1/Company", {
    method: "post",
    body: JSON.stringify(data),
    cache: "no-cache",
    headers: {
      "Content-Type": "application/json",
    },
  });

  if (!response.ok) {
    MessageUI("Failed", "Please Try Again");
    return;
  }
  MessageUI("Created", "User: " + username.value + " Was created");
  addFirmToList(data);
});
