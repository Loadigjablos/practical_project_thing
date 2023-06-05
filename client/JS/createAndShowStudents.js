function createNewStudentWindow() {
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
    const chooseImage = document.createElement("div");
    const contactDataPerson = document.createElement("div");
    const contactDataPlace = document.createElement("div");
    const contactDataAnother = document.createElement("div");
    const contactDataFiles = document.createElement("div");
    chooseImage.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="image" type="file" accept="image/png" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Choose foto</label>
    </div>
    `;
    contactDataPerson.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="name" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Student name">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Name</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="surname" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Student surname">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Surname</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <select id="gender" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select>
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Gender</label>
    </div>
    `;
    contactDataPlace.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="birthday" min="1990-01-01" max="2010-01-01" value="2000-01-01" type="date" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Birthday</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="city" maxlength="40" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="City">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">City</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="street" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Street address">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Street</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="postCode" max="9999999" min="0" type="number" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Post code">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Post code</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="email" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="E-mail address">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">E-mail</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="telNum" onkeypress="valid()" type="tel" pattern="[0-9]{11,13}" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Telephone number">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Telephon number</label>
        <label id="validTel" class="absolute right-[0.75rem] top-0 text-[1rem] font-normal text-red-500 px-[0.25rem] bg-white">X</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="ahv" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Social security number">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">AHV</label>
    </div>
    `;
    contactDataAnother.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <select id="guard" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
            <option>Self</option>
            <option>Parents</option>
        </select>
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Guardian</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <select id="spec" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
            <option>Application developer</option>
            <option>Software developer</option>
        </select>
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Specialisation</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <select id="classe" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
            <option>inf-21</option>
            <option>inf-22</option>
            <option>inf-23</option>
        </select>
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Class</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="qv" type="number" min="2023" max="2027" step="1" value="2023" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Year QV</label>
    </div>
    `;
    contactDataFiles.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="contract" type="file" accept="application/pdf" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Internship contract</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="efz" type="file" accept="application/pdf" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">EFZ copy</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="note" type="file" accept="application/pdf" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.2rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-[rgba(255,255,255,0.2)]">Marks</label>
    </div>
    <button type="button" onclick="createNewStudent()" id="create" class="w-[100%] h-[3.5rem] mt-[0.5rem] mb-[0.25rem] bg-[rgba(0,0,0,0)] text-[1.5rem] hover:bg-[rgba(87,87,87,0.4)] rounded">
        Create new student
    </button>
    `;
    //Styles
    const blockStyle = "pb-2 border-b-4 border-black";
    header.className = "border-b-2 flex flex-row";
    titel.className = "ml-6 text-[1.5rem]"
    backArrow.className = "bg-[url('../Materials/arrow.png')] mb-2 bg-cover w-[2rem] h-[2rem] cursor-pointer hover:rounded-[2rem] hover:bg-[rgba(87,87,87,0.4)]";
    chooseImage.className = blockStyle;
    contactDataPerson.className = blockStyle;
    contactDataPlace.className = blockStyle;
    contactDataAnother.className = blockStyle;
    form.className = "w-[95%] max-h-[26rem] overflow-y-auto";
    //Text
    titel.innerText = "Create student";
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
    form.appendChild(chooseImage);
    form.appendChild(contactDataPerson);
    form.appendChild(contactDataPlace);
    form.appendChild(contactDataAnother);
    form.appendChild(contactDataFiles);
    createUser.appendChild(form);
}

function createNewStudent() {
    //Create user
    const image = document.getElementById("image");     
    const name = document.getElementById("name"); 
    const surname = document.getElementById("surname"); 
    const gender = document.getElementById("gender");
    const birthday =  document.getElementById("birthday");
    const city = document.getElementById("city"); 
    const street = document.getElementById("street"); 
    const postCode = document.getElementById("postCode"); 
    const email = document.getElementById("email"); 
    const telNum = document.getElementById("telNum"); 
    const ahv = document.getElementById("ahv");  
    const guardian = document.getElementById("guard");
    const spec = document.getElementById("spec");
    const classe = document.getElementById("classe");
    const qv = document.getElementById("qv"); 
    const contract = document.getElementById("contract"); 
    const efz = document.getElementById("efz"); 
    const marks = document.getElementById("note");
    
    if (image.files[0] === undefined) {
        customAlert(1, "Please choose some image");
    } else if (!image.files[0].name.includes("png")) {
        customAlert(1, "Image has a false file format");
    } else if (name.value.length === undefined || name.value.length < 3) {
        customAlert(1, "Name is too short or empty");
    } else if (surname.value.length === undefined || surname.value.length < 3) {
        customAlert(1, "Surname is too short or empty");
    } else if (city.value.length === undefined || city.value.length < 3) {
        customAlert(1, "City name is too short or empty");
    } else if (street.value.length === undefined || street.value.length < 3) {
        customAlert(1, "Street name is too short or empty");
    } else if (postCode.value.length === undefined || postCode.value.length < 3) {
        customAlert(1, "Post code is too short or empty");
    } else if (parseInt(postCode.value) > 9999999 || parseInt(postCode.value) < 0) {
        customAlert(1, "Post code must to be not bigger 9999999 and not shorter 100");
    } else if (email.value.length === undefined || email.value.length < 3) {
        customAlert(1, "E-mail is too short or empty");
    } else if (!email.value.includes("@")) {
        customAlert(1, "False e-mail format");
    } else if (telNum.value.length === undefined || telNum.value.length < 11) {
        customAlert(1, "Telephone number is too short or empty");
    } else if (!telNum.checkValidity()) {
        customAlert(1, "Telephone have false format. The length must be 11-13 numbers.");
    } else if (ahv.value.length === undefined || ahv.value.length < 13) {
        customAlert(1, "AHV is too short or empty");
    } else if (qv.value.length === undefined || qv.value.length < 4) {
        customAlert(1, "Qv yaer ist too short or empty");
    } else if (qv.value < 2023 || qv.value > 2027) {
        customAlert(1, "Qv yaer must be between 2023 and 2027");
    } else if (contract.files[0] !== undefined && !contract.files[0].name.includes("pdf")) {
        customAlert(1, "Contract has a false file format");
    } else if (efz.files[0] !== undefined && !efz.files[0].name.includes("pdf")) {
        customAlert(1, "EFZ has a file format");
    } else {
        const reader = new FileReader();
        let files = [];
        let checkOut = 0;
        reader.addEventListener("load", () => {
            files.push(reader.result);
            if (reader.result !== 0 && checkOut === 0) {
                if (contract.files[0] !== undefined) {
                    checkOut = 1;
                    reader.readAsDataURL(contract.files[0]);
                } else if (efz.files[0] !== undefined) {
                    checkOut = 2;
                    if (contract.files[0] === undefined) files.push(0);
                    reader.readAsDataURL(efz.files[0]); 
                } else if (marks.files[0] !== undefined) {
                    checkOut = 3;
                    if (contract.files[0] === undefined) files.push(0);
                    if (efz.files[0] === undefined) files.push(0);
                    reader.readAsDataURL(marks.files[0]); 
                } else {
                    addNewStudent(files, name, surname, gender, birthday, city, street, postCode, email, telNum, ahv, qv, guardian, spec, classe, image, contract, efz, marks);
                }
            } else if (checkOut === 1) {
                if (efz.files[0] !== undefined) {
                    checkOut = 2;
                    if (contract.files[0] === undefined) files.push(0);
                    reader.readAsDataURL(efz.files[0]); 
                } else if (marks.files[0] !== undefined) {
                    checkOut = 3;
                    if (contract.files[0] === undefined) files.push(0);
                    if (efz.files[0] === undefined) files.push(0);
                    reader.readAsDataURL(marks.files[0]); 
                } else {
                    addNewStudent(files, name, surname, gender, birthday, city, street, postCode, email, telNum, ahv, qv, guardian, spec, classe, image, contract, efz, marks);
                }
            } else if (checkOut === 2) {
                if (marks.files[0] !== undefined) {
                    checkOut = 3;
                    reader.readAsDataURL(marks.files[0]); 
                } else {
                    addNewStudent(files, name, surname, gender, birthday, city, street, postCode, email, telNum, ahv, qv, guardian, spec, classe, image, contract, efz, marks);
                }
            } else if (checkOut === 3) {
                addNewStudent(files, name, surname, gender, birthday, city, street, postCode, email, telNum, ahv, qv, guardian, spec, classe, image, contract, efz, marks);
            } 
        })
        reader.readAsDataURL(image.files[0]);
    }
}

function addNewStudent(files, name, surname, gender, birthday, city, street, postCode, email, telNum, ahv, qv, guardian, spec, classe, image, contract, efz, marks) {
    //Create DOM elements
    const postsWindow = document.getElementById("postsWindow");
    const postWindow = document.createElement("div");
    const postHeader = document.createElement("div");
    const postBody = document.createElement("div");
    const postFooter = document.createElement("div");
    const postImage = document.createElement("img");
    const postName = document.createElement("div");
    const postAddress = document.createElement("div");
    const postPersInfo = document.createElement("div");
    const postAnother = document.createElement("div");
    const postDownload = document.createElement("div");
    const postDownloadContract = document.createElement("a");
    const postDownloadEfz = document.createElement("a");
    const postDownloadMarks = document.createElement("a");
    const postDelete = document.createElement("button");
    const postEdit = document.createElement("button");
    //Text
    postName.innerText = `Name: ${name.value} ${surname.value}`;
    postAddress.innerText = `Gender: ${gender.value} | Birthday: ${birthday.value}\nAddress: ${city.value}, ${street.value} ${postCode.value}`;
    postPersInfo.innerText = `E-mail: ${email.value} \n Telephone number: ${telNum.value}`;
    postAnother.innerText = `AHV: ${ahv.value} | QV-Year: ${qv.value}\nClase: ${classe.value} | Specialisation: ${spec.value}\nGuardian: ${guardian.value}`;
    postImage.src = files[0];
    postDownloadContract.innerText = "Download contract";
    postDownloadEfz.innerText = "Download efz";
    postDownloadMarks.innerText = "Download marks";
    postDownloadContract.download = "contract.pdf";
    postDownloadContract.href = files[1];
    postDownloadEfz.download = "EFZ.pdf";
    postDownloadEfz.href = files[2];
    postDownloadMarks.download = "Marks.pdf";
    postDownloadMarks.href = files[3];
    //Styles
    postWindow.className = "bg-white mt-[2rem] border-4 border-gray-300 shadow-lg shadow-black";
    postHeader.className = "flex flex-row mt-[0.5rem]";
    postBody.className = "ml-[0.5rem]";
    postImage.className = "h-[3rem] w-[3rem] mt-[0.5rem] ml-[0.5rem]";
    postFooter.className = "ml-6 flex flex-row mb-2";
    postName.className = "ml-6 text-[1.2rem]";
    postDelete.className = "bg-[url('../Materials/delete.png')] bg-cover w-[1.4rem] h-[1.4rem] ml-auto mt-[0.2rem] cursor-pointer hover:bg-[rgba(250,20,50,0.4)] rounded";
    postEdit.className = "bg-[url('../Materials/editing.png')] bg-cover w-[1.4rem] h-[1.4rem] ml-[1rem] mr-[1.5rem] mt-[0.2rem] cursor-pointer hover:bg-[rgba(245,255,90,0.4)] rounded";
    postDownload.className = "text-blue-500 flex flex-col";
    //Functions
    postDelete.addEventListener("click", function() {       
        postWindow.remove();
    });
    postEdit.addEventListener("click", function() {       
        
    });
    //Appends
    postHeader.appendChild(postImage);
    postHeader.appendChild(postName);
    postBody.appendChild(postAddress);
    postBody.appendChild(postPersInfo);
    postBody.appendChild(postAnother);
    if (files[1] !== undefined && files[1] !== 0) {
        postDownload.appendChild(postDownloadContract);
    } 
    if (files[2] !== undefined && files[2] !== 0) {
        postDownload.appendChild(postDownloadEfz);
    }
    if (files[3] !== undefined && files[3] !== 0) {
        postDownload.appendChild(postDownloadMarks);
    }
    postFooter.appendChild(postDownload);
    postFooter.appendChild(postDelete);
    postFooter.appendChild(postEdit);
    postWindow.appendChild(postHeader);
    postWindow.appendChild(postBody);
    postWindow.appendChild(postFooter);
    postsWindow.insertBefore(postWindow, postsWindow.firstChild);
    //Cleare after use
    name.value = "";
    surname.value = "";
    city.value = "";
    street.value = "";
    postCode.value = "";
    email.value = "";
    telNum.value = "";
    ahv.value = "";
    birthday.value = "2000-01-01";
    gender.value = "Male";
    guardian.value = "Self";
    spec.value = "Application developer";
    classe.value = "inf-21";
    qv.value = "2023";
    image.value = "";
    contract.value = "";
    efz.value = "";
    marks.value = "";
}


//Validate telnum
function valid() {
    if (document.getElementById("telNum").checkValidity()) {
        document.getElementById("validTel").innerText = "OK";
    } else {
        document.getElementById("validTel").innerText = "X";
    }
}