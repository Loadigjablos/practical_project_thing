const mail = document.querySelector("#e-mail");
const pwd = document.querySelector("#pwd");
const pwdA = document.querySelector("#pwd-a");

document.querySelector("#send").addEventListener('click', async (e) => {
  document.body.className = "bg-black animate-pulse";
  document.querySelector("#send").className += " animate-bounce";

  if (pwd.value !== pwdA.value) {
    MessageUI("Error", "Please Make shure your passwords are synchronised")

    pwd.className += " border-2 border-rose-600";
    pwdA.className += " border-2 border-rose-600";
  }

  const loginData = {
    email: mail.value,
    password: pwd.value
  }
  /*

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
  */

  document.body.className = "bg-black";
  document.querySelector("#send").className = "w-[50%] mt-[5%] ml-[25%] bg-blue-400";
});
