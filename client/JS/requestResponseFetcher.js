const baseUrl = "/csbe-projekte/inf-projektwoche2023/blau/API/V1/";
//GET
async function getAllStudents() {
    const response = await fetch( baseUrl+"Students", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json();
}

async function getAllCompanies() {
    const response = await fetch( baseUrl+"Companies", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json();
}

async function getAllApplications() {
    const response = await fetch( baseUrl+"Applications", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json();
}

async function getAllUsers() {
    const response = await fetch( baseUrl+"Users", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

//POST
async function postStudent(data) {
    const response = await fetch( baseUrl+"Student", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

async function postCompany(data) {
    const response = await fetch( baseUrl+"Company", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

async function postApplication(data) {
    const response = await fetch( baseUrl+"Application", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

async function postUser(data) {
    const response = await fetch( baseUrl+"User", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

//Login and Logout
async function postLogin(data) {
    const response = await fetch( baseUrl+"Login", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}
async function postLogout() {
    const response = await fetch( baseUrl+"Logout", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

//DELETE
async function deleteStudent(id) {
    const response = await fetch( baseUrl+`Student/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

async function deleteCompany(id) {
    const response = await fetch( baseUrl+`Company/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

async function deleteApplication(id) {
    const response = await fetch( baseUrl+`Application/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

async function deleteUser(id) {
    const response = await fetch( baseUrl+`User/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}

//PUT
async function putStudent(data, id) {
    const response = await fetch( baseUrl+`Student/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}
async function putCompany(data, id) {
    const response = await fetch( baseUrl+`Company/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}
async function putApplication(data, id) {
    const response = await fetch( baseUrl+`Application/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}
async function putUser(data, id) {
    const response = await fetch( baseUrl+`User/${id}`, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const result = await response.json(); 
}