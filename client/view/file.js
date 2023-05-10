const _file = document.querySelector("#file");
const fileSender = document.querySelector("#send-file");

console.log("");

fileSender.addEventListener("click", async (e) => {
  const file = _file.files[0];

  // Encode the file using the FileReader API
  const reader = new FileReader();
  reader.onloadend = () => {
    // Use a regex to remove data url part
    const base64String = reader.result.replace("data:", "").replace(/^.+,/, "");

    console.log(base64String);
    // Logs wL2dvYWwgbW9yZ...
  };
  reader.readAsDataURL(file);

  /*
    await fetch('/', {

    })
    */
});
