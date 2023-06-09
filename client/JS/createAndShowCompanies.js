function createNewCompanyWindow() {
    //Get elements from mainPage.html and hidde or show their
    const userFunctions = document.getElementById("userFunctions");
    const mainWindow = document.getElementById("showMain");
    const showWindow = document.getElementById("showAll");
    const createUser = document.getElementById("createUser");
    userFunctions.style.display = "none";
    mainWindow.style.display = "none";
    showWindow.style.display = "block";
    createUser.style.display = "block";
    createUser.innerHTML = "";
    const postsWindow = document.getElementById("postsWindow");
    postsWindow.innerHTML = "";
    //Create DOM elements 
    const header = document.createElement("div");
    const backArrow = document.createElement("div");
    const titel = document.createElement("div");
    const form = document.createElement("div");
    const contactDataContact = document.createElement("div");
    const contactDataPerson = document.createElement("div");
    const contactDataContract = document.createElement("div");
    contactDataContact.innerHTML = `
    <div class="text-center">Company data</div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="name" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Name</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="street" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Street</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="city" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">City</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="email" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">E-mail</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="telNum" onkeypress="valid()" type="tel" pattern="[0-9]{11,13}" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Telephone number">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Telephon number</label>
        <label id="validTel" class="absolute right-[0.75rem] top-0 text-[1rem] font-normal text-red-500 px-[0.25rem] bg-white">X</label>
    </div>
    `;
    contactDataPerson.innerHTML = `
    <div class="text-center">Responsible person data</div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="pName" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Name</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="pSurname" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Surname</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="pEmail" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">E-mail</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="pTelNum" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" >
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Telephon number</label>
    </div>
    `;
    contactDataContract.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="contract" type="file" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Contract</label>
    </div>
    <button type="button" onclick="createNewCompany()" class="w-[100%] h-[3.5rem] mt-[0.5rem] mb-[0.25rem] bg-[rgba(0,0,0,0)] text-[1.5rem] hover:bg-[rgba(87,87,87,0.4)] rounded">
        Create new company
    </button>
    `;
    //Styles
    const blockStyle = "pb-2 border-b-4 border-black";
    header.className = "border-b-2 flex flex-row";
    titel.className = "ml-6 text-[1.5rem]"
    backArrow.className = "bg-[url('../Materials/arrow.png')] mb-2 bg-cover w-[2rem] h-[2rem] cursor-pointer hover:rounded-[2rem] hover:bg-[rgba(87,87,87,0.4)]";
    contactDataContact.className = blockStyle;
    contactDataPerson.className = blockStyle;
    contactDataContract.className = blockStyle;
    form.className = "w-[95%] max-h-[26rem] overflow-y-auto";
    //Text
    titel.innerText = "Create company";
    //Functions
    //Return
    backArrow.addEventListener("click", function() {
        userFunctions.style.display = "block";
        mainWindow.style.display = "flex";
        showWindow.style.display = "none";
        createUser.style.display = "none";
    });
    
    //Appends
    header.appendChild(backArrow);
    header.appendChild(titel);
    createUser.appendChild(header);
    form.appendChild(contactDataContact);
    form.appendChild(contactDataPerson);
    form.appendChild(contactDataContract);
    createUser.appendChild(form);
}

function createNewCompany() {   
    const name = document.getElementById("name"); 
    const city = document.getElementById("city"); 
    const street = document.getElementById("street"); 
    const email = document.getElementById("email"); 
    const telNum = document.getElementById("telNum"); 
    const pName = document.getElementById("pName");
    const pSurname = document.getElementById("pSurname");  
    const pEmail = document.getElementById("pEmail");
    const pTelNum = document.getElementById("pTelNum");  
    const contract = document.getElementById("contract"); 

    if (name.value.length === undefined || name.value.length < 3) {
        customAlert(1, "Name is too short or empty");
    } else if (city.value.length === undefined || city.value.length < 3) {
        customAlert(1, "City name is too short or empty");
    } else if (street.value.length === undefined || street.value.length < 3) {
        customAlert(1, "Street name is too short or empty");
    } else if (email.value.length === undefined || email.value.length < 3) {
        customAlert(1, "E-mail is too short or empty");
    } else if (!email.value.includes("@")) {
        customAlert(1, "False e-mail format");
    } else if (telNum.value.length === undefined || telNum.value.length < 11) {
        customAlert(1, "Telephone number is too short or empty");
    } else if (!telNum.checkValidity()) {
        customAlert(1, "Telephone have false format. The length must be 11-13 numbers.");
    } if (pName.value.length === undefined || pName.value.length < 3) {
        customAlert(1, "Name is too short or empty");
    }  else if (pSurname.value.length === undefined || pSurname.value.length < 3) {
        customAlert(1, "Surname is too short or empty");
    } else if (pEmail.value.length === undefined || pEmail.value.length < 3) {
        customAlert(1, "E-mail is too short or empty");
    } else if (!pEmail.value.includes("@")) {
        customAlert(1, "False e-mail format");
    } else if (pTelNum.value.length === undefined || pTelNum.value.length < 11) {
        customAlert(1, "Telephone number is too short or empty");
    } else if (contract.files[0] === undefined || !contract.files[0].name.includes("pdf")) {
        customAlert(1, "Contract has a false file format");
    } else {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            addNewCompany(name, city, street, email, telNum, pName, pSurname, pEmail, pTelNum, reader.result, contract);
        })
        reader.readAsDataURL(contract.files[0]);
    }
}

function addNewCompany(name, city, street, email, telNum, pName, pSurname, pEmail, pTelNum, contracts, contract) {
    //Create DOM elements
    const postsWindow = document.getElementById("postsWindow");
    const postWindow = document.createElement("div");
    const postHeader = document.createElement("div");
    const postBody = document.createElement("div");
    const postFooter = document.createElement("div");
    const postName = document.createElement("div");
    const postAddress = document.createElement("div");
    const postPersInfo = document.createElement("div");
    const postPerson = document.createElement("div");
    const postDownload = document.createElement("a");
    const postDelete = document.createElement("button");
    const postEdit = document.createElement("button");
    //Download
    postDownload.download = "contract.pdf";
    postDownload.href = contracts;
    //Text
    postName.innerText = `Company: ${name.value}`;
    postAddress.innerText = `Address: ${city.value}, ${street.value}`;
    postPersInfo.innerText = `E-mail: ${email.value} \n Telephone number: ${telNum.value}`;
    postPerson.innerText = `Responsible person: ${pName.value} ${pSurname.value} \nE-mail: ${pEmail.value}\nTelephone number: ${pTelNum.value}`;
    postDownload.innerText = `Download contact`;
    //Styles
    postWindow.className = "bg-white mt-[2rem] border-4 border-gray-300 shadow-lg shadow-black";
    postHeader.className = "flex flex-row mt-[0.5rem]";
    postBody.className = "ml-[0.5rem]";
    postPersInfo.className = "border-b-2 mb-2";
    postFooter.className = "ml-[0.5rem] flex flex-row mb-2";
    postName.className = "ml-[0.5rem] text-[1.2rem]";
    postDelete.className = "bg-[url('../Materials/delete.png')] bg-cover w-[1.4rem] h-[1.4rem] ml-auto mt-[0.2rem] cursor-pointer hover:bg-[rgba(250,20,50,0.4)] rounded";
    postEdit.className = "bg-[url('../Materials/editing.png')] bg-cover w-[1.4rem] h-[1.4rem] ml-[1rem] mr-[1.5rem] mt-[0.2rem] cursor-pointer hover:bg-[rgba(245,255,90,0.4)] rounded";
    postDownload.className = "text-blue-500 underline underline-offset-4";
    //Functions
    postDelete.addEventListener("click", function() {       
        postWindow.remove();
    });
    //Appends
    postHeader.appendChild(postName);
    postBody.appendChild(postAddress);
    postBody.appendChild(postPersInfo);
    postBody.appendChild(postPerson);
    postFooter.appendChild(postDownload);
    postFooter.appendChild(postDelete);
    postFooter.appendChild(postEdit);
    postWindow.appendChild(postHeader);
    postWindow.appendChild(postBody);
    postWindow.appendChild(postFooter);
    postsWindow.insertBefore(postWindow, postsWindow.firstChild);
    //Clear all
    name.value = "";
    city.value = "";
    street.value = "";
    email.value = "";
    telNum.value = "";
    pName.value = "";
    pSurname.value = "";
    pEmail.value = "";
    pTelNum.value = "";
    contract.value = "";
}