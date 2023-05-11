const mail = document.querySelector("#e-mail");
const pwd = document.querySelector("#pwd");
const pwdA = document.querySelector("#pwd-a");

const loginV = document.querySelector("#login-view");
const loginM = document.querySelector("#login-mail");

loginV.className = "bg-gradient-to-r from-blue-300 to-gray-200 w-[20%] mx-auto w-[70%] p-[5%]";
loginM.className = "bg-gradient-to-r from-blue-300 to-gray-200 w-[20%] mx-auto w-[70%] p-[5%] hidden";

document.querySelector("#send-mail").addEventListener('click', async (e) => {
  if (pwd.value !== pwdA.value) {
    MessageUI("Error", "Please Make shure your passwords are synchronised")

    pwd.className += " border-2 border-rose-600";
    pwdA.className += " border-2 border-rose-600";
    return;
  }

  const loginData = {
    email: mail.value,
    password: pwd.value
  }

  document.body.className = "bg-black animate-pulse";
  document.querySelector("#send-mail").className += " animate-bounce";

  const response = await fetch('/API/V1/Login', {
    method: "post",
    body: JSON.stringify(loginData),
    cache: "no-cache",
    mode: "cors",
    headers: {
      "Content-Type": "application/json"
    }
  });
  const jsonData = await response.json();

  document.body.className = "bg-black";
  document.querySelector("#send-mail").className = "w-[50%] mt-[5%] ml-[25%] bg-blue-400";

  console.log(jsonData);
  if (!response.ok) {
    MessageUI("Login Failed", "Please Try Again")
    return;
  }

  loginV.className = "bg-gradient-to-r from-blue-300 to-gray-200 w-[20%] mx-auto w-[70%] p-[5%] hidden";
  loginM.className = "bg-gradient-to-r from-blue-300 to-gray-200 w-[20%] mx-auto w-[70%] p-[5%]";
});

// 

const pwdB = document.querySelector("#pwd-hash-a");
const emailB = document.querySelector("#e-mail-a");

document.querySelector("#send").addEventListener('click', async (e) => {
  document.body.className = "bg-black animate-pulse";
  document.querySelector("#send").className += " animate-bounce";

  const loginData = {
    email: emailB.value,
    password: pwdB.value
  }

  const response = await fetch('/', {
    method: "post",
    body: JSON.stringify(loginData),
    cache: "no-cache",
    headers: {
      "Content-Type": "application/json"
    }
  });

  const jsonData = await response.json();
  console.log(jsonData);

  document.querySelector("#send").className = "w-[50%] mt-[5%] ml-[25%] bg-blue-400";
  document.body.className = "bg-black";

  if (!response.ok) {
    MessageUI("Login Failed", "Please Try Again")
    return;
  }
})