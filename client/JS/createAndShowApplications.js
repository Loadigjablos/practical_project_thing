function createNewApplicationWindow() {
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
    const contactDataApp = document.createElement("div");
    const contactDataContract = document.createElement("div");
    contactDataApp.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="appDate" type="date" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Application date</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="sName" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Student name">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Company name</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="rName" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Student surname">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Responsible person name</label>
    </div>
    <div class="grid grid-cols-3 grid-rows-2">
            <label class="mx-auto">Sent</label>
            <label class="mx-auto">Refused</label>
            <label class="mx-auto">Accepted</label>
            <input type="radio" name="status" checked class="w-[100%] h-[100%] text-[1rem] bg-[rgba(0,0,0,0)] accepted">
            <input type="radio" name="status" class="w-[100%] h-[100%] text-[1rem] bg-[rgba(0,0,0,0)] accepted"> 
            <input type="radio" name="status" class="w-[100%] h-[100%] text-[1rem] bg-[rgba(0,0,0,0)] accepted">     
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="intDate" type="date" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Interview date</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="tryOut" type="date" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Try-out</label>
    </div>
    `;
    contactDataContract.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="dateContract" type="date" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Date of contract</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="fSalary" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Student surname">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">First year salary</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="sSalary" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Student surname">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Second year salary</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="approve" type="date" class="w-[100%] h-[100%] text-[1.2rem]  bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Approval date</label>
    </div>
    <button type="button" onclick="createNewApplication()" class="w-[100%] h-[3.5rem] mt-[0.5rem] mb-[0.25rem] bg-[rgba(0,0,0,0)] text-[1.5rem] hover:bg-[rgba(87,87,87,0.4)] rounded">
        Create new application
    </button>
    `;
    //Styles
    const blockStyle = "pb-2 border-b-4 border-black";
    header.className = "border-b-2 flex flex-row";
    titel.className = "ml-6 text-[1.5rem]"
    backArrow.className = "bg-[url('../Materials/arrow.png')] mb-2 bg-cover w-[2rem] h-[2rem] cursor-pointer hover:rounded-[2rem] hover:bg-[rgba(87,87,87,0.4)]";
    contactDataApp.className = blockStyle;
    contactDataContract.className = blockStyle;
    form.className = "w-[95%] max-h-[26rem] overflow-y-auto";
    //Text
    titel.innerText = "Create application";
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
    form.appendChild(contactDataApp);
    form.appendChild(contactDataContract);
    createUser.appendChild(form);
    //Set dates
    document.getElementById("appDate").valueAsDate = new Date();
    document.getElementById("intDate").valueAsDate = new Date();
    document.getElementById("tryOut").valueAsDate = new Date();
    document.getElementById("dateContract").valueAsDate = new Date();
    document.getElementById("approve").valueAsDate = new Date();
}

function createNewApplication() {
    const sName = document.getElementById("sName");
    const rName = document.getElementById("rName");
    const fSalary = document.getElementById("fSalary");
    const sSalary = document.getElementById("sSalary");
    const status = document.getElementsByClassName("accepted")
    const appDate = document.getElementById("appDate");
    const intDate = document.getElementById("intDate");
    const tryOut = document.getElementById("tryOut");
    const dateContract = document.getElementById("dateContract");
    const approve = document.getElementById("approve");

    if (sName.value.length === undefined || sName.value.length < 3) {
        customAlert(1, "Company name is too short or empty");
    } else if (rName.value.length === undefined || rName.value.length < 3) {
        customAlert(1, "Responsible person name  is too short or empty");
    } else {
        createApplication(sName, rName, fSalary, sSalary, appDate, intDate, status, intDate, tryOut, dateContract, approve);
    }
}

function createApplication(sName, rName, fSalary, sSalary, appDate, intDate, status, intDate, tryOut, dateContract, approve) {
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
    const postDelete = document.createElement("button");
    const postEdit = document.createElement("button");
    //Text
    for (let i = 0; i < status.length; i++) {
        if (status[i].checked) {
            
        }
    }
    postName.innerText = `Company: ${sName.value}`;
    postAddress.innerText = `Responsible person: ${rName.value}\n Application date: ${appDate.value}`;
    postPersInfo.innerText = `Interview date: ${intDate.value} \nTry-out date: ${tryOut.value}`;
    postPerson.innerText = `Contract date: ${dateContract.value}\nFirst year salary:${fSalary.value} | Seconde year: ${sSalary.value}\nApproval date: ${approve.value}`;
    //Styles
    postWindow.className = "bg-white mt-[2rem] border-4 border-gray-300 shadow-lg shadow-black";
    postHeader.className = "flex flex-row mt-[0.5rem]";
    postBody.className = "ml-[0.5rem]";
    postPersInfo.className = "border-b-2 mb-2";
    postFooter.className = "ml-[0.5rem] flex flex-row mb-2";
    postName.className = "ml-[0.5rem] text-[1.2rem]";
    postDelete.className = "bg-[url('../Materials/delete.png')] bg-cover w-[1.4rem] h-[1.4rem] ml-auto mt-[0.2rem] cursor-pointer hover:bg-[rgba(250,20,50,0.4)] rounded";
    postEdit.className = "bg-[url('../Materials/editing.png')] bg-cover w-[1.4rem] h-[1.4rem] ml-[1rem] mr-[1.5rem] mt-[0.2rem] cursor-pointer hover:bg-[rgba(245,255,90,0.4)] rounded";
    //Functions
    postDelete.addEventListener("click", function() {       
        postWindow.remove();
    });
    //Appends
    postHeader.appendChild(postName);
    postBody.appendChild(postAddress);
    postBody.appendChild(postPersInfo);
    postBody.appendChild(postPerson);
    postFooter.appendChild(postDelete);
    postFooter.appendChild(postEdit);
    postWindow.appendChild(postHeader);
    postWindow.appendChild(postBody);
    postWindow.appendChild(postFooter);
    postsWindow.insertBefore(postWindow, postsWindow.firstChild);
    //Clear all
    sName.value = "";
    rName.value = "";
    fSalary.value = "";
    sSalary.value = "";
    document.getElementById("appDate").valueAsDate = new Date();
    document.getElementById("intDate").valueAsDate = new Date();
    document.getElementById("tryOut").valueAsDate = new Date();
    document.getElementById("dateContract").valueAsDate = new Date();
    document.getElementById("approve").valueAsDate = new Date();
}