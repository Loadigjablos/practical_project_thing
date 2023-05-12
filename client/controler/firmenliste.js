const firms = document.querySelector('#firms');

function addFirmToList(data) {
    const row = document.createElement('tr');

    const id = document.createElement('td');
    id.innerText = data.id;
    row.appendChild(id);

    const name = document.createElement('td');
    name.innerText = data.name;
    row.appendChild(name);

    const phone = document.createElement('td');
    phone.innerText = data.phone;
    row.appendChild(phone);

    const mail = document.createElement('td');
    mail.innerText = data.mail;
    row.appendChild(mail);

    const owner = document.createElement('td');
    owner.innerText = data.owner;
    row.appendChild(owner);

    const adress = document.createElement('td');
    adress.innerText = data.adress;
    row.appendChild(adress);

    firms.appendChild(row)
}

addFirmToList({
    id: "james#1",
    name: "james#2",
    phone: "james#3",
    mail: "james#4",
    owner: "james#5",
    adress: "james#6"
});
