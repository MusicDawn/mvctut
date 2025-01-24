//That e is the event parameter
document.addEventListener("DOMContentLoaded", loadlist)

function loadlist() {

    // console.log('Ευτυχώς Δουλεύει');
    //We instantiate xhr to XMLHttpRequest::class because we need to call the following methods.
    const xhr = new XMLHttpRequest();
    //First we using the method open() so we can define the Http request(GET in our case) and URI.
    xhr.open("GET", "/listusers")
    //Second we using the method send() which we sending the request
    xhr.send();
    //Onload method change the ready state and the browser recieves the response.
    xhr.onload = function () {
        //The html variable is basicly the data that will get printed on the page
        html = `<tr>
                     <th>First Name</th>
                     <th>Last Name</th>
                     <th>Email</th>
                     <th>Click to User</th>
            </tr>`
        // JSON.parse so we can translate from JSON to Java Script.
        var users = JSON.parse(this.responseText)
        // for loop so we can get our values.
        for (let i = 0; i < users.length; i++) {
            html += `<tr>
                     <td>${users[i].first_name}</td>
                     <td>${users[i].last_name}</td>
                     <td>${users[i].email}</td>
                     <td><a onclick="loadsingle(${users[i].id})" class="myButton">Wild Card</a></td>
                     <td><a onclick="loadsingleQ(${users[i].id})" class="myButton">Query String</a></td>
                  </tr>`
        }
        // Append to the HTML document.
        var tags = document.getElementsByTagName('table')[0].innerHTML = html;
    }
}

function loadsingle(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/listuser/" + id)
    xhr.send();
    xhr.onload = function () {
        let html = `<tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Click to User</th>
            </tr>`
        var users = JSON.parse(this.responseText)
        html += `<tr>
                 <td>${users.first_name}</td>
                 <td>${users.last_name}</td>
                 <td>${users.email}</td>
                 <td><a onclick="loadlist()" class="myButton">List</a></td>
              </tr>`

        var tags = document.getElementsByTagName('table')[0].innerHTML = html;


    }
}

// Q from query_string
function loadsingleQ(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "/listuser?id=" + id)
    xhr.send();
    xhr.onload = function () {
        let html = `<tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Click to User</th>
            </tr>`
        var users = JSON.parse(this.responseText)
        html += `<tr>
                 <td>${users.first_name}</td>
                 <td>${users.last_name}</td>
                 <td>${users.email}</td>
                 <td><a onclick="loadlist()" class="myButton">List</a></td>
              </tr>`

        var tags = document.getElementsByTagName('table')[0].innerHTML = html;


    }
}