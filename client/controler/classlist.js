const createUserField = document.querySelector("#create-user");

const user = JSON.parse(localStorage.getItem("me"));

if (user.role !== "A") {
  createUserField.className = "hidden";
}

const username = document.querySelector("#user-name");
const userEmail = document.querySelector("#user-email");
const userland = document.querySelector("#user-land");
const userstreet = document.querySelector("#user-street");
const userplz = document.querySelector("#user-plz");
const usercity = document.querySelector("#user-city");

document.querySelector("#create-user").addEventListener("click", async (e) => {
  const data = {
    name: username.value,
    email: userEmail.value,
    passwdhash: ,
    picture_id: ,
    parents: ,
    birthdate: ,
    ahvnumer: ,
    role: ,
    class_name: ,
    land: userland.value,
    street: userstreet.value,
    plz: userplz.value,
    city: usercity.value,
  };

  const response = await fetch("/API/V1/User", {
    method: "post",
    body: JSON.stringify(data),
    cache: "no-cache",
    headers: {
      "Content-Type": "application/json",
    },
  });
});
