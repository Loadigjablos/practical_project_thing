/*
try {
    if (user.role !== "A") {
      document.querySelector('#only-admin').className = "hidden";
    }
  } catch(e) {
    document.querySelector('#only-admin').className = "hidden";
    MessageUI("error", "you need to login")
}
*/

const className = document.querySelector('#class-name')
const classspecialization = document.querySelector('#class-specialization')
const classyaer_qv = document.querySelector('#class-yaer_qv')

function addFirmToList(data) {
    const row = document.createElement('tr');

    const id = document.createElement('td');
    id.innerText = data.id;
    row.appendChild(id);

    const class_name = document.createElement('td');
    class_name.innerText = data.class_name;
    row.appendChild(class_name);

    const specialization = document.createElement('td');
    specialization.innerText = data.specialization;
    row.appendChild(specialization);

    const yaer_qv = document.createElement('td');
    yaer_qv.innerText = data.yaer_qv;
    row.appendChild(yaer_qv);

    firms.appendChild(row)
}

document.querySelector('#create-class-').addEventListener('click', async (e) => {

    const data = {
        class_name: className.value,
        specialization: classspecialization.value,
        yaer_qv: classyaer_qv.value
    }

    const response = await fetch("/API/V1/Class", {
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
      MessageUI("Created", "class Was created")

    addFirmToList(data)
});

async function sdvfkshdvhksd() {

    const response = await fetch("/API/V1/Classes", {
        method: "get",
        cache: "no-cache"
    });

    if (!response.ok) {
        MessageUI("Failed", "Please Connect to the internet or conntact the developer")
        return;
      }
      const dataThing = await response.json();
    
      dataThing.forEach(userThing => {
        addFirmToList(userThing)
      });
    
}

sdvfkshdvhksd()
