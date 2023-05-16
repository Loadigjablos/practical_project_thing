const thisOpenFile = document.querySelector('#this-file');

const filesFromUser = document.querySelector('#files-from-user')


const typeOfFile = document.querySelector('#type-of-file')
const fileToSend = document.querySelector('#file-adding')

document.querySelector('#add-file-to-user').addEventListener('click', async (e) => {

});

async function getAllFilesFromHashUser() {
    const response = await fetch("/API/V1/Classes", {
        method: "get",
        cache: "no-cache",
      });
    
      if (!response.ok) {
        MessageUI(
          "Failed",
          "the user was not found or the server had an error"
        );
        return;
      }
      const dataThing = await response.json();
    
      dataThing.forEach((userThing) => {
        addFirmToList(userThing);
      });
}

location.hash.substring(1);

if (location.hash !== "") {

} else {

}
