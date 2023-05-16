const createUserField = document.querySelector("#create-user");

const user = JSON.parse(localStorage.getItem("me"));

try {
  if (user.role !== "A") {
    document.querySelector('#admin-only').className = "hidden";
  }
} catch (e) {
  document.querySelector('#admin-only').className = "hidden";
  MessageUI("error", "you need to login")
}

const username = document.querySelector("#user-name");
const userEmail = document.querySelector("#user-email");
const userland = document.querySelector("#user-land");
const userstreet = document.querySelector("#user-street");
const userplz = document.querySelector("#user-plz");
const usercity = document.querySelector("#user-city");

const userpasswdhash = document.querySelector("#user-passwdhash");
const userpicture = document.querySelector("#user-picture");
const userparents = document.querySelector("#user-parents");
const userbirthdate = document.querySelector("#user-birthdate");
const userahvnumer = document.querySelector("#user-ahvnumer");
const userclassname = document.querySelector("#user-class-name");
const userrole = document.querySelector("#user-role-");

document.querySelector("#create-user-").addEventListener("click", async (e) => {
  let file = userpicture.files[0];

  let roleA = "U";

  for (let i = 0; i < userrole.children.length; i++) {
    const role = userrole.children[i];
    if (role.checked) {
      roleA = role.value
    }
  }

  try {
    // Encode the file using the FileReader API
    const reader = new FileReader();
    reader.onloadend = async () => {
      // Use a regex to remove data url part
      const base64String = reader.result.replace("data:", "").replace(/^.+,/, "");

      const data = {
        name: username.value,
        email: userEmail.value,
        passwdhash: userpasswdhash.value,
        picture_id: base64String,
        parents: userparents.value,
        birthdate: userbirthdate.value,
        ahvnumer: userahvnumer.value,
        role: roleA,
        class_name: userclassname.value,
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

      if (!response.ok) {
        MessageUI("Failed", "Please Try Again")
        return;
      }
      MessageUI("Created", "User: " + username.value + " Was created")
      addToUserToList(data)
    };

    reader.readAsDataURL(file);

  } catch (e) {
    MessageUI("error", "Invalid picture")
  }

});

const usersList = document.querySelector('#users-list');

let something = {
  thing: true,
  elseT: ""
}

function addToUserToList(data) {
  try {
    const row = document.createElement('tr');

    try {
      const picture = document.createElement('iframe');
      const byteCharacters = atob(data.picture);
      const byteNumbers = new Array(byteCharacters.length);
      for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
      }
      const byteArray = new Uint8Array(byteNumbers);
      const blob = new Blob([byteArray]);
      picture.src = URL.createObjectURL(blob);
      picture.width = "150px"
      picture.height = "150px"
      row.appendChild(picture)
    } catch (e) {
      const error = document.createElement('td');
      error.innerText = "No Picture";
      row.appendChild(error);
    }

    const name = document.createElement('td');
    name.innerText = data.name;
    row.appendChild(name);

    const email = document.createElement('td');
    email.innerText = data.email;
    row.appendChild(email);

    const parents = document.createElement('td');
    parents.innerText = data.parents;
    row.appendChild(parents);

    const birthdate = document.createElement('td');
    birthdate.innerText = data.birthdate;
    row.appendChild(birthdate);

    const ahvnumer = document.createElement('td');
    ahvnumer.innerText = data.ahvnumer;
    row.appendChild(ahvnumer);

    const role = document.createElement('td');
    role.innerText = data.role;
    row.appendChild(role);

    const class_name = document.createElement('td');
    class_name.innerText = data.class;
    row.appendChild(class_name);

    const stelle = document.createElement('td');
    stelle.innerText = data.company || "Keine Stelle";
    row.appendChild(stelle);

    const adresse = document.createElement('td');
    adresse.innerText = data.adress.adress[0].land + ", " + data.adress.adress[0].street + ", " + data.adress.adress[0].plz + ", " + data.adress.adress[0].city;
    row.appendChild(adresse);

    try {
      if (data.class_name !== something.elseT) {
        something.thing = !(something.thing);
        something.elseT = data.class_name;
      }
      if (something.thing) {
        row.className = "bg-gray-500";
      } else {
        row.className = "bg-blue-500";
      }
    } catch (e) {
      row.className = "bg-red-500";
    }

    usersList.appendChild(row)
  } catch (e) {
    MessageUI("error", "can't parse data: " + data)
  }
}

addFromDB()

async function addFromDB() {
  const response = await fetch("/API/V1/Users", {
    method: "get",
    cache: "no-cache"
  });

  if (!response.ok) {
    MessageUI("Failed", "Please Connect to the internet or conntact the developer")
    return;
  }
  const dataThing = await response.json();

  dataThing.users.forEach(userThing => {
    addToUserToList(userThing)
  });
}

addFromDB()