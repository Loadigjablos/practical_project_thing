function createNewUserWindow() {
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
    contactDataPerson.innerHTML = `
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="username" maxlength="30" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2" placeholder="Username">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Name</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <input id="password" maxlength="30" type="password" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Password</label>
    </div>
    <div class="relative mb-[1rem] h-[2rem] cursor-pointer">
        <select id="role" class="w-[100%] h-[100%] text-[1.2rem] m-0 bg-[rgba(0,0,0,0)] mt-[1rem] rounded-[2px] border-2">
            <option>User</option>
            <option>Admin</option>
        </select>
        <label class="absolute left-[0.75rem] top-0 text-[1rem] font-normal text-[rgb(112,117,121)] px-[0.25rem] bg-white">Role</label>
    </div>
    <button type="button" onclick="createNewUser()" id="create" class="w-[100%] h-[3.5rem] mt-[0.5rem] mb-[0.25rem] bg-[rgba(0,0,0,0)] text-[1.5rem] hover:bg-[rgba(87,87,87,0.4)] rounded">
        Create new user
    </button>
    `;
    //Styles
    const blockStyle = "pb-2 border-b-4 border-black";
    header.className = "border-b-2 flex flex-row";
    titel.className = "ml-6 text-[1.5rem]"
    backArrow.className = "bg-[url('../Materials/arrow.png')] mb-2 bg-cover w-[2rem] h-[2rem] cursor-pointer hover:rounded-[2rem] hover:bg-[rgba(87,87,87,0.4)]";
    chooseImage.className = blockStyle;
    contactDataPerson.className = blockStyle;
    form.className = "w-[95%] max-h-[26rem] overflow-y-auto";
    //Text
    titel.innerText = "Create user";
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
    createUser.appendChild(form);
}

function createNewUser() {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const role = document.getElementById("role");
    if (username.value.length === undefined || username.value.length < 3) {
        customAlert(1, "Username is too short or empty");
    } else if (password.value.length === undefined || password.value.length < 3) {
        customAlert(1, "Password is too short or empty");
    } else {
        addNewUser(username, role, password);
    }
}

function addNewUser(username, role, password) {
    //Create DOM elements
    const postsWindow = document.getElementById("postsWindow");
    const postWindow = document.createElement("div");
    const postBody = document.createElement("div");
    const postInfo = document.createElement("div");
    //Text
    postInfo.innerText = `Username: ${username.value}\nRole: ${role.value}`;
    //Styles
    postWindow.className = "bg-white mt-[2rem] border-4 border-gray-300 shadow-lg shadow-black";
    postBody.className = "ml-[0.5rem]";
    //Appends
    postBody.appendChild(postInfo);
    postWindow.appendChild(postBody);
    postsWindow.insertBefore(postWindow, postsWindow.firstChild);
    //Clear all
    username.value = "";
    password.value = "";
    role.value = "User";
}