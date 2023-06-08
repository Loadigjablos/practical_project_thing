function renderStudents() {
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

    //functions
    backArrow.addEventListener("click", function() {
        userFunctions.style.display = "block";
        mainWindow.style.display = "flex";
        showWindow.style.display = "none";
        createUser.style.display = "none";
    });

    //Text
    titel.innerText = "chose a student";

    //Styles
    header.className = "border-b-2 flex flex-row";
    backArrow.className = "bg-[url('../Materials/arrow.png')] mb-2 bg-cover w-[2rem] h-[2rem] cursor-pointer hover:rounded-[2rem] hover:bg-[rgba(87,87,87,0.4)]";
    titel.className = "ml-6 text-[1.5rem]"

    //add to main
    header.appendChild(backArrow);
    header.appendChild(titel);
    createUser.appendChild(header);
}